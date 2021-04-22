<?php
require_once 'SiteBuilder.php';
require_once 'util/DBConnector.php';
require_once 'model/Car.php';
require_once 'model/User.php';
require_once 'service/CarService.php';

class CarListView extends SiteBuilder
{
    public function __construct()
    {
        parent::__construct('Autólista', 'carList.css');
    }

    function loadCarList($type){
        include 'templates/carListTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}