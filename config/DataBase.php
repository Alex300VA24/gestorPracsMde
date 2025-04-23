<?php

class DataBase{
    /*private static $serverName = "DESKTOP-5ID39Q8\SQLSERVER2022";
    private static $database = "BDPROVALE";
    private static $username = "sa";
    private static $password = "sql";*/

    private static $serverName = "SGIS05\JHONATANMM";
    private static $database = "BDPROVALE";
    private static $username = "sa";
    private static $password = "sql";
    
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