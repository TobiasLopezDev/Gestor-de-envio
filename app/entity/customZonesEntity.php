<?php
namespace app\entity;

use PDO;
use PDOException;
use app\libs\Models;

class customZonesEntity extends Models {

    public $setting_key;

    public $setting_value;

    public $id_tienda;

    function __construct()
    {
        parent::__construct();
    }

    function createZone($name , $zones){
        try{
            $this -> setting_key = "Custom_Zone";
            $array = ['name' => $name , "zones" => json_encode ($zones)];
            $this -> setting_value = json_encode($array);

            $query = $this -> prepare('INSERT INTO settings ( setting_key , setting_value , id_tienda) VALUES ( :setting_key , :setting_value , :id_tienda)');
            $query -> execute([
                'setting_key'    => $this -> setting_key,
                'setting_value'  => $this -> setting_value,
                'id_tienda'      => $this -> id_tienda

            ]);

            return true;
        }
        catch (PDOException $e){
            error_log('USERMODEL::SAVE -> PDOEXCEPTION : '. $e );
            return false;
        }
    }

    function getCustomZone(){
        try{
            $this -> setting_key = "Custom_Zone";

            $query = $this -> prepare('SELECT * FROM `settings` WHERE `setting_key` LIKE :setting_key AND `id_tienda` = :id_tienda ');
            $query -> execute([
                'setting_key'    => $this -> setting_key,
                'id_tienda'      => $this -> id_tienda

            ]);

            $items = [];

            while ($p = $query -> fetch(PDO::FETCH_ASSOC) ){
                $zone = ['id' => $p['id'], 'value' => json_decode( $p['setting_value'])];

                array_push($items , $zone);
            }

            return $items;

        }
        catch (PDOException $e){
            error_log('USERMODEL::SAVE -> PDOEXCEPTION : '. $e );
            return false;
        }
    }

    function getArrayAllZones(){

        $custom_zones = $this -> getCustomZone();

        $todasZonas = [];

        for ($i=0; $i < sizeof($custom_zones) ; $i++) { 
            $zona = ['id' => $custom_zones[$i]['id'],'nombre' => $custom_zones[$i]['value'] -> name , 'zonas' => json_decode($custom_zones[$i]['value'] -> zones)];

            
            array_push($todasZonas , $zona);
        }

        return $todasZonas;

    }

    function addCustomZonesToOrder($order){

        $nparams = sizeof($order);

        $todasZonas = $this -> getArrayAllZones();

            for($x = 0 ; $x < sizeof($todasZonas) ; $x++){

                foreach($todasZonas[$x]['zonas'] as $key => $value){
                    if ($value == $order['shipping_address']['locality']){
                        $order['custom_zone'] =  $todasZonas[$x]['nombre'];
                    }

                }

            }

            if (!array_key_exists('custom_zone' , $order)){
                $order['custom_zone'] = 'Sin zona personalizada especificada';
            }

        
        return $order;
        
    }
    
}