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

        // error_log('Single::index => idtienda wtf?' . $this-> idTienda .' '.$this->orderId);
        // error_log($this->orderId);

        
        if ($this -> idTienda == '' || empty($this -> idTienda) || $this -> orderId == ''||  empty($this -> orderId)){

            // $this->redirect('orders' );
            // error_log('Single::index => idtienda "" .');

        }
        else {
            // error_log('Single::index => ordersEntity .');
            
            $order = new ordersEntity($this -> idTienda);

            $orderData = $order -> getOrderById($orderId);

            // error_log('Single::index => orderData'. json_encode($orderData));


            if( $orderData ['shipping_status'] == 'shipped'){

                $fulfillments = new fulfillmentsEntity ($this -> idTienda);
                
                $data['fulfillments'] = $fulfillments -> getAllFulfillments($orderId);

            }

            // $this -> view -> orderData = $orderData ;

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
