<?php

namespace app\libs;

use app\libs\Views;

class Controllers {

    private $view;

    public function __construct(){
        $this -> view = new Views();
    }

    public function render(string $name , array $data = []){
        $this -> view -> render($name , $data);
    }

    public function existPOST($params){
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
              // error_log("ExistPOST: No existe el parametro $param" );
                return false;
            }
        }
        return true;
    }

    public function existGET($params){
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    public function getGet($name){
        return $_GET[$name];
    }

    public function getPost($name){
        return $_POST[$name];
    }

    function redirect($url, $mensajes = []){
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data); 
        
        if($params != ''){
            $params = '?' . $params;
        }
        header('location: ' . $_ENV['URL'] . $url . $params);
    }
}

?>