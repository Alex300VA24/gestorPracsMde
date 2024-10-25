<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$codigo = $_GET['codigo'] ?? null;
$descripcionProducto = $_GET['descripcionProducto'] ?? null;


$response = $productosObj->listarProductos($codigo, $descripcionProducto);

print json_encode($response);
