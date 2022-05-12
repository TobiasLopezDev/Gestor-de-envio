<?php

use app\controllers\login;
use app\controllers\signup;
use app\controllers\dashboard;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config');
$dotenv->load();


$router =  new \Bramus\Router\Router();
session_start();




// $router->before('GET', '/', function() { 
//     global $user;
//     if($user){
//         //$user = unserialize($_SESSION['user']);
//         header('location: dashboard');
//     }else{

//         header('location: '.$_ENV['URL']);

//     }
// });

$router -> get('/', function(){
    $controller = new login;
    $controller -> render('login/index');
});

$router -> post('/login', function(){

    $controller = new login;
    $controller -> authenticate();
});

$router -> get('/signup', function(){
    $controller = new signUp;
    $controller -> render('signup/index');
});

$router -> post('/register', function(){
    $controller = new signUp;
    $controller -> registerUser();
});

$router -> get('/logout', function(){
    session_unset();
    session_destroy();

    header('location: '.$_ENV['URL']);

});

$router -> get('/dashboard', function(){

    $user = unserialize($_SESSION['user']);

    $controller = new Dashboard($user);

    $controller -> index($user);


    
});




$router -> run();
