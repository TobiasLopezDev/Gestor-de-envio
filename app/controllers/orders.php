<?php

namespace app\controllers;

use app\entity\fulfillmentsEntity;
use app\entity\ordersEntity;
use app\libs\Controllers;
use app\entity\userEntity;
use app\models\ordersModel;

class orders extends Controllers
{
    public function __construct(userEntity $user)
    {
        parent::__construct();

        $this->user = $user;
        $this->model = new ordersModel();
    }

    public function index()
    {

        $this->model->idTienda = $this->user->getTienda();

        $this->orders = $this->model->getAllOrders();

        $this->render('orders/index', [
            'user' => $this->user,
            'orders' => $this->orders['orders'],
            'orders-shipped' => $this->orders['orders-shippeds']
        ]);
    }

    public function createXLSX()
    {
        if ($this->existPOST(['orders', 'filters'])) {
            $ordersId = explode(',', $this->getPost('orders'));
            $filters = explode(',', $this->getPost('filters'));

            if ($ordersId != '' || !empty($ordersId) || $filters != '' || !empty($filters)) {
                error_log('orders::createXLSX');
                $orders = new ordersEntity($this->user->getTienda());
                $xlsx = $orders->genXLSX($ordersId, $filters);
                echo json_encode(['status' => 200, 'url' => $xlsx]);
                return;
            }
        }
    }

    public function downloadXLSX($zipName, $filename)
    {
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Length: " . filesize($zipName));

        readfile($zipName);
        unlink($zipName);
        exit;
    }

    public function createPDF()
    {
        header('Content-Type: application/json');
        if ($this->existPOST(['ordersId'])) {
            $ordersId = $this->getPost('ordersId');

            if ($ordersId == '' || empty($ordersId)) {
            }else{

                $ordersId = explode(',',$ordersId);

                $orders = new ordersEntity($this->user->getTienda());

                $response = $orders -> genPdf($ordersId);
                echo json_encode(['status' => 200, 'url' => $response]);
                return;
            }
        }
    }

    public function downloadPDF($zipName,$filename){
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Length: " . filesize($zipName));

        readfile($zipName);
        unlink($zipName);
        exit;
    }

    public function createFulfillments()
    {
        header('Content-Type: application/json');
        error_log('ORDERS::createFulfillments');
        if ($this->existPOST(['ordersId', 'inputDescription', 'inputCity', 'inputState', 'inputCountry', 'inputHappendAt', 'inputEstimated'])) {
            $ordersId = $this->getPost('ordersId');
            $ordersId = explode(',', $ordersId);

            if ($ordersId != '' || !empty($ordersId)) {
                $data = '{
                        "status": "' . $this->getPost('inputStatus') . '",
                        "description": "' . $this->getPost('inputDescription') . '",
                        "city": "' . $this->getPost('inputCity') . '",
                        "province": "' . $this->getPost('inputState') . '",
                        "country": "' . $this->getPost('inputCountry') . '",
                        "happened_at": "' . $this->getPost('inputHappendAt') . '",
                        "estimated_delivery_at": "' . $this->getPost('inputEstimated') . '"
                    }';
                $fullfillments = new fulfillmentsEntity($this->user->getTienda());

                $response = $fullfillments->postFulfillments($ordersId, $data);

                echo json_encode($response);
                return;
            } else {
                echo json_encode(['code' => 404, 'msg' => 'falta las ordenes']);
                return;
            }
        }
    }

    public function createShippings()
    {
        $data = [];
        header('Content-Type: application/json');
        if ($this->existPOST(['ordersId', 'checkNotification', 'checkTracking']) || $this->existPOST(['ordersId', 'checkNotification', 'inputTrackingCode'])) {
            $data['ordersId'] = explode (',',$this->getPost('ordersId'));
            $data['checkNotification'] = $this->getPost('checkNotification');
            $data['checkTracking'] = $this->getPost('checkTracking');

            $data['checkNotification'] = $this->getPost('checkNotification');

            if ($data['checkTracking'] == false) {
                $data['inputTrackingCode'] = $this->getPost('inputTrackingCode');
            }

            $this->idTienda = $this->user->getTienda();
            $orders = new ordersEntity($this->idTienda);

            $response = $orders->createShipping($data);

            echo json_encode($response);
            return;
        } else {
            echo json_encode(['error' => 404]);
            return;
        }
    }

}
