<?php
require_once 'view/CarListView.php';
require_once 'view/NewCarView.php';
require_once 'view/CarModifyView.php';
require_once 'view/MyCarsView.php';
require_once 'service/UserService.php';
require_once 'service/CarService.php';

class CarController{
    static function initCarList(){
        $view = new CarListView();
        if(UserService::isUserLoggedIn()){
            $view->loadCarList('yes');
        }
        else{
            $view->loadCarList('no');
        }
    }

    static function initMyCars(){
        if(UserService::isUserLoggedIn()){
            $view = new MyCarsView();
            $view->loadCarList('myCars');
        }
        else {
            UrlUtil::redirectHome();
        }
    }


    static function initNewCar() {
        if (UserService::isUserLoggedIn()) {
            $view = new NewCarView();
            //$car = null;
            //if (isset($_SESSION['carForm'])) {
            //    $car = $_SESSION['carForm'];
            //}
            $view->loadNewCarPanel();
        }
        else {
            UrlUtil::redirectHome();
        }
    }

    static function initCarModify($carId){
        $cars = CarService::findAllCars();
        $own = false;
        foreach ($cars as $car){
            if($car->getCarId() == $carId && $car->getUserId() == UserService::getLoggedInUser()->getId()){
                $own = true;
            }
        }
        if (UserService::isUserLoggedIn() && $own == true){
            $view = new CarModifyView();
            //if (isset($_SESSION['carForm'])) {
            //    $car = $_SESSION['carForm'];
            //}
            $view->loadCarModifyPanel($carId);
        }
        else{
            UrlUtil::redirectHome();
        }
    }

    static function newCar(){
        CarService::addNewCar();
    }

    static function carModify(){
        CarService::carModify();
    }
}