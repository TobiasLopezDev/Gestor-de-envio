<?php
namespace app\controllers;


use app\entity\ordersEntity;
use app\libs\Controllers;
use app\entity\userEntity;
use app\entity\fulfillmentsEntity;

class Dashboard extends Controllers{
    public $unshippings = 0;
    public $shippings = 0;
    public $sinEstado = 0;
    public $entregadas = 0;
    public $demoradas = 0;
    public $zonesCustom = [];
    public $locality = [];

    public function __construct(userEntity $user)
    {
        parent::__construct();

        $this->user = $user;

    }

    public function index(){



        $orders = new ordersEntity($this-> user -> getTienda());

        $allorders = $orders -> getAllOrders();
        
        foreach ($allorders as $order){
            if($order['shipping_status'] == 'shipped'){
                $this -> shippings = $this-> shippings + 1;

                $fulfillments = new fulfillmentsEntity($this-> user -> getTienda());

                $fulfillmentsOrder = $fulfillments -> getAllFulfillments($order['id']);
                
                if ( isset($fulfillmentsOrder['error'])){
                    $this -> sinEstado = $this -> sinEstado + 1;
                }else{
                    if($fulfillmentsOrder[0]['status'] == 'delivered'){
                        $this -> entregadas = $this -> entregadas + 1;
                    }
    
                    if($fulfillmentsOrder[0]['status'] == 'delayed'){
                        $this -> demoradas = $this-> demoradas + 1;
                    }
                }
                

               

            }
            if($order['shipping_status'] == 'unshipped'){
                $this -> unshippings = $this-> unshippings + 1;
            }
            
            $customzone = $order['custom_zone'];

            if(array_key_exists($customzone , $this -> zonesCustom)){
                $this->zonesCustom[$customzone]['count'] =  $this->zonesCustom[$customzone]['count'] + 1;
            }else{
                $this->zonesCustom[$customzone] = ['name' => $customzone , 'count' => 1];
            }

            $locality = $order['shipping_address']['locality'];

            if(array_key_exists($locality , $this -> locality)){
                $this->locality[$locality]['count'] =  $this->locality[$locality]['count'] + 1;
            }else{
                $this->locality[$locality] = ['name' => $locality , 'count' => 1];
            }

            
        }


        $data = ['user' => $this-> user , 'dataOrders' =>[
            'unshippings'   => $this -> unshippings,
            'shippings'     => $this -> shippings,
            'noStatus'      => $this -> sinEstado,
            'delivered'     => $this -> entregadas,
            'delayed'       => $this -> demoradas,
            'locality'      => $this -> locality,
            'zonesCustom'   => $this -> zonesCustom,
        ]];


        $this->render('dashboard/index' , $data);
    }
}