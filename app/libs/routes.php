<?php

use app\controllers\login;
use app\controllers\signup;
use app\controllers\dashboard;
use app\controllers\orders;
use app\controllers\single;

use app\controllers\settings;
use app\entity\ordersEntity;

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

$router -> post('/orders/createShippings', function(){
    
    $user = unserialize($_SESSION['user']);
    
    $controller = new orders($user);
    
    $controller -> createShippings($_POST);
    
});

$router -> post('/orders/createFulfillments', function(){
    
    $user = unserialize($_SESSION['user']);
    
    $controller = new orders($user);

    $controller -> createFulfillments($_POST);
    
});

$router -> post('/orders/genXLSX', function(){
    
    $user = unserialize($_SESSION['user']);
    
    $controller = new orders($user);

    $controller -> createXLSX($_POST);
    
});
$router -> post('/orders/genPDF', function(){
    
    $user = unserialize($_SESSION['user']);
    
    $controller = new orders($user);

    $controller -> createPDF($_POST);
    
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

$router -> post('/single/deletefulfillments', function(){
    global $user;
    $controller = new single($user);

    $controller -> deleteFulfill($_POST);

});

$router->before('GET|POST', '/settings' ,function() { 
    global $user;
    if(!$user){
        header('location: '.$_ENV['URL']);
    }
});

$router -> get('/settings', function(){
    global $user;

    $controller = new settings($user);

    $controller -> index();

});

$router -> get('/settings/getallzone', function (){
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json; charset=utf-8');
    global $user;
    $controller = new settings($user);

   echo ($controller -> getAllZone());
});

$router -> post('/settings/createZone', function (){
    global $user;
    $controller = new settings($user);
    $controller -> createZone();
});

$router -> get('/download/{filename}', function($filename){
    global $user;

    $controller = new orders($user);
    $file = 'C:\xampp\htdocs\gestor-final\app\entity/../temp/xlsx/'.$filename;

    $controller -> downloadXLSX($file , $filename);

});

$router -> get('/pdf' , function (){
    $test = new ordersEntity(9);
    $pdfs = $test -> genPDF([561938161,556922930]);

    var_dump($pdfs);
});





$router -> run();
