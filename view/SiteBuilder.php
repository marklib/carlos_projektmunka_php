<?php
require_once 'constants/UrlUtil.php';
require_once 'service/UserService.php';

class SiteBuilder
{
    public function __construct($title) {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <title>' . $title . '</title>
                </head>
            <body>
            <h3>Logged in user: ' . UserService::getLoggedInUser() . '</h3>
        <nav>
		        <ul>
		            <li><div><a href="carListLoggedIn.html">Autólista</a></div></li>
		            <li><div class="selected"><a href="ownedCars.html">Saját autók</a></div></li>
		            <li><div><a href="' . UrlUtil::getRoutedUrl(UrlUtil::NAV_LOGOUT) . '">Kijelentkezés</a></div></li>
		            <li><div><a href="userSettings.html">Beállítások</a></div></li>
					<li><div><a href="statistics.html">Statisztika</a></div></li>
		        </ul>
		    </nav>';
    }

    function buildButton($name) {
        echo "<button>" . $name . "</button>";
    }

    function buildParagraph($value) {
        echo "<p>" . $value . "</p>";
    }

    function buildHeader1($value) {
        echo "<h1>" . $value . "</h1>";
    }

    public function __destruct() {
        echo "</body>
            </html>";
    }
}

?>