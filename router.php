<?php
require_once 'controller/UserController.php';
require_once 'util/UrlUtil.php';

class Router
{
    static function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::handlePost();
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::handleGet();
        }
    }

    private static function handleGet() {
        if (isset($_GET['nav'])) {
            $nav = $_GET['nav'];
            switch ($nav) {
                case UrlUtil::NAV_LOGIN:
                    UserController::initLogin();
                    break;
                case UrlUtil::NAV_LOGOUT:
                    UserController::logout();
                    break;
                case UrlUtil::NAV_REGISTRATION:
                    UserController::initRegistration();
                    break;
                case UrlUtil::NAV_USER_SETTINGS:
                    UserController::initUserSettings();
                    break;
                case UrlUtil::NAV_FORGOTTEN_PASSWORD:
                    UserController::initForgottenPassword();
                    break;
                default:
                    print('404');
            }
        } else {
            echo 'Autó listácska';
            return;
        }
    }

    private static function handlePost() {
        if (isset($_POST['operation'])) {
            $operation = $_POST['operation'];

            switch ($operation) {
                case UrlUtil::OPERATION_LOGIN:
                    UserController::login();
                    break;
                case UrlUtil::OPERATION_REGISTER:
                    UserController::register();
                    break;
                case UrlUtil::OPERATION_USER_SETTINGS_SAVE:
                    UserController::updateUser();
                    break;
                case UrlUtil::OPERATION_FORGOTTEN_PASSWORD:
                    UserController::sendForgottenPasswordEmail();
                    break;
            }
        }
    }


}

?>