<?php

namespace app\entity;

use app\libs\Models;

class fulfillmentsEntity extends Models
{

    public $id_tienda;

    function __construct(string $idTienda)
    {
        parent::__construct();
        $this -> id_tienda = $idTienda;
    }

    function getAllFulfillments($orderId)
    {

        $this->prepareAPIGet($this->id_tienda , 'orders/' . $orderId  . '/fulfillments');

        $fulfillmentsData = $this-> executeAPI();

        $this-> deleteAPI();

        if (isset($fulfillmentsData['code']) && $fulfillmentsData['code'] === 404 && $fulfillmentsData['description'] == null) {
            return ['error' => 404];
        }

        if (isset($fulfillmentsData['code']) && $fulfillmentsData['code'] === 404 && isset($fulfillmentsData['description'])) {
            return ['error' => 0];
        }

        return $fulfillmentsData;
    }

    // function postFulfillments()
    // {

    //     header('Content-Type: application/json');

    //     if ($this->existPOST(['inputOrderId', 'inputDescription', 'inputCity', 'inputState', 'inputCountry', 'inputHappendAt', 'inputEstimated'])) {

    //         $orderId = $this->getPost('inputOrderId');

    //         $urlFulfill = 'orders/' . $orderId . '/fulfillments';

    //         $data =
    //             '{
    //         "status": "' . $this->getPost('inputStatus') . '",
    //         "description": "' . $this->getPost('inputDescription') . '",
    //         "city": "' . $this->getPost('inputCity') . '",
    //         "province": "' . $this->getPost('inputState') . '",
    //         "country": "' . $this->getPost('inputCountry') . '",
    //         "happened_at": "' . $this->getPost('inputHappendAt') . '",
    //         "estimated_delivery_at": "' . $this->getPost('inputEstimated') . '"
    //     }';

    //         $idTienda = $this->getUserSessionData()->getTienda();

    //         $this->prepareAPIPost($idTienda, $urlFulfill, $data);

    //         $fulfillmentData = $this->executeAPI();

    //         $res = ['status' => 201, 'data' => $fulfillmentData];

    //         echo json_encode($res);
    //         return;
    //     }
    // }

    // function deletefulfillments()
    // {
    //     header('Content-Type: application/json');

    //     if ($this->existPOST(['order_id', 'fulfillments_id'])) {
    //         $orderId = $this->getPost('order_id');
    //         $fulfillmentsId = $this->getPost('fulfillments_id');

    //         $urlFulfill = 'orders/' . $orderId . '/fulfillments/' . $fulfillmentsId;

    //         $this->prepareAPIDelete(9, $urlFulfill);

    //         $fulfillmentData = $this->executeAPI();

    //         $res = ['status' => 201, 'data' => $fulfillmentData];


    //         echo json_encode($res);
    //         return;
    //     }
    // }
}
