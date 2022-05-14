<?php

namespace app\entity;

use app\libs\Models;

class fulfillmentsEntity extends Models
{

    public $id_tienda;

    function __construct(string $idTienda)
    {
        parent::__construct();
        $this->id_tienda = $idTienda;
    }

    function getAllFulfillments($orderId)
    {

        $this->prepareAPIGet($this->id_tienda, 'orders/' . $orderId  . '/fulfillments');

        $fulfillmentsData = $this->executeAPI();

        $this->deleteAPI();

        if (isset($fulfillmentsData['code']) && $fulfillmentsData['code'] === 404 && $fulfillmentsData['description'] == null) {
            return ['error' => 404];
        }

        if (isset($fulfillmentsData['code']) && $fulfillmentsData['code'] === 404 && isset($fulfillmentsData['description'])) {
            return ['error' => 0];
        }

        return $fulfillmentsData;
    }

    function postFulfillments($ordersId, $data)
    {
        $success = [];
        $errores = [];

        foreach ($ordersId as $value) {
            $urlFulfill = 'orders/'. $value . '/fulfillments'; 
            $this->prepareAPIPost($this->id_tienda, $urlFulfill, $data);

            $fulfillmentData = $this->executeAPI();
            if(isset($fulfillmentData['code'])){
                 array_push($errores , ['code' => 404 , 'order' => $value , 'data' => $fulfillmentData]) ;
            }else{
                array_push($success , ['code' => 200 , 'order' => $value , 'data' => $fulfillmentData]) ;
            }
            
        }

        if(sizeof($errores) > 0){
            $res = ['code' => 403 , 'errores' => $errores , 'success'=> $success];
        }else{
            $res = ['code' => 201 , 'success'=> $success];
        }

        return $res;
    }

    function deletefulfillments($orderId, $fulfillmentsId)
    {
        header('Content-Type: application/json');

        $urlFulfill = 'orders/' . $orderId . '/fulfillments/' . $fulfillmentsId;

        $this->prepareAPIDelete($this->id_tienda, $urlFulfill);

        $fulfillmentData = $this->executeAPI();

        $res = ['status' => 201, 'data' => $fulfillmentData];

        return $res;
    }

    //TODO: generar las create en masa
}
