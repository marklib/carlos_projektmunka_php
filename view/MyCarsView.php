<?php
require_once 'SiteBuilder.php';
require_once 'model/Car.php';

class MyCarsView extends SiteBuilder{
    public function __construct()
    {
        parent::__construct('Saját autók', 'carList.css');
    }

    function loadCarList($loggedIn){
        include 'templates/carListTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}