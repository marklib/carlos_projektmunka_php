<?php
require_once 'util/UrlUtil.php';
require_once 'model/User.php';
require_once 'util/DBConnector.php';
require_once 'util/AlertUtil.php';

class UserService
{
    static function login() {
        if (!isset($_SESSION['user'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = self::findUserByEmail($email);
            if ($user != null && $user->getPassword() === $password) {
                $_SESSION['user'] = $user;
                AlertUtil::showSuccessAlert("Sikeres bejelentkezés!");
                UrlUtil::redirectHome();
            } else {
                AlertUtil::showFailedAlert("Hibás felhasználónév vagy email cím!");
                UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
            }
        }
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

    static function findUserById($id) {
        $users = self::findAllUser();

        foreach($users as $user) {
            if ($user->getId() === $id) {
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

    static function sendForgottenPasswordEmail() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = self::findUserByEmail($email);
            if ($user != null) {
                $message = "Tisztelt Felhasználó!\n\nA(z) " . $email . " email címhez tartozó jelszó a következő: " . $user->getPassword() . "\n\nÜdvözlettel, A Carlos csapata!";
//                MailUtil::sendEmail($email, 'Elfelejtett jelszó', $message);
//                FIXME Az email küldés funkció csak egy későbbi verzióban lesz bekötve
            }
        }
        AlertUtil::showSuccessAlert("Kiküldtük a jelszó emlékeztetőt! Perceken belül megtekinthetőnek kell lennie, amennyiben tartozik az email címhez felhasználói fiók!");
        UrlUtil::redirectHome();
    }

    static function updateUser() {
        $user = self::findUserById($_SESSION['user']->getId());
        $user->setEmail($_POST['email']);
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $user->setPassword($_POST['password']);
        } else {
            $user->setPassword($user->getPassword());
        }
        $user->setFullName($_POST['fullName']);
        $user->setPhoneNumber($_POST['phoneNumber']);
        if (self::checkUserForm()) {
            self::modifyUser($user);
            $_SESSION['userForm'] = null;
            $_SESSION['user'] = $user;
            AlertUtil::showSuccessAlert("Sikeres módosítás!");
            UrlUtil::redirectHome();
        } else {
            $_SESSION['userForm'] = $user;
            UrlUtil::redirectToUrl(UrlUtil::NAV_USER_SETTINGS);
        }
    }

    static function registerUser() {
        $userTable = "user";
        $connector = new DBConnector();

        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFullName($_POST['fullName']);
        $user->setPhoneNumber($_POST['phoneNumber']);
        if (self::checkUserForm()) {
            $user->setId($connector->getLastId($userTable) + 1);
            self::saveNewUser($user);

            $_SESSION['userForm'] = null;
            AlertUtil::showSuccessAlert("Sikeres regisztráció!");
            UrlUtil::redirectToUrl(UrlUtil::NAV_LOGIN);
        } else {
            $_SESSION['userForm'] = $user;
            UrlUtil::redirectToUrl(UrlUtil::NAV_REGISTRATION);
        }
    }

    private static function checkUserForm() {
        $failed = false;
        if (!isset($_POST['phoneNumber']) || empty($_POST['phoneNumber'])) {
            AlertUtil::showFailedAlert("Telefonszám nincs megadva!");
            $failed = true;
        }
        if (!preg_match('/^((?:[03])6)?(?(?=([237]0|1))([237]0|1)(\d{7})|(2[2-9]|3[2-7]|4[024-9]|5[234679]|6[23689]|7[2-9]|8[02-9]|9[92-69])(\d{6}))$/', $_POST['phoneNumber'])) {
            AlertUtil::showFailedAlert("Hibás telefonszám! Példa jó telefonszámra: 06701234567");
            $failed = true;
        }
        if (!isset($_POST['fullName']) || empty($_POST['fullName'])) {
            AlertUtil::showFailedAlert("Teljes név nincs megadva!");
            $failed = true;
        }
        if (!isset($_POST['passwordAgain']) || empty($_POST['passwordAgain'])) {
            AlertUtil::showFailedAlert("Csak egyszer került a jelszó megadásra!");
            $failed = true;
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            AlertUtil::showFailedAlert("Jelszó nincs megadva!");
            $failed = true;
        }
        if ($_POST['password'] !== $_POST['passwordAgain']) {
            AlertUtil::showFailedAlert("A jelszavak nem egyeznek!");
            $failed = true;
        }
        if (!preg_match("#[a-zA-Z]+#", $_POST['password'])) {
            AlertUtil::showFailedAlert("A jelszónak legalább egy betűt kell tartalmaznia!");
            $failed = true;
        }
        if (!preg_match("#[0-9]+#", $_POST['password'])) {
            AlertUtil::showFailedAlert("A jelszónak legalább egy számot kell tartalmaznia!");
            $failed = true;
        }
        if (strlen($_POST['password']) < 8) {
            AlertUtil::showFailedAlert("A jelszónak legalább 8 karakteresnek kell lennie!");
            $failed = true;
        }
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            AlertUtil::showFailedAlert("Email cím nincs megadva!");
            $failed = true;
        }
        if (self::findUserByEmail($_POST['email']) != null) {
            AlertUtil::showFailedAlert("Ez az e-mail cím már foglalt!");
            $failed = true;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            AlertUtil::showFailedAlert("Érvénytelen e-mail cím!");
            $failed = true;
        }
        return !$failed;
    }

    private static function modifyUser($user) {
        $userTable = 'user';
        $connector = new DBConnector();

        $params = array(
            $user->getId(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getFullName(),
            $user->getPhoneNumber()
        );
        $connector->updateById($userTable, $user->getId(), $params);
    }

    private static function saveNewUser($user) {
        $userTable = "user";
        $connector = new DBConnector();

        $params = array(
            $user->getId(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getFullName(),
            $user->getPhoneNumber()
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
            return $_SESSION['user'];
        } else {
            return null;
        }
    }

    static function isUserLoggedIn() {
        return isset($_SESSION['user']);
    }

}