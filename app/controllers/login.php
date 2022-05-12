<?php

namespace app\controllers;

use app\libs\Controllers;
use app\models\loginModel;
use app\classes\Session;

class login extends controllers{
    function __construct()
    {
        parent::__construct();
        $this -> view -> username = '';
        $this -> model = new loginModel;
    }

    function authenticate(){
        if ( $this -> existPOST(['email' , 'password'])){
            $email = $this-> getPOST('email');
            $password = $this-> getPOST('password');

            if ( $email == '' || empty($email) || $password == '' || empty($password) ){
                $this->redirect('' , []);
            }

            $user = $this -> model -> login($email , $password);

            if ($user != NULL){

                //TODO: INITIALIZITE USER
                $session = new Session;
                $session -> setCurrentUser($user);
                $this -> redirect("dashboard",[]);

            }
            else{
                $this->redirect('' , []);
            }
        }
        else{
            $this->redirect('' , []);
        }
    }

    
}