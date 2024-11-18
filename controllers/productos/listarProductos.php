<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$descripcionProducto = $_GET['descripcion'] ?? null;

$response = $productosObj->listarProductos($descripcionProducto);

print json_encode($response);
