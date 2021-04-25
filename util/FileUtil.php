<?php

class FileUtil{
    const TARGET_DIR = 'carPictures/';

    static function upload($file){
        if(self::checkSize($file)){
            $fileName = $file['name'];
            if (file_exists(self::TARGET_DIR . $fileName)) {
                $extension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                $fileName = 0;
                while (file_exists(self::TARGET_DIR . $fileName . '.' . $extension)) {
                    $fileName++;
                }
                $fileName = $fileName . '.' . $extension;
            }
            if (move_uploaded_file($file['tmp_name'], self::TARGET_DIR . $fileName)) {
                return self::TARGET_DIR . $fileName;
            } else {
                return false;
            }
        }
        return false;
    }

    static function checkSize($file){
        if($file['size'] <= 3000000){
            return true;
        }
        return false;
    }

}