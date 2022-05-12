<?php
namespace app\entity;

use PDO;
use PDOException;
use app\libs\Models;

class userEntity extends Models{

    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $photo;
    private $name;
    private $tienda;

    public function __construct(){
        parent::__construct();

        $this -> username = '';
        $this -> setEmail = '';
        $this -> password = '';
        $this -> role = '';
        $this -> photo = '';
        $this -> name = '';
        $this -> tienda = '';
    }

    public function save(){

        try{
            $query = $this -> prepare('INSERT INTO users (username, email , password , role , photo , name , tienda) VALUES (:username , :email , :password , :role , :photo , :name , :tienda)');
            $query -> execute([
                'username'  => $this -> username,
                'email'     => $this -> email,
                'password'  => $this -> password,
                'role'      => $this -> role,
                'photo'     => $this -> photo,
                'name'      => $this -> name,
                'tienda'    => $this -> tienda

            ]);
            return true;
        }
        catch (PDOException $e){
            error_log('USERMODEL::SAVE -> PDOEXCEPTION : '. $e );
            return false;
        }

    }

    public function getAll(){

        $items = [];

        try {
            $query = $this -> query ('SELECT * FROM users');

            while ($p = $query -> fetch(PDO::FETCH_ASSOC) ){
                $item = new userEntity();
                $item -> setId($p['id']);
                $item -> setUsername($p['username']);
                $item -> setEmail($p['email']);
                $item -> setPassword($p['password']);
                $item -> setRole($p['role']);
                $item -> setPhoto($p['photo']);
                $item -> setName($p['name']);
                $item -> setTienda($p['tienda']);

                array_push($items , $item);
            }

            return $items;
        } 
        catch (PDOException $e) {
            error_log('USERMODEL::getAll -> PDOEXCEPTION : '. $e );
            return false;
        }

    }

    public function get($id){

        try {
            $query = $this->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($user['id']);
            $this->setUsername($user['username']);
            $this->setEmail($user['email']);
            $this->setPassword($user['password']);
            $this->setRole($user['role']);
            $this->setPhoto($user['photo']);
            $this->setName($user['name']);
            $this->setTienda($user['tienda']);

            return $this;

        } catch (PDOException $e) {
            error_log('USERMODEL::getID -> PDOEXCEPTION : ' . $e);
            return false;
        }
    }

    public function delete($id){

        try {

            $query = $this->prepare('DELETE * FROM users WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            return TRUE;

        } catch (PDOException $e) {
            error_log('USERMODEL::Delete -> PDOEXCEPTION : ' . $e);
            return FALSE;
        }

    }

    public function update(){

        try {
            $query = $this->prepare('UPDATE SET username = :username , password = :password , photo = :photo , name = :name WHERE id = :id');
            $query->execute([
                'id'        => $this -> id,
                'username'  => $this -> username,
                'password'  => $this -> password,
                'role'      => $this -> role,
                'photo'     => $this -> photo,
                'name'      => $this -> name
            ]);

            return TRUE;

        } catch (PDOException $e) {
            error_log('USERMODEL::update -> PDOEXCEPTION : ' . $e);
            return FALSE;
        }

    }

    public function from($array){

        $this -> id         = $array['id'];
        $this -> username   = $array['username'];
        $this -> email      = $array['email'];
        $this -> password   = $array['password'];
        $this -> role       = $array['role'];
        $this -> photo      = $array['photo'];
        $this -> name       = $array['name'];
        $this -> tienda     = $array['tienda'];

    }

    public function exists ($username){

        try {
            
            $query = $this -> prepare('SELECT username FROM users WHERE username = :username');
            $query -> execute ([
                'username' => $username
            ]);

            if ( $query -> rowCount() > 0){
                return TRUE;
            }
            else{
                return FALSE;
            }

        } catch (PDOException $e) {
            error_log('USERMODEL::exists -> PDOEXCEPTION : ' . $e);
            return FALSE;
        }

    }

    public function comparePasswords ($password , $id){
        try{

            $user = $this -> get($id);
            return password_verify( $password , $user -> getPassword() );
            
        }
        catch (PDOException $e) {
            error_log('USERMODEL::comparePasswords -> PDOEXCEPTION : ' . $e);
            return FALSE;
        }
    }

    private function getHashedPassword($password){

        return password_hash($password , PASSWORD_DEFAULT , ['cost' => 10]);

    }

    public function setId($id){                 $this -> id = $id;              }
    public function setUsername($username){     $this -> username = $username;  }
    public function setEmail($email){           $this -> email = $email;        }
    public function setRole($role){             $this -> role = $role;          }
    public function setPhoto($photo){           $this -> photo = $photo;        }
    public function setName($name){             $this -> name = $name;          }
    public function setTienda($tienda){         $this -> tienda = $tienda;      }

    public function setPassword($password){     $this -> password = $this -> getHashedPassword($password); }


    public function getId(){          return $this -> id;       }
    public function getUsername(){    return $this -> username; }
    public function getEmail(){       return $this -> email;    }
    public function getPassword(){    return $this -> password; }
    public function getRole(){        return $this -> role;     }
    public function getPhoto(){       return $this -> photo;    }
    public function getName(){        return $this -> name;     }
    public function getTienda(){      return $this -> tienda;   }


}