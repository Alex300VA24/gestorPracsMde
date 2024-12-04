<?php
require_once "../../config/DataBase.php";
include_once "../../models/Beneficiario.php";

$beneficiarioOjb = new Beneficiario(0, 0, 0, '', '',
    '', '', '', 0, '', '', 0,
    0, 0, 0, '');

$dniOApellidosNombres = $_GET['dni_apellidos_nombres'] ?? null;
$codAsociacion = $_GET['codAsociacion'] ?? null;
$edadMinima = $_GET['edadMinima'] ?? null;
$edadMaxima = $_GET['edadMaxima'] ?? null;

$response = $beneficiarioOjb->listarBeneficiarios($dniOApellidosNombres, $codAsociacion, $edadMinima, $edadMaxima);

print json_encode($response);