<?php
require_once 'SiteBuilder.php';

class LoginView extends SiteBuilder
{
    public function __construct($title)
    {
        parent::__construct($title);
    }

    function loadLoginPanel() {
        include 'templates/loginPanelTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}