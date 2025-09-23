<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$username = $_GET["user"];
$password = $_GET["password"];

$usuario = new Usuario();
$usuario->setNombreUsuario($username);
$usuario->setPassword($password);

$response = $usuario->autenticarUsuario();

error_log(print_r($response, true));
print json_encode($response);