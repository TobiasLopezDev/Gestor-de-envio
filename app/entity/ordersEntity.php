<?php

namespace app\entity;

use PDO;
use PDOException;
use ZipArchive;
use app\libs\Models;
use app\entity\customZonesEntity;
use app\views\templates\pdfTemplate;
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
            $encabezado = [];
            $itemArray = [];
            $order = $this-> getOrderById($orders[$i]);
            foreach ($filters as $filterValue) {
                switch ($filterValue) {
                    case 'number':
                        if ($i == 0){
                            array_push($encabezado, '#Orden');
                        }
                        array_push($itemArray, $order['number']);
                        break;

                    case 'products':
                        if ($i == 0){
                            array_push($encabezado, 'Cantidad de productos');
                        }
                        array_push($itemArray, sizeof($order['products']));
                        break;

                    case 'shipping_Info':

                        if ($i == 0){
                            array_push($encabezado, '<b><center>Direccion</center></b>'); 
                            array_push($encabezado, '<b><center>Localidad</center></b>');
                            array_push($encabezado, '<b><center>Ciudad</center></b>');
                            array_push($encabezado, '<b><center>Provincia</center></b>');
                            array_push($encabezado, '<b><center>Pais</center></b>');
                            array_push($encabezado, '<b><center>CEP // ZIPCODE</center></b>');
                            array_push($encabezado, '<b><center>Notas del cliente</center></b>');
                        }
                        array_push($itemArray, $order['shipping_address']["address"]." ".$order["shipping_address"]["number"] . " " .$order['shipping_address']["floor"]); 
                        array_push($itemArray, $order['shipping_address']["locality"]);
                        array_push($itemArray, $order['shipping_address']["city"]);
                        array_push($itemArray, $order['shipping_address']["province"]);
                        array_push($itemArray, $order['shipping_address']["country"]);
                        array_push($itemArray, $order['shipping_address']["zipcode"]);
                        array_push($itemArray, $order["note"]);
                        
                        break;

                    case 'custom_Zone':
                        if ($i == 0){
                            array_push($encabezado, '<b><center>Custom Zone</center></b>');
                        } 
                            array_push($itemArray, $order['custom_zone']);
                        break;

                    case 'customer_info':
                        if ($i == 0){
                            array_push($encabezado, '<b><center><center>Nombre del cliente</center></b>');
                            array_push($encabezado, '<b><center>Celular</center></b>');
                        } 
                        array_push($itemArray, $order['shipping_address']["name"]);
                        array_push($itemArray, $order['shipping_address']["phone"]);
                    break;
                }
            }
            if($i == 0){
                array_push($data, $encabezado);
            }
            array_push($data, $itemArray);
        }
        $filename = date('d-m-y') . '-exportOrders.xlsx';
        $rutaXLSX = dirname(__FILE__) . '/../temp/xlsx/'. $filename;
        $xlsx = new SimpleXLSXGen();
        $xlsx->addSheet($data, 'Ordenes Exportadas');
        $xlsx->saveAs($rutaXLSX);

        return $filename;
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

    public function genPDF($orders){
        $pdfs = [];

        for ($i = 0; $i < sizeof($orders); $i++) {
            
            $order = $this-> getOrderById($orders[$i]);

            $pdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'orientation' => 'L',
                'default_font' => 'Ayar'
            ]);

            ob_start();

            require dirname(__FILE__)."/../views/templates/css/styleTemplate.css";

            $css = ob_get_clean();

            ob_start();

            require dirname(__FILE__)."/../views/templates/pdfTemplate.php";

            $template = ob_get_clean();

            $pdf -> WriteHTML( $css , \Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf -> WriteHTML( $template , \Mpdf\HTMLParserMode::HTML_BODY);

            $dirTemp = dirname(__FILE__) . '/../temp/pdf/';

            $pdf -> Output($dirTemp . 'Order-'.$order["number"].'.pdf' , 'F');

            array_push($pdfs , 'Order-'.$order["number"].'.pdf');
        }

        $this->createZIP($pdfs);
    }

    private function createZIP($pdfs){
        
        $dirTemp = dirname(__FILE__) . '/../temp/pdf/';
        $zipName = $dirTemp .'OrdersPDFs-'.date('j-n-y').'.zip';

        $zip = new ZipArchive;

        if ($zip->open($zipName , ZipArchive::CREATE) === TRUE) {
            
            foreach($pdfs as $pdf){
                $zip -> addFile($dirTemp . $pdf , $pdf );
            }
            $zip->close();
        }

        foreach($pdfs as $file){
            if(is_file($dirTemp.$file))
            unlink($dirTemp.$file);
        }

        $file_name = basename($zipName);

        $this -> downloadPdfs($zipName,$file_name);
    }

    private function downloadPDFS($zipName , $file_name){
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($zipName));
        readfile($zipName);
        unlink($zipName);
        exit;
    }

    


}
