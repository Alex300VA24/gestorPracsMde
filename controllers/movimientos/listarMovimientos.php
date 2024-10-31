<?php
require_once "../../config/DataBase.php";
include_once "../../models/Movimientos.php";

$movimientosObj = new Movimientos();

$codigo = $_GET['codigo'] ?? null;
$descripcionProducto = $_GET['descripcionProducto'] ?? null;


$response = $movimientosObj->listarMovimientos($codigo, $descripcionProducto);

print json_encode($response);