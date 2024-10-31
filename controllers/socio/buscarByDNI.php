<?php
require_once "../../config/DataBase.php";
include_once "../../models/Socio.php";

$dni = $_GET['dni'] ?? null;
$asociacion = $_GET['codAsociacion'] ?? null;

$socioOjb = new Socio();
$socioOjb->setCodAsociacion($asociacion);

$response = $socioOjb->buscarByDNI($dni);

print json_encode($response);