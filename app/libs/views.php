<?php

namespace app\libs;

class Views{

    function __construct()
    {
        
    }

    function render($name , $data = []){
        
        $this -> data = $data;

        require_once __DIR__.'/../views/' . $name . '.php' ;
        
        
    }
}