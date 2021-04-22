<?php
require_once 'view/CarListView.php';
require_once 'view/NewCarView.php';
require_once 'view/CarModifyView.php';
require_once 'service/UserService.php';
require_once 'service/CarService.php';

class CarController{
    static function initCarList(){
        $view = new CarListView();
        if(UserService::isUserLoggedIn()){
            $view->loadCarList(true);
        }
        else{
            $view->loadCarList(false);
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
            $car = null;
            if (isset($_SESSION['carForm'])) {
                $car = $_SESSION['carForm'];
            }
            $view->loadNewCarPanel($car);
        }
        else {
            UrlUtil::redirectHome();
        }
    }

    static function initCarModify(){
        if (UserService::isUserLoggedIn()){
            $x = 0;
        }
        else{
            UrlUtil::redirectHome();
        }
    }

    static function newCar(){
        CarService::addNewCar();
    }
}