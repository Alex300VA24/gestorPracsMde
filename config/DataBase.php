<?php

class DataBase{
    private static $serverName = "localhost";
    private static $database = "BDPROVALE";
    private static $username = "sa";
    private static $password = "admin";
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