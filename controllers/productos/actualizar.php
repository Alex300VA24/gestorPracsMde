<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$codProducto = $_POST['codProducto'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$abreviatura = $_POST['abreviatura'] ?? null;
$codUnidadMedida = $_POST['unidadMedida'] ?? null;

$productosObj->setCodProducto($codProducto);
$productosObj->setDescripcion($descripcion);
$productosObj->setAbreviatura($abreviatura);
$productosObj->setCodUnidadMedida($codUnidadMedida);


$response = $productosObj->actualizarProductos();

print json_encode($response);
