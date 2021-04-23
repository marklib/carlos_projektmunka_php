<?php
require_once 'SiteBuilder.php';
require_once 'util/DBConnector.php';
require_once 'model/Car.php';
require_once 'model/User.php';
require_once 'service/UserService.php';
require_once 'util/UrlUtil.php';
require_once 'util/AlertUtil.php';

class CarDeleteView extends SiteBuilder{
    public function __construct()
    {
        parent::__construct('Saját autók', 'myCars.css');
    }

    function loadCarList($type, $carId){
        include 'templates/carListTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}