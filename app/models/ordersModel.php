<?php

namespace app\models;

use PDO;
use PDOException;

use app\libs\Models;
use app\entity\ordersEntity;


class ordersModel extends Models{
    public $idTienda;
    function __construct()
    {
        parent::__construct();
    }


    public function getAllOrders(){

        $orders = new ordersEntity($this->idTienda);

        $allOrders = $orders -> getAllOrders();
        
        $shippedOrders =  $orders -> ordersFilterBy($allOrders ,'shipping_status' , 'shipped');

        $ordersSegmentacion = ['orders' => $allOrders , 'orders-shippeds' => $shippedOrders];

        return  $ordersSegmentacion;
    }
    
}