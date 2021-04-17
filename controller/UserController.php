<?php
require_once 'view/LoginView.php';
require_once 'view/RegistrationView.php';
require_once 'service/UserService.php';

class UserController
{

    static function initLogin() {
        $view = new LoginView("Bejelentkezés");
        $view->loadLoginPanel();
    }

    static function initRegistration() {
        $view = new RegistrationView("Regisztráció");
        $view->loadRegistrationPanel();
    }

    static function register() {
        UserService::registerUser();
    }

    static function login() {
        UserService::login();
    }

    static function logout() {
        UserService::logout();
    }
}