<?php
require_once "../../config/DataBase.php";
include_once "../../models/Reconocimiento.php";

$reconocimientoObj = new Reconocimiento();

$codAsociacion = $_POST['asociacion'] ?? null;
$documento = $_POST['documento'] ?? null;
$fechaInicio = $_POST['fechaInicio'] ?? null;
$fechaFin = $_POST['fechaFin'] ?? null;

$presidenta = $_POST['presidenta'] ?? null;
$vicePresidenta = $_POST['vicePresidenta'] ?? null;
$secretaria = $_POST['secretaria'] ?? null;
$tesorera = $_POST['tesorera'] ?? null;
$vocal = $_POST['vocal'] ?? null;
$coordinadora = $_POST['coordinadora'] ?? null;
$almacenera = $_POST['almacenera'] ?? null;
$fiscalizador = $_POST['fiscalizador'] ?? null;

$reconocimientoObj->setCodAsociacion($codAsociacion);
$reconocimientoObj->setDocumento($documento);
$reconocimientoObj->setFechaInicio($fechaInicio);
$reconocimientoObj->setFechaFin($fechaFin);

$response = $reconocimientoObj->registrarReconocimiento($presidenta, $vicePresidenta, $secretaria, $tesorera, $vocal, $coordinadora, $almacenera, $fiscalizador);

print json_encode($response);