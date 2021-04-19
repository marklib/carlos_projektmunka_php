<?php
require_once 'SiteBuilder.php';
require_once 'model/User.php';

class UserSettingsView extends SiteBuilder {
    private $user = null;

    public function __construct() {
        parent::__construct('Felhasználói beállítások', 'userSettings.css');
    }

    function loadUserSettingsPanel($user) {
        if (isset($user)) {
            $this->user = $user;
        } else {
            $this->user = new User();
        }
        $type = 'userSettings';
        include 'templates/userPanelTemplate.php';
    }

    public function __destruct() {
        parent::__destruct();
    }
}