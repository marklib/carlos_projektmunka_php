<?php
require_once 'SiteBuilder.php';
require_once 'util/DBConnector.php';

class LoginView extends SiteBuilder
{
    public function __construct()
    {
        parent::__construct('Bejelentkezés', 'login.css');
    }

    function loadLoginPanel() {
        include 'templates/loginPanelTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}