<?php
require_once 'view/UserView.php';
require_once 'service/UserService.php';

class UserController
{

    static function initLogin() {
        $userView = new UserView("Bejelentkezés");
        $userView->loadLoginPanel();
    }

    static function login() {
        UserService::login();
    }

    static function logout() {
        UserService::logout();
    }
}