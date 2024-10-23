<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$codigo = $_POST['codigo'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$abreviatura = $_POST['abreviatura'] ?? null;
$stock = $_POST['stock'] ?? null;
$precioUnitario = $_POST['precioUnitario'] ?? null;

$productosObj->setCodigo($codigo);
$productosObj->setDescripcion($descripcion);
$productosObj->setAbreviatura($abreviatura);
$productosObj->setStock($stock);
$productosObj->setPrecioUnitario($precioUnitario);

$response = $productosObj->guardarProductos();

print json_encode($response);
