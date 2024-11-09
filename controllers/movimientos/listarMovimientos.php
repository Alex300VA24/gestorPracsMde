<?php
require_once "../../config/DataBase.php";
include_once "../../models/Movimientos.php";

$movimientosObj = new Movimientos();

$descripcionProducto = $_GET['descripcionProducto'] ?? null;
$codUnidadMedida = $_GET['codUnidadMedida'] ?? null;

$response = $movimientosObj->listarMovimientos($descripcionProducto, $codUnidadMedida);

print json_encode($response);