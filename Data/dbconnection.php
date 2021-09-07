<?php

include_once("db.php");

class DatabaseConnection{
    private static $connection;

    public static function getDatabase(){
        if(self::$connection == null){
        $url = "localhost";
        $user = "root";
        $passw = "";
        $db = "perceptor_simple";
            self::$connection = new Database($url, $user, $passw, $db);
        }
        return self::$connection;
    }
}

?>