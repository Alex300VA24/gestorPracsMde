<?php
require_once "../../config/DataBase.php";
include_once "../../models/Reconocimiento.php";

$reconocimientoOjb = new Reconocimiento();

$documento = $_GET['documento'] ?? null;
$codAsociacion = $_GET['codAsociacion'] ?? null;

$response = $reconocimientoOjb->listarReconocimientos($documento, $codAsociacion);

print json_encode($response);