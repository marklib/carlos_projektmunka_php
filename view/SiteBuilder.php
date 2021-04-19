<?php
require_once 'util/UrlUtil.php';
require_once 'service/UserService.php';

class SiteBuilder
{
    public function __construct($title, $cssFileName) {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <title>' . $title . '</title>
		            <link rel="stylesheet" type="text/css"  href="assets/css/' . $cssFileName . '"/>
                </head>
            <body>';

        if (UserService::isUserLoggedIn()) {
            $this->buildLoggedInMenu();
        } else {
            $this->buildLoggedOutMenu();
        }
        $this->buildAlert();
    }

    function buildLoggedInMenu() {
        echo '<header>
                <img src="assets/img/logo.png" alt="logo" id="logo">
                <nav>
                    <ul>';
        $this->buildMenuButton(UrlUtil::NAV_USER_SETTINGS, 'Beállítások');
        $this->buildMenuButton(UrlUtil::NAV_LOGOUT, 'Kijelentkezés');
        echo '</ul>
                </nav>
            </header>';
    }

    function buildLoggedOutMenu() {
        echo '<header>
                <img src="assets/img/logo.png" alt="logo" id="logo">
                <nav>
                    <ul>';
                    $this->buildMenuButton(UrlUtil::NAV_LOGIN, 'Bejelentkezés');
                    $this->buildMenuButton(UrlUtil::NAV_REGISTRATION, 'Regisztráció');
        echo '</ul>
                </nav>
            </header>';
    }

    function buildMenuButton($navParam, $title) {
        echo '<li><div ' . $this->buildSelectedClassForMenu($navParam) . ' ><a href="' . UrlUtil::getRoutedUrl($navParam) . '">' . $title . '</a></div></li>';
    }

    function buildSelectedClassForMenu($navParam) {
        if (UrlUtil::urlEquals($navParam)) {
            return 'class="selected"';
        } else {
            return null;
        }
    }

    public function buildAlert() {
        if (isset($_SESSION['alertColor']) && isset($_SESSION['alertText'])) {
            $color = $_SESSION['alertColor'];
            $text = $_SESSION['alertText'];
            echo '<div id="alert" style="background-color: ' . $color . '">
                    <h3><center>' . $text . '</center></h3>
                </div>';
            $_SESSION['alertColor'] = null;
            $_SESSION['alertText'] = null;
        }
    }

    public function __destruct() {
        echo "</body>
            </html>";
    }
}

?>