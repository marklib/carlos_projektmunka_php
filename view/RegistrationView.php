<?php
require_once 'SiteBuilder.php';

class RegistrationView extends SiteBuilder
{
    public function __construct($title)
    {
        parent::__construct($title);
    }

    function loadRegistrationPanel() {
        include 'templates/registrationPanelTemplate.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}