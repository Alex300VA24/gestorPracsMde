<?php
require_once "../../config/DataBase.php";
include_once "../../models/Asociacion.php";

$asociacionOjb = new Asociacion();

$response = $asociacionOjb->listarAsociacionesNuevasYReconocimientoVencido();

print json_encode($response);