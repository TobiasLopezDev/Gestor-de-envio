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
        if ($this->existPOST(['ordersId', 'filters'])) {
            $ordersId = $this->getPost('OrdersId');
            $filters = $this->getPost('filters');

            if ($ordersId == '' || empty($ordersId) || $filters == '' || empty($filters)) {
                $orders = new ordersModel();
                $orders->idTienda = $this->user->getTienda();
                $allOrders = $orders->getAllOrders();

                for ($i = 0; $i < sizeof($ordersId); $i++) {
                }
            }
        }
    }

    public function createPDF()
    {
        if ($this->existPOST(['ordersId'])) {
            $ordersId = $this->getPost('OrdersId');

            if ($ordersId == '' || empty($ordersId)) {
            }
        }
    }
    public function createFulfillments()
    {
        header('Content-Type: application/json');
        error_log('ORDERS::createFulfillments');
        if ($this->existPOST(['ordersId', 'inputDescription', 'inputCity', 'inputState', 'inputCountry', 'inputHappendAt', 'inputEstimated'])) {
            $ordersId = $this->getPost('ordersId');
            $ordersId = explode(',', $ordersId);

            if ($ordersId != '' || !empty($ordersId)) {
                $data ='{
                        "status": "' . $this->getPost('inputStatus') . '",
                        "description": "' . $this->getPost('inputDescription') . '",
                        "city": "' . $this->getPost('inputCity') . '",
                        "province": "' . $this->getPost('inputState') . '",
                        "country": "' . $this->getPost('inputCountry') . '",
                        "happened_at": "' . $this->getPost('inputHappendAt') . '",
                        "estimated_delivery_at": "' . $this->getPost('inputEstimated') . '"
                    }';
                $fullfillments = new fulfillmentsEntity($this->user->getTienda());

                $response = $fullfillments -> postFulfillments($ordersId , $data);

                echo json_encode($response);
                return;
            } else {
                echo json_encode(['code' => 404 , 'msg' => 'falta las ordenes']);
                return;
            }
        }
    }

    public function createShippings()
    {
        error_log('ORDERS::createShippings');
        header('Content-Type: application/json');
        if ($this->existPOST(['ordersId', 'checkNotification', 'checkTracking']) || $this->existPOST(['ordersId', 'checkNotification', 'inputTrackingCode'])) {
            $data['ordersId'] = $this->getPost('ordersId');
            $data['checkNotification'] = $this->getPost('checkNotification');
            $data['checkTracking'] = $this->getPost('checkTracking');

            $data['checkNotification'] = $this->getPost('checkNotification');

            if ($data['checkTracking'] == false) {
                $data['inputTrackingCode'] = $this->getPost('inputTrackingCode');
            }

            $this->idTienda = $this->user->getTienda();
            $orders = new ordersEntity($this->idTienda);
            $response = $orders->createShipping();

            echo json_encode($response);
            return;
        } else {
            echo json_encode(['error' => 404]);
            return;
        }
    }

    //TODO: generar las create en masa

}
