<?php
require_once "../../config/DataBase.php";
include_once "../../models/Asociacion.php";

$asociacionObj = new Asociacion();

$nombreAsociacion = $_POST['nombre'] ?? null;
$codSectorZona = $_POST['sector'] ?? null;
$direccion = $_POST['direccion'] ?? null;
$codTipoLocal = $_POST['tipoLocal'] ?? null;
$numeroFinca = $_POST['numeroFinca'] ?? null;
$observacion = $_POST['observacion'] ?? null;

$asociacionObj->setNombreAsociacion($nombreAsociacion);
$asociacionObj->setCodSectorZona($codSectorZona);
$asociacionObj->setDireccion($direccion);
$asociacionObj->setCodLocal($codTipoLocal);
$asociacionObj->setNumeroFinca($numeroFinca);
$asociacionObj->setObservaciones($observacion);

$response = $asociacionObj->guardarAsociacion();

print json_encode($response);