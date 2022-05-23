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

            $orderData = $order -> getOrderById($orderId);


            if( $orderData ['shipping_status'] == 'shipped'){

                $fulfillments = new fulfillmentsEntity ($this -> idTienda);
                
                $data['fulfillments'] = $fulfillments -> getAllFulfillments($orderId);

            }

            $data['order'] = $orderData;

            $this -> render ('single/index' , $data);
        }
    }

    public function deleteFulfill(){
        
        if($this->existPOST(['order_id','fulfillments_id'])){ 
            $this -> idTienda = $this -> user -> getTienda();

            $orderId = $this->getPost('order_id');
            $fulfillmentsId = $this->getPost('fulfillments_id');

            $fulfillmentsEntity = new fulfillmentsEntity($this -> idTienda);
            $res = $fulfillmentsEntity -> deletefulfillments($orderId , $fulfillmentsId);

            echo json_encode($res);
            return;
        }
        
    }
}
