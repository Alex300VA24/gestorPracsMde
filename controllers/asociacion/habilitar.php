<?php
require_once "../../config/DataBase.php";
include_once "../../models/Asociacion.php";

$codAsociacion = $_POST['codAsociacion'] ?? null;

$asociacionOjb = new Asociacion();

$asociacionOjb->setCodAsociacion($codAsociacion);

$response = $asociacionOjb->habilitarAsociacion();

print json_encode($response);