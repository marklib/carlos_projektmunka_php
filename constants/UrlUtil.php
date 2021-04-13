<?php

class UrlUtil
{
    const MAIN_URL = 'index.php';

    #POST operations
    const OPERATION_LOGIN = 'login';
    const OPERATION_LOGOUT = 'logout';

    #GET navigations
    const NAV_LOGIN = 'login';
    const NAV_LOGOUT = 'logout';

    static function getRoutedUrl($param) {
        return self::MAIN_URL . '?nav=' . $param;
    }

    static function redirectToUrl($param) {
        header('Location: ' . self::getRoutedUrl($param));
    }

    static function redirectHome() {
        header('Location: ' . self::MAIN_URL);
    }
}