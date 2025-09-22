<?php
require_once "../../config/DataBase.php";
include_once "../../models/Productos.php";

$codProducto = $_POST['codProducto'] ?? null;

$productoOjb = new Productos(0,'','',0,0,'',0);

$productoOjb->setCodProducto($codProducto);

$response = $productoOjb->inhabilitarProducto();

print json_encode($response);