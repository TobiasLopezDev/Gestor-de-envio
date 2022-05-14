<?php

namespace app\entity;

use PDO;
use PDOException;
use app\libs\Models;
use app\entity\customZonesEntity;
use Shuchkin\SimpleXLSXGen;

class ordersEntity extends Models
{
    public function __construct(string $idTienda){
        parent::__construct();
        $this->idTienda = $idTienda;
    }

    public function getAllOrders(){
        // error_log('OrdersEntity::getAllOrders');
        $this->prepareAPIGet($this->idTienda, 'orders/');

        $Allorders = $this->executeAPI();

        $filterOrders = $this->ordersFilterBy($Allorders, 'shipping_option', 'ENVIO-TEST-API'); //FIXME: ACA SE ESTABLECE EL NOMBRE DEL ENVIO.

        $filterOrders = $this->ordersFilterBy($filterOrders, 'payment_status', 'paid');

        $this->deleteAPI();

        $filterOrders  = $this->addCustomZonesToOrdes($filterOrders);

        return  $filterOrders;
    }

    public function ordersFilterBy(array $params = [], string $filter, string $value){
        // error_log('OrdersEntity::ordersFilterBy');
        $nparams = sizeof($params);

        $newparams = [];
        for ($i = 0; $i < $nparams; $i++) {

            if ($params[$i][$filter] == $value) {
                array_push($newparams, $params[$i]);
            }
        }
        return $newparams;
    }

    public function addCustomZonesToOrdes($orders){
        // error_log('OrdersEntity::addCustomZonesToOrdes');

        $nparams = sizeof($orders);

        $customZones = new customZonesEntity();

        $customZones->id_tienda = $this->idTienda;

        $todasZonas = $customZones->getArrayAllZones();

        // error_log($nparams);

        for ($i = 0; $i < $nparams; $i++) {
            $shipping_address = $orders[$i]['shipping_address'];


            for ($x = 0; $x < sizeof($todasZonas); $x++) {

                foreach ($todasZonas[$x]['zonas'] as $value) {
                    if ($shipping_address['locality'] == $value) {
                        $orders[$i]['custom_zone'] = $todasZonas[$x]['nombre'];
                    }
                }
            }

            if (!array_key_exists('custom_zone', $orders[$i])) {
                $orders[$i]['custom_zone'] = 'Sin zona personalizada especificada';
            }
        }

        return $orders;
    }

    public function getOrderById($orderId){
        // error_log('OrdersEntity::getOrderById');
        $url = 'orders/' . $orderId;
        $idTienda = $this->idTienda;

        $this->prepareAPIGet($idTienda, $url);
        $orderData = $this->executeAPI();
        $this->deleteAPI();

        if (isset($orderData['code']) && $orderData['code'] === 404) {
            header('location: ' . $_ENV['URL'] . 'orders');
        }

        $orderData = $this->addCustomZonesToOrdes([$orderData]);

        return $orderData[0];
    }

    public function genXLSX($orders, $filters = []){
        $data = [];

        for ($i = 0; $i < sizeof($orders); $i++) {

            $itemArray = [];
            
            foreach ($filters as $filterValue) {
                switch ($filterValue) {
                    case 'number':
                        array_push($itemArray, $orders[$i]['number']);
                        break;

                    case 'products':
                        array_push($itemArray, $orders[$i]['id']);
                        break;

                    case 'shipping_Info':


                        array_push($itemArray, $orders[$i]['shipping_tracking_number']);
                        break;

                    case 'custom_Zone':
                        array_push($itemArray, $orders[$i]['shipping_address']['locality']);
                        array_push($itemArray, $orders[$i]['shipping_address']['floor']);
                        break;

                    case 'customer_info':
                        array_push($itemArray, $orders[$i]['customer']);
                        break;
                }
            }

            array_push($data, $itemArray);
        }

        $xlsx = new SimpleXLSXGen();
        $xlsx->addSheet($data, 'Ordenes Exportadas');
        $xlsx->saveAs(date('d-m-y') . '-exportOrders.xlsx');
    }

    public function createShipping($data = []){
        $errores = [];
        $respuesta = [];

        if ($data == ''){
            $res = ['status' => 404 , 'data' => [
                'response' => 'Faltan campos']];
            return $res;
        }

        else{
            $ordersId = $data['ordersId'];
            $checkTracking = $data['checkTracking'];
            $checkNotification = $data['checkNotification'];

            if ($checkTracking == true){
                $inputTrackingCode = $this -> generate_UUID('GE_');
            }
            else{
                $inputTrackingCode  = $data['inputTrackingCode'];
            }

            foreach($ordersId as $order){
                $urlFulfill = 'orders/'. $order . '/fulfill'; 

                $data = '{
                    "shipping_tracking_number": "'.$inputTrackingCode.'",
                    "shipping_tracking_url": null,
                    "notify_customer": '.$checkNotification.'
                  }';

                $this->prepareAPIPost($this->idTienda, $urlFulfill,$data);

                $orderData = $this -> executeAPI();

                $this -> deleteAPI();

                if ($orderData['code'] === 404){
                    $res = ['status' => 404 ,'OrderId'=> $order, 'data' => ['response' => 'Campos Incorrectos']];
                    array_push($errores , $res);
                }
                else{
                    $res = ['status' => 201 ,'OrderId'=> $order];
                    array_push($respuesta , $res);
                }
            }

            if (!empty($errores)){
                array_push($respuesta , $errores);
            }
    
            return $respuesta;    
       }    
    }
    
    private function generate_UUID($prefix){
        return uniqid($prefix);
    }
}
