<?php
require_once 'view/LoginView.php';
require_once 'view/RegistrationView.php';
require_once 'view/UserSettingsView.php';
require_once 'view/ForgottenPasswordView.php';
require_once 'service/UserService.php';

class UserController
{

    static function initLogin() {
        if (!UserService::isUserLoggedIn()) {
            $view = new LoginView();
            $view->loadLoginPanel();
        } else {
            UrlUtil::redirectHome();
        }
    }

    static function initRegistration() {
        if (!UserService::isUserLoggedIn()) {
            $view = new RegistrationView();
            $user = null;
            if (isset($_SESSION['userForm'])) {
                $user = $_SESSION['userForm'];
            }
            $view->loadRegistrationPanel($user);
        } else {
            UrlUtil::redirectHome();
        }
    }

    static function initUserSettings() {
        if (UserService::isUserLoggedIn()) {
            $view = new UserSettingsView();
            $user = UserService::getLoggedInUser();
            $view->loadUserSettingsPanel($user);
        } else {
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
        }
    }

    static function initForgottenPassword() {
        if (!UserService::isUserLoggedIn()) {
            $view = new ForgottenPasswordView();
            $view->loadForgottenPasswordPanel();
        } else {
            UrlUtil::redirectHome();
        }
    }

    static function sendForgottenPasswordEmail() {
        UserService::sendForgottenPasswordEmail();
    }

    static function updateUser() {
        UserService::updateUser();
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