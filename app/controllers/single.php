<?php
namespace app\controllers;

use app\libs\Controllers;
use app\entity\userEntity;
use app\entity\ordersEntity;

class single extends Controllers{
    public function __construct(userEntity $user)
    {
        parent::__construct();
        $this -> user = $user;
        
    }

    public function index($orderId){

        $this -> model -> idTienda = $this -> user -> getTienda();
        $this -> model -> orderId  = $orderId; 
        
        if ($this -> model -> idTienda == '' || empty($this -> model -> idTienda) || $this -> model -> orderId == ''||  empty($this -> model -> orderId)){

            $this->redirect('orders' );
           
        }
        else {
            
            $order = new ordersEntity($this -> model -> idTienda);

            $orderData = $order -> getOrderById($this -> model -> orderId);

        


            if( $orderData ['shipping_status'] == 'shipped'){

                // $this -> getAllFulfillments($orderId);

            }

            // $this -> view -> orderData = $orderData ;

            $this -> render ('single/index' , ['order' => $orderData]);
        }
    }
}
