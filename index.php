<?php
session_start();
require_once 'config/DataBase.php';
require_once "config/parameters.php";
require_once "views/layouts/head.php";
date_default_timezone_set('America/Lima');


if(isset($_SESSION["autenticado"])){
    require_once 'views/layouts/header.php';
    require_once 'views/layouts/content.php';

}else{
    echo 'no autenticado';
    var_dump(isset($_SESSION["autenticado"]));
    require_once 'views/login/index.php';
}

    require_once "views/layouts/footer.php";
?>
