<?php
require_once 'util/UrlUtil.php';
require_once 'model/User.php';
require_once 'util/DBConnector.php';

class UserService
{
    static function login() {
        if (!isset($_SESSION['user'])) {
            $email = $_POST['emailInput'];
            $user = self::findUserByEmail($email);
            if (isset($user)) {
                $_SESSION['user'] = $user;
            } else {
                //TODO hibakezelés
            }
        }
        UrlUtil::redirectHome();
    }

    static function findUserByEmail($email) {
        $users = self::findAllUser();

        foreach($users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    private static function findAllUser() {
        $connector = new DBConnector();
        $userTable = "user";
        $users = array();

        $userRecords = $connector->getRecordsTable($userTable);
        foreach($userRecords as $record) {
            $users[] = self::createUserByRecord($record);
        }

        return $users;

    }

    private static function createUserByRecord($record) {
        $user = new User();
        $user->setId($record[0]);
        $user->setEmail($record[1]);
        $user->setPassword($record[2]);
        $user->setFullName($record[3]);
        $user->setPhoneNumber($record[4]);
        return $user;
    }

    static function registerUser() {
        $userTable = "user";
        $connector = new DBConnector();

        self::checkRegistration();
        $user = new User();
        $user->setId($connector->getLastId($userTable) + 1);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFullName($_POST['fullName']);
        $user->setPhoneNumber($_POST['phoneNumber']);
        self::saveNewUser($user);
    }

    private static function checkRegistration() {
        $message = "";
        $failed = false;
        if (!isset($_POST['email'])) {
            $message .= "Email cím nincs megadva!";
            $failed = true;
        }
        if (!isset($_POST['password'])) {
            $message .= "Jelszó nincs megadva!";
            $failed = true;
        }
        if (!isset($_POST['passwordAgain'])) {
            $message .= "Csak egyszer került a jelszó megadásra!";
            $failed = true;
        }
        if (isset($_POST['password']) !== isset($_POST['passwordAgain'])) {
            $message .= "A jelszavak nem egyeznek!";
            $failed = true;
        }
        if (!isset($_POST['fullName'])) {
            $message .= "Teljes név nincs megadva!";
            $failed = true;
        }
        if (!isset($_POST['phoneNumber'])) {
            $message .= "Telefonszám nincs megadva!";
            $failed = true;
        }
        //TODO hiba kiíratás
    }

    private static function saveNewUser($user) {
        $userTable = "user";
        $connector = new DBConnector();

        $params = array(
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "fullName" => $user->getFullName(),
            "phoneNumber" => $user->getPhoneNumber()
        );
        $connector->insert($userTable, $params);
    }

    static function logout() {
        $_SESSION['user'] = null;
        UrlUtil::redirectHome();
        session_unset();
        session_destroy();
    }

    static function getLoggedInUser() {
        if (self::isUserLoggedIn()) {
            return $_SESSION['user']->getEmail();
        } else {
            return "Nobody";
        }
    }

    static function isUserLoggedIn() {
        return isset($_SESSION['user']);
    }

}