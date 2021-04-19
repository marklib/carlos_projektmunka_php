<?php
require_once 'SiteBuilder.php';
require_once 'util/DBConnector.php';

class ForgottenPasswordView extends SiteBuilder
{
    public function __construct()
    {
        parent::__construct('Elfelejtett jelszó', 'forgottenPassword.css');
    }

    function loadForgottenPasswordPanel() {
        include 'templates/forgottenPasswordView.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}