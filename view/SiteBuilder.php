<?php
require_once 'util/UrlUtil.php';
require_once 'service/UserService.php';

class SiteBuilder
{
    public function __construct($title) {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <title>' . $title . '</title>
		            <link rel="stylesheet" type="text/css"  href="assets/css/login.css"/>
                </head>
            <body>
            <h3>Logged in user: ' . UserService::getLoggedInUser() . '</h3>';

        if (UserService::isUserLoggedIn()) {
            $this->buildLoggedInMenu();
        } else {
            $this->buildLoggedOutMenu();
        }
    }

    function buildLoggedInMenu() {
        echo '<header>
                <img src="assets/img/logo.png" alt="logo" id="logo">
                <nav>
                    <ul>
                        <li><div><a href="carListLoggedIn.html">Autólista</a></div></li>
                        <li><div class="selected"><a href="ownedCars.html">Saját autók</a></div></li>
                        <li><div><a href="' . UrlUtil::getRoutedUrl(UrlUtil::NAV_LOGOUT) . '">Kijelentkezés</a></div></li>
                        <li><div><a href="userSettings.html">Beállítások</a></div></li>
                        <li><div><a href="statistics.html">Statisztika</a></div></li>
                    </ul>
                </nav>
            </header>';
    }

    function buildLoggedOutMenu() {
        echo '<header>
                <img src="assets/img/logo.png" alt="logo" id="logo">
                <nav>
                    <ul>
                        <li><div><a href="index.html">Autólista</a></div></li>
                        <li><div class="selected"><a href="' . UrlUtil::getRoutedUrl(UrlUtil::NAV_LOGIN) . '">Bejelentkezés</a></div></li>
                        <li><div><a href="' . UrlUtil::getRoutedUrl(UrlUtil::NAV_REGISTRATION) . '">Regisztráció</a></div></li>
                    </ul>
                </nav>
            </header>';
    }

    public function __destruct() {
        echo "</body>
            </html>";
    }
}

?>