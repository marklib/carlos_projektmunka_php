<?php
require_once 'constants/UrlUtil.php';

class UserService
{
    static function login() {
        if (!isset($_SESSION['email'])) {
            $_SESSION['email'] = $_POST['emailInput'];
        }
        UrlUtil::redirectHome();
    }

    static function logout() {
        $_SESSION['email'] = null;
        UrlUtil::redirectHome();
        session_unset();
        session_destroy();
    }

    static function getLoggedInUser() {
        if (isset($_SESSION['email'])) {
            return $_SESSION['email'];
        } else {
            return "Nobody";
        }
    }

}