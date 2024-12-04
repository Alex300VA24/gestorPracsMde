<?php
require_once "../../config/DataBase.php";
include_once "../../models/Socio.php";

$socioOjb = new Socio(0, 0, 0, '', '',
'', '', '', '', '', '', 0,
'', 0);

$dniOApellidosNombres = $_GET['dniOApellidosNombres'] ?? null;
$codAsociacion = $_GET['codAsociacion'] ?? null;

$response = $socioOjb->listarSocios($dniOApellidosNombres, $codAsociacion);

print json_encode($response);