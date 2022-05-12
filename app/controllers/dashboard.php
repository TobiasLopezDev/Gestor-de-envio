<?php
namespace app\controllers;

use app\libs\Controllers;
use app\entity\userEntity;

class Dashboard extends Controllers{
    public function __construct(userEntity $user)
    {
        parent::__construct();

        $this->user = $user;

    }

    public function index(){
        $this->render('dashboard/index' , ['user' => $this->user]);
    }
}