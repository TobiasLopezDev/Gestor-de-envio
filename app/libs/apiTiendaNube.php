<?php

namespace app\libs;

use PDO;
use PDOException;

use app\libs\Database;

class apiTiendaNube{

    public function __construct(){
        $this -> db = new Database ();

        $this -> UserAgent = 'Gestor de Envios (tobiasdev21@gmail.com)';

    }
    
    function getAuth($id){

        try{
            $query = $this -> db -> connect() -> prepare('SELECT * FROM `tiendas` WHERE `ID` = :id') ;

            $query -> execute ([
                'id' => $id
            ]);

            if($query -> rowCount() == 1){
                $item = $query -> fetch( PDO::FETCH_ASSOC );

                $this -> createApi($item);
            }
        }
        catch(PDOException $e){

          // error_log('Api_Tienda_Nube::getAuth -> PDO EXCEPTION -> '. $e);

            return false;
        }

       
    }

    function createApi($data){
        $this -> auth = $data ["ACCESS_TOKEN"];
        $this -> tienda_id = $data ["USER_ID"];

        $this -> urlBase = 'https://api.tiendanube.com/v1/'. $this -> tienda_id.'/';

        $this -> headers = [
            'Authentication: bearer '. $this -> auth,
            'Content-Type: application/json',
            'User-Agent: ' . $this -> UserAgent
        ];

        $this -> Curl = curl_init();

    }

    function setPOSTCURL ($url , $postdata){
        curl_setopt($this -> Curl , CURLOPT_URL , $this -> urlBase .$url);
        curl_setopt($this -> Curl, CURLOPT_POST, true);
        curl_setopt($this -> Curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this -> Curl , CURLOPT_HTTPHEADER, $this -> headers );

        curl_setopt($this -> Curl , CURLOPT_POSTFIELDS , $postdata);

        curl_setopt($this -> Curl , CURLOPT_RETURNTRANSFER , true);

    }

    function setGETCURL ($url){
        curl_setopt($this -> Curl , CURLOPT_URL , $this -> urlBase .$url);
        curl_setopt($this -> Curl, CURLOPT_POST, false);
        curl_setopt($this -> Curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this -> Curl , CURLOPT_HTTPHEADER, $this -> headers );

        curl_setopt($this -> Curl , CURLOPT_RETURNTRANSFER , true);
        
    }

    function setDELETECURL($url){

        curl_setopt($this -> Curl , CURLOPT_URL , $this -> urlBase .$url);
        curl_setopt($this -> Curl, CURLOPT_POST, false);
        curl_setopt($this -> Curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this -> Curl , CURLOPT_HTTPHEADER, $this -> headers );

        curl_setopt($this -> Curl , CURLOPT_RETURNTRANSFER , true);

        curl_setopt($this -> Curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    function executeCURL(){
        // error_log('Api_Tienda_Nube::executeCURL -> CURL EXECUTED');
        return curl_exec ($this -> Curl);
    }

    function closeCURL(){
        curl_close ($this -> Curl);
    }

}

?>