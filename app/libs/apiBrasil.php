<?php

namespace app\libs;

class apiBrasil{

    public $curl;

    public function __construct()
    {

    }

    function createApi($distrito){
        $this -> urlBase = 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.$distrito.'/distritos';

        $this -> headers = [
            'Content-Type: application/json'
        ];

        $this -> Curl = curl_init();
    }

    function setGETCURL ($url = ''){
        curl_setopt($this -> Curl , CURLOPT_URL , $this -> urlBase .$url);
        curl_setopt($this -> Curl, CURLOPT_POST, false);
        curl_setopt($this -> Curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this -> Curl , CURLOPT_HTTPHEADER, $this -> headers );

        curl_setopt($this -> Curl , CURLOPT_RETURNTRANSFER , true);
        
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