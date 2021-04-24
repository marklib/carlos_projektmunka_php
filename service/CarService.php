<?php
require_once 'model/Car.php';
require_once 'util/UrlUtil.php';
require_once 'model/User.php';
require_once 'util/DBConnector.php';
require_once 'util/AlertUtil.php';
require_once 'service/UserService.php';
require_once 'service/CarService.php';

class CarService{

    private static function saveNewCar($car) {
        $carTable = 'cars';
        $connector = new DBConnector();

        $params = array(
            $car->getCarId(),
            $car->getUserId(),
            $car->getName(),
            $car->getBrand(),
            $car->getFuelType(),
            $car->getCondition(),
            $car->getRentFrom()
        );
        $connector->insert($carTable, $params);
    }

    static function findAllCars() {
        $connector = new DBConnector();
        $carTable = 'cars';
        $cars = array();

        $carRecords = $connector->getRecordsTable($carTable);
        foreach($carRecords as $record) {
            $cars[] = self::createCarByRecord($record);
        }

        return $cars;
    }

    static function findCarById($carId){
        $connector = new DBConnector();
        $carTable = 'cars';

        $carRecords = $connector->getRecordsTable($carTable);
        foreach ($carRecords as $record){
            if($record[0] == $carId){
                return self::createCarByRecord($record);
            }
        }
        return null;
    }

    private static function createCarByRecord($record) {
        $car = new Car();
        $car->setCarId($record[0]);
        $car->setUserId($record[1]);
        $car->setName($record[2]);
        $car->setBrand($record[3]);
        $car->setFuelType($record[4]);
        $car->setCondition($record[5]);
        $car->setRentFrom($record[6]);
        return $car;
    }

    private static function checkCarForm() {
        $failed = false;
        if (!isset($_POST['name'])) {
            AlertUtil::showFailedAlert("Az autó típusa nincs megadva!");
            $failed = true;
        }
        if (!isset($_POST['brand'])) {
            AlertUtil::showFailedAlert("Az autó márkája nincs megadva!");
            $failed = true;
        }
        if (!isset($_POST['fuelType'])) {
            AlertUtil::showFailedAlert("Az üzemanyag nincs megadva!");
            $failed = true;
        }
        if (!isset($_POST['condition'])){
            AlertUtil::showFailedAlert("Az autó állapota nincs megadva!");
        }
        if (!isset($_POST['rentFrom'])){
            AlertUtil::showFailedAlert("Nincs megadva, mikortól bérelhető az autó!");
        }
        return !$failed;
    }

    static function addNewCar(){
        $carTable = 'cars';
        $connector = new DBConnector();

        $car = new Car();
        $car->setName($_POST['name']);
        $car->setBrand($_POST['brand']);
        $car->setFuelType($_POST['fuelType']);
        $car->setCondition($_POST['condition']);
        $car->setRentFrom($_POST['rentFrom']);
        /*if(isset($_POST['carPicture'])){
            $car->setPicture($_POST['carPicture']);
        }
        else{
            $car->setPicture("noPhoto.jpg");
        }*/
        if (self::checkCarForm()) {
            $car->setCarId($connector->getLastId($carTable) + 1);
            $car->setUserId(UserService::getLoggedInUser()->getId());
            self::saveNewCar($car);

            $_SESSION['carForm'] = null;
            AlertUtil::showSuccessAlert("Sikeres hozzáadás!");
            UrlUtil::redirectToUrl(UrlUtil::NAV_CAR_LIST);
        } else {
            $_SESSION['carForm'] = $car;
            UrlUtil::redirectToUrl(UrlUtil::NAV_REGISTRATION);
        }
    }

    static function findPhoneNumber($car){
        return UserService::findUserById($car->getUserId())->getPhoneNumber();
    }

    static function carModify(){
        $carTable = 'cars';
        $connector = new DBConnector();
        $cars = self::findAllCars();
        $car = new Car();

        foreach ($cars as $car){
            if($car->getCarId() == $_POST['carId']){
                $oldCar = $car;
                break;
            }
        }
        if(isset($_POST['name']) && $_POST['name'] != ''){
            $car->setName($_POST['name']);
        }
        if(isset($_POST['brand']) && $_POST['brand'] != ''){
            $car->setBrand($_POST['brand']);
        }
        if(isset($_POST['fuelType'])){
            $car->setFuelType($_POST['fuelType']);
        }
        if(isset($_POST['condition'])){
            $car->setCondition($_POST['condition']);
        }
        if(isset($_POST['rentFrom'])){
            $car->setRentFrom($_POST['rentFrom']);
        }
        $params = array(
            $car->getCarId(),
            $car->getUserId(),
            $car->getName(),
            $car->getBrand(),
            $car->getFuelType(),
            $car->getCondition(),
            $car->getRentFrom()
        );

        $connector->updateById($carTable, $car->getCarId(), $params);
        AlertUtil::showSuccessAlert("Sikeres módosítás!");
        $_SESSION['car'] = null;
        UrlUtil::redirectToUrl(UrlUtil::NAV_MY_CARS);
    }

    static function carDelete(){
        $carTable = 'cars';
        $carId = $_POST['carId'];
        $connector = new DBConnector();
        $connector->deleteRecordById($carTable, $carId);
        AlertUtil::showSuccessAlert("Sikeres törlés!");
        UrlUtil::redirectToUrl(UrlUtil::NAV_MY_CARS);
    }

}