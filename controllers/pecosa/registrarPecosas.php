<?php
require_once "../../config/DataBase.php";
include_once "../../models/Pecosas.php";
include_once "../../models/DetallePecosa.php";

$pecosasObj = new Pecosas();
$detallePecosaObj = new DetallePecosa();

$codAsociacion = $_POST['clubMadres'] ?? null;
$numeroPecosa = $_POST['numero'] ?? null;
$codSocioPresidenta = $_POST['presidenta'] ?? null;
$fechaReparto = $_POST['fechaReparto'] ?? null;
$observacion = $_POST['observacion'] ?? null;

$productosSeleccionadosTable = $_POST['productosSeleccionadosTable'] ?? null;
$codProducto = $_POST['descripcionProducto'] ?? null;
$prioridad = $_POST['prioridad'] ?? null;
$fechaDesde = $_POST['fechaDesde'] ?? null;
$fechaHasta = $_POST['fechaHasta'] ?? null;
$cantidad = $_POST['cantidad'] ?? null;
$precioUnitario = $_POST['precioUnitario'] ?? null;

$pecosasObj->setCodAsociacion($codAsociacion);
$pecosasObj->setNumeroPecosa($numeroPecosa);
$pecosasObj->setCodSocioPresidenta($codSocioPresidenta);
$pecosasObj->setFechaReparto($fechaReparto);
$pecosasObj->setObservacion($observacion);
$pecosasObj->setCodEstado(1);

$detallePecosaObj->setCodProducto($codProducto);
$detallePecosaObj->setPrioridad($prioridad);
$detallePecosaObj->setFechaDesde($fechaDesde);
$detallePecosaObj->setFechaHasta($fechaHasta);
$detallePecosaObj->setCantidad($cantidad);
$detallePecosaObj->setPrecioUnitario($precioUnitario);

$response = $pecosasObj->guardarPecosa();
$response = $detallePecosaObj->guardarDetallePecosa();

print json_encode($response);