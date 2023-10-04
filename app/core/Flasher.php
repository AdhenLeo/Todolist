<?php 

class Flasher {
    public static function setFlash($type, $message)
    {
        $_SESSION['flash'] = [
            "type" => $type,
            "message" => $message
        ];
    }

    public static function has ($type) 
    {
        if (isset($_SESSION['flash'])) return $_SESSION['flash']["type"] === $type;
    }

    public static function get ($type)
    {
        echo $_SESSION['flash']['type'] === $type ? $_SESSION['flash']['message'] : null;
        unset($_SESSION['flash']);
    }
}