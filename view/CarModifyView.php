<?php

require_once 'SiteBuilder.php';
require_once 'model/Car.php';

class CarModifyView extends SiteBuilder
{
    private $car = null;

    public function __construct()
    {
        parent::__construct('Autó módosítása', 'newCar.css');
    }

    function loadNewCarPanel($car)
    {
        if (isset($car)) {
            $this->car = $car;
        } else {
            $this->car = new Car();
        }
        $type = UrlUtil::OPERATION_CAR_MODIFY;
        include 'templates/carPanelTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}