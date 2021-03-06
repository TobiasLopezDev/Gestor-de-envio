<?php

namespace app\controllers;

use app\entity\userEntity;
use app\libs\Controllers;
use app\entity\customZonesEntity;
use app\libs\apiBrasil;

class settings extends Controllers
{

    function __construct(userEntity $user)
    {
        parent::__construct();
        $this->user = $user;
    }


    function index()
    {
        $customZones = new customZonesEntity();
        $customZones->id_tienda = $this->user->getTienda();

        $this->customZones = $customZones->getArrayAllZones();

        $this->render('settings/index', ['customZones' => $this->customZones]);
    }

    function getAllZone()
    {
        $customZones = new customZonesEntity();

        $allZones = $customZones->getAllZoneApi();

        return $allZones;
    }

    public function createZone()
    {

        if ($this->existPOST(['zonesSelected', 'zonesName'])) {
            $customZones = new customZonesEntity();
            $customZones->id_tienda = $this->user->getTienda();

            $zonas = $this->getPost('zonesSelected');
            $name  = $this->getPost('zonesName');

            $zonas = explode(",", $zonas);

            if ($zonas[0] ==  "" && empty($zonas[0])) {
                $res = ['status' => 404, 'data' => 'No hay datos para agregar'];
            } else {

                if ($customZones->createZone($name, $zonas)) {
                    $res = ['status' => 201, 'data' => 'Zona creada'];
                }
            }

            echo json_encode($res);
            return;
        }
    }

    public function deleteZone()
    {

        if ($this->existPOST(['idZone'])) {
          // error_log( $this->getPost('idZone'));
            $customZones = new customZonesEntity();
            $customZones->id_tienda = $this->user->getTienda();

            $idZone = $this->getPost('idZone');

            if ( $idZone ==  "" && empty( $idZone)) {
                $res = ['status' => 404, 'data' => 'No hay datos para eliminar'];
            } 
            else {
                $customZones->deleteId = $idZone;
                if ($customZones->deleteZone()) {
                    $res = ['status' => 201, 'data' => 'Zona eliminada'];
                }
                else{
                    $res = ['status' => 404, 'data' => 'Error al eliminar , intente de nuevo'];
                }
            }

            echo json_encode($res);
            return;
        }
    }

    public function userIndex(){
        $this->render('settings/user', ['user' => $this->user]);
    }
}
