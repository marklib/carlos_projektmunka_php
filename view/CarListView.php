<?php
require_once 'SiteBuilder.php';
require_once 'util/DBConnector.php';

class CarListView extends SiteBuilder
{
    public function __construct()
    {
        parent::__construct('Autólista', 'carList.css');
    }

    function loadCarList($loggedIn){
        include 'templates/carListTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}