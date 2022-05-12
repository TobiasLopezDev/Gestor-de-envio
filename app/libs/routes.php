<?php

use app\controllers\login;
use app\controllers\signup;
use app\controllers\dashboard;
use app\controllers\orders;
use app\controllers\single;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config');
$dotenv->load();


$router =  new \Bramus\Router\Router();
session_start();


$user = unserialize($_SESSION['user']);

$router->before('GET', '/', function() { 
    global $user;
    if($user){
        header('location: dashboard');
    }
});

$router -> get('/', function(){
    $controller = new login;
    $controller -> render('login/index');
});

$router -> post('/login', function(){

    $controller = new login;
    $controller -> authenticate();
});

$router->before('GET', '/signup', function() { 
    global $user;
    if($user){
        header('location: dashboard');
    }
});

$router -> get('/signup', function(){
    $controller = new signUp;
    $controller -> render('signup/index');
});

$router -> post('/register', function(){
    $controller = new signUp;
    $controller -> registerUser();
});

$router->before('GET', '/logout', function() { 
    global $user;
    if($user){
        header('location: /logout');
    }else{

        header('location: '.$_ENV['URL']);

    }
});

$router -> get('/logout', function(){
    session_unset();
    session_destroy();

    header('location: '.$_ENV['URL']);

});

$router->before('GET', '/dashboard', function() { 
    global $user;
    if(!$user){
        header('location: '.$_ENV['URL']);
    }
});

$router -> get('/dashboard', function(){

    $user = unserialize($_SESSION['user']);

    $controller = new Dashboard($user);

    $controller -> index($user);
});

$router->before('GET', '/orders', function() { 
    global $user;
    if(!$user){
        header('location: '.$_ENV['URL']);
    }
});

$router -> get('/orders', function(){

    $user = unserialize($_SESSION['user']);
    
    $controller = new orders($user);

    $controller -> index($user);
});

$router->before('GET', '/single/{orderId}', function() { 
    global $user;
    if(!$user){
        header('location: '.$_ENV['URL']);
    }
});

$router -> get('/single/{orderId}', function($orderId){
    global $user;
    $controller = new single($user);

    $controller -> index($orderId);

});






$router -> run();
