<?php
require_once 'SiteBuilder.php';

class UserView extends SiteBuilder
{
    public function __construct($title)
    {
        parent::__construct($title);
    }

    function loadLoginPanel() {
        include 'loginPanel.php';
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}