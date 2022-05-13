<?php

namespace app\controllers;

use app\libs\Controllers;
use app\entity\userEntity;

class signUp extends Controllers{

    function __construct()
    {
        parent::__construct();
    }

    public function registerUser(){

        if($this -> existPOST ( ['username' , 'password' , 'email'] ) ){

            $username = $this   -> getPOST('username');
            $email    = $this   -> getPOST('email');
            $password = $this   -> getPOST('password');

            if ($username == '' || empty($username) || $email == '' || empty($email) || $password == '' || empty($password) ){
                // $this->redirect('signup' , ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
                $this->redirect('signup' , ['error' => 'completa los campos imbecil']);

                // TODO:redireccionar a signup error vacio
            }

            $user = new userEntity();

            $user -> setUsername($username);
            $user -> setPassword($password);
            $user -> setEmail($email);
            $user -> setTienda(9);
            $user -> setRole('User');

            if($user -> exists($username) ){
                // $this->redirect("signup" , ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_USERNAME_EXISTS]);
                // TODO:redireccionar a signup usernameExits
                $this->redirect('signup' , ['error' => 'Ya existe el usuario']);
               
            }
            else{
                if ($user -> save()){
                    $this->redirect("" , []);
                     // TODO: success message

                }
                else{
                    // $this->redirect("signup" , ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_SAVE_ERROR]);
                    // TODO: Erro de guardado
                    $this->redirect('signup' , ['error' => 'LLAMA YA AL DEV MOSTRO']);
                }
            }

            


        }else{

            // $this->redirect("signup" , ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);

            $this->redirect('signup' , ['error' => 'perdon que estas haciendo?']);

        }

    }


}