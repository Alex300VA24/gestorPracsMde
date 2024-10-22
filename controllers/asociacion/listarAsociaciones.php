<?php
require_once "../../config/DataBase.php";
include_once "../../models/Asociacion.php";

$asociacionObj = new Asociacion();

$nombreAsociacion = $_GET['nombreAsociacion'] ?? null;
$codSector = $_GET['codSector'] ?? null;

$response = $asociacionObj->listarAsociaciones($nombreAsociacion, $codSector);

print json_encode($response);