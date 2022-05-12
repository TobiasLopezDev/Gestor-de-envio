<?php
namespace app\classes;

class Session {

    private $sessionName = 'user';

    public function __construct(){

        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }

    }

    public function setCurrentUser($user){  $_SESSION[ $this -> sessionName ] = serialize($user);  }

    public function getCurrentUser(){   return $_SESSION[ $this -> sessionName ];   }

    public function exists (){          return isset (  $_SESSION[ $this -> sessionName ] );    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
    // header('location: ' . $_ENV['URL'] .'dashboard')

    // static public function validate(string $url,string $callback){
    //     $session = new Session;

    //     if($session -> exists() && $session ->getCurrentUser() != NULL){
            
    //     }else{
    //         if ($session -> isPublic($url)){
    //             return;
    //         }else{
    //             header('location: ' . $_ENV['URL'] . $callback);
    //         }
    //     }
    // }

    // private function getJSONFileConfig(){
    //     $string = file_get_contents("../config/access.json");
    //     $json = json_decode($string, true);

    //     return $json;
    // }

    // private function isPublic($url){

    //     $json = $this -> getJSONFileConfig();
    //     $currentURL = preg_replace( "/\?.*/", "", $url);

    //     var_dump($currentURL);
    //     exit();
    //     for($i = 0; $i < sizeof($this->sites); $i++){
    //         if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
    //             return true;
    //         }
    //     }
    // }

    // private function isAuthorized($url , $role){
    //     $currentURL = preg_replace( "/\?.*/", "", $url);
        
    //     for($i = 0; $i < sizeof($this->sites); $i++){
    //         if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    
}

?>