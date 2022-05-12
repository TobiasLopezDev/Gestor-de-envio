<?php
namespace app\entity;

use PDO;
use PDOException;
use app\libs\Models;
use app\entity\customZonesEntity;

class ordersEntity extends Models{

    
    public function __construct(string $idTienda){
        parent::__construct();
        $this -> idTienda = $idTienda; 
    }

    public function getAllOrders(){

        $this -> prepareAPIGet( $this -> idTienda ,'orders/');

        $Allorders = $this -> executeAPI();

        $filterOrders = $this -> ordersFilterBy($Allorders , 'shipping_option' , 'ENVIO-TEST-API'); //FIXME: ACA SE ESTABLECE EL NOMBRE DEL ENVIO.
        
        $filterOrders = $this -> ordersFilterBy($filterOrders , 'payment_status' , 'paid');

        $this -> deleteAPI();

        $filterOrders  = $this->addCustomZonesToOrdes($filterOrders);

        return  $filterOrders;
        
    }

    public function ordersFilterBy(array $params = [] , string $filter , string $value){

        $nparams = sizeof($params);

        $newparams = [];
        for ($i=0; $i < $nparams; $i++) { 
            
                if ($params[$i][$filter] == $value){
                    array_push($newparams, $params[$i]);
                }

        }
        return $newparams;
    }

    function addCustomZonesToOrdes($orders){

        $nparams = sizeof($orders);

        $customZones = new customZonesEntity();

        $customZones -> id_tienda = $this -> idTienda;

        $todasZonas = $customZones -> getArrayAllZones();


        for ($i=0; $i < $nparams; $i++) { 
            for($x = 0 ; $x < sizeof($todasZonas) ; $x++){

                foreach($todasZonas[$x]['zonas'] as $key => $value){

                    if ($value == $orders[$i]['shipping_address']['locality']){
                        $orders[$i]['custom_zone'] = $todasZonas[$x]['nombre'];
                    }

                }
            }

            if (!array_key_exists('custom_zone' , $orders[$i])){
                $orders[$i]['custom_zone'] = 'Sin zona personalizada especificada';
            }

        }

        return $orders;
        
    }

    public function getOrderById($orderId){

        $url = 'orders/'. $orderId;
        $idTienda = $this -> idTienda;

        $this -> prepareAPIGet( $idTienda , $url);
        $orderData = $this -> executeAPI();
        $this -> deleteAPI();

        if (isset($orderData['code']) && $orderData['code'] === 404)
        {
            header('location: '.$_ENV['URL'].'orders');
        }

        $orderData = $this -> addCustomZonesToOrdes([$orderData]);
        
        return $orderData[0];
    }

}