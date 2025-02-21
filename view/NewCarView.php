<?php
require_once 'SiteBuilder.php';
require_once 'model/Car.php';

class NewCarView extends SiteBuilder {
    private $car = null;

    public function __construct() {
        parent::__construct('Új autó', 'newCar.css');
    }

    function loadNewCarPanel() {
        $type = UrlUtil::OPERATION_NEW_CAR;
        include 'templates/carPanelTemplate.php';
    }

    public function __destruct() {
        parent::__destruct();
    }
}