<?php


class AlertUtil {
    const failedRed = "#ff551c";
    const succeededGreen = "#16de4f";

    static function showFailedAlert($text) {
        self::showAlert(self::failedRed, $text);
    }

    static function showSuccessAlert($text) {
        self::showAlert(self::succeededGreen, $text);
    }

    private static function showAlert($color, $text) {
        $_SESSION['alertColor'] = $color;
        $_SESSION['alertText'] = $text;
    }
}