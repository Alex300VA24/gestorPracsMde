<?php
require_once "../../config/DataBase.php";
include_once "../../models/Movimientos.php";

$movimientosObj = new Movimientos();

$descripcionProducto = $_GET['descripcion'] ?? null;

$response = $movimientosObj->listarMovimientos($descripcionProducto);

print json_encode($response);