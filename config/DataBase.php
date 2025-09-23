<?php

class DataBase{
    private static $serverName = "localhost";
    private static $database = "gestorPracs";
    private static $username = "alex";
    private static $password = "admin123";
    
    public static function connect(){
        try {
            $conn = new PDO("sqlsrv:server=" . self::$serverName . ";Database=" . self::$database, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}