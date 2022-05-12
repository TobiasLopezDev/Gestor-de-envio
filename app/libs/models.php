<?php

namespace app\libs;

use app\libs\database;
use app\libs\apiTiendaNube;
use app\libs\apiBrasil;

class Models
{
    private $db;
    private $TiendaNube;
    private $Brasil;

    public function __construct()
    {
        $this->db = new Database;
        $this -> TiendaNube = new apiTiendaNube;
        $this->Brasil = new apiBrasil;
    }
    
    function api($id){
        
        $this -> TiendaNube -> getAuth($id);
       
   }

   function query($query){
       return $this -> db  -> connect() -> query($query);
   }

   function prepare($query){
       return $this -> db  -> connect() -> prepare($query);
   }

   function prepareAPIGet($id , $url){
       $this -> TiendaNube -> getAuth($id);
       $this -> TiendaNube -> setGETCURL ($url) ;
   }

   function prepareAPIPost($id , $url , $data){
       $this -> TiendaNube -> getAuth($id);
       $this -> TiendaNube -> setPOSTCURL ($url , $data) ;
   }

   function prepareAPIDelete($id , $url){
       
       $this -> TiendaNube -> getAuth($id);
       $this -> TiendaNube -> setDELETECURL ($url) ;
   }

   function executeAPI (){
       return json_decode ( $this -> TiendaNube -> executeCURL() , true);
   }

   function deleteAPI (){
       return $this -> TiendaNube -> closeCURL();
   }

   function ordersFilterBy($params , $filter , $value){

       $nparams = sizeof($params);

       $newparams = [];
       for ($i=0; $i < $nparams; $i++) { 
           
               if ($params[$i][$filter] == $value){
                   array_push($newparams, $params[$i]);
               }

       }
       return $newparams;
   }
   

}