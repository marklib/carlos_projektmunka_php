<?php
require_once 'view/CarListView.php';
require_once 'view/NewCarView.php';
require_once 'view/CarModifyView.php';
require_once 'view/MyCarsView.php';
require_once 'service/UserService.php';
require_once 'service/CarService.php';
require_once 'view/CarDeleteView.php';

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
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
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
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
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
            $view->loadCarModifyPanel($carId);
        }
        else{
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
        }
    }

    static function initCarDelete($carId){
        $cars = CarService::findAllCars();
        $own = false;
        foreach ($cars as $car){
            if($car->getCarId() == $carId && $car->getUserId() == UserService::getLoggedInUser()->getId()){
                $own = true;
            }
        }
        if (UserService::isUserLoggedIn() && $own == true){
            $view = new CarDeleteView();
            $view->loadCarList('deleteCar',$carId);
        }
        else{
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
        }
    }

    static function newCar(){
        CarService::addNewCar();
    }

    static function carModify(){
        CarService::carModify();
    }

    static function carDelete(){
        CarService::carDelete();
    }
}