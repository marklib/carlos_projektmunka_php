<?php


class MailUtil {
    static function sendEmail($email, $subject, $message) {
        mail($email, $subject, $message);
    }
}