<?php 
namespace app\controllers;

use app\libs\Controllers;
use app\entity\userEntity;
use app\models\ordersModel;

class orders extends Controllers{
    public function __construct(userEntity $user)
    {
        parent::__construct();

        $this->user = $user;
        $this -> model = new ordersModel();
    }

    public function index(){

        $this-> model -> idTienda = $this -> user -> getTienda();

        $this->orders = $this-> model -> getAllOrders();

        $this->render('orders/index' , [
            'user' => $this->user , 
            'orders' => $this->orders['orders'] , 
            'orders-shipped' => $this->orders['orders-shippeds']]);
    }
}