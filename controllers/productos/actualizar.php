<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$codProducto = $_POST['codProducto'] ?? null;
$codigo = $_POST['codigo'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$abreviatura = $_POST['abreviatura'] ?? null;
$unidadMedida = $_POST['unidadMedida'] ?? null;


$productosObj->setCodProducto($codProducto);
$productosObj->setCodigo($codigo);
$productosObj->setDescripcion($descripcion);
$productosObj->setAbreviatura($abreviatura);
$productosObj->setUnidadMedida($unidadMedida);


$response = $productosObj->actualizarProductos();

print json_encode($response);
