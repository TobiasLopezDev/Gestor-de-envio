<?php

namespace app\models;

use PDO;
use PDOException;

use app\libs\Models;
use app\entity\userEntity;

class loginModel extends Models{
    function __construct()
    {
        parent::__construct();
    }

    public function login($email , $password){

        try{

            $query = $this -> prepare('SELECT * FROM users WHERE email = :email') ;

            $query -> execute ([
                'email' => $email
            ]);

            if($query -> rowCount() == 1){
                $item = $query -> fetch( PDO::FETCH_ASSOC );

                $user = new userEntity();

                $user -> from ( $item );

                if (password_verify( $password , $user -> getPassword()  )){
                  // error_log( 'LoginModel::login -> Success' );
                    return $user;
                }
                else{
                  // error_log( 'LoginModel::login -> Failed' );
                    return NULL;
                }
            }

        }
        catch(PDOException $e){

          // error_log('login_Model::login -> PDO EXCEPTION -> '. $e);

            return false;
        }
    }
}