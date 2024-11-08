<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$descripcionProducto = $_GET['descripcionProducto'] ?? null;
$codUnidadMedida = $_GET['codUnidadMedida'] ?? null;


$response = $productosObj->listarProductos($descripcionProducto, $codUnidadMedida);

print json_encode($response);
