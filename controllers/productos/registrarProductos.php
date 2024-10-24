<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$productosObj = new Productos();

$descripcion = $_POST['descripcion'] ?? null;
$abreviatura = $_POST['abreviatura'] ?? null;
$unidadMedida = $_POST['unidadMedida'] ?? null;



$productosObj->setDescripcion($descripcion);
$productosObj->setAbreviatura($abreviatura);
$productosObj->setUnidadMedida($unidadMedida);


$response = $productosObj->guardarProductos();

print json_encode($response);

//print json_encode([$descripcion, $abreviatura, $unidadMedida, $precioUnitario, $stock]);
