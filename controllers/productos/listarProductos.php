<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$descripcionProducto = $_GET['descripcionProducto'] ?? null;
$abreviatura = $_GET['abreviatura'] ?? null;
$unidadMedida = $_GET['unidadMedida'] ?? null;

$response = $productosObj->listarProductos($descripcionProducto, $abreviatura, $unidadMedida);

print json_encode($response);
