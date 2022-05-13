<?php
namespace app\controllers;


use app\libs\Controllers;
use app\entity\userEntity;
use app\entity\ordersEntity;
use app\entity\fulfillmentsEntity;

class single extends Controllers{
    public function __construct(userEntity $user)
    {
        parent::__construct();
        $this -> user = $user;
        
    }

    public function index($orderId){

        $this -> idTienda = $this -> user -> getTienda();
        $this -> orderId  = $orderId; 
        
        if ($this -> idTienda == '' || empty($this -> idTienda) || $this -> orderId == ''||  empty($this -> orderId)){

            $this->redirect('orders' );
           
        }
        else {
            
            $order = new ordersEntity($this -> idTienda);

            $orderData = $order -> getOrderById($this -> orderId);


            if( $orderData ['shipping_status'] == 'shipped'){

                $fulfillments = new fulfillmentsEntity($this -> idTienda);
                
                $data['fulfillments'] = $fulfillments -> getAllFulfillments($orderId);

            }

            // $this -> view -> orderData = $orderData ;

            $data['order'] = $orderData;

            $this -> render ('single/index' , $data);
        }
    }
}
