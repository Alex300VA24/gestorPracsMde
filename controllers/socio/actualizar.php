<?php
require_once "../../config/DataBase.php";
include_once "../../models/Socio.php";

$socioObj = new Socio(0, 0, 0, '', '', '', '', 0, '', '', '', 0, '', 0);

$codPersona = $_POST['codPersona'] ?? null;
$codSocio = $_POST['codSocio'] ?? null;
$dni = $_POST['dni'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$apellidoPaterno = $_POST['apellidoPaterno'] ?? null;
$apellidoMaterno = $_POST['apellidoMaterno'] ?? null;
$sexo = $_POST['sexo'] ?? null;
$asociacion = $_POST['asociacion'] ?? null;
$sectorZona = $_POST['sectorZona'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$celular = $_POST['celular'] ?? null;
$fechaNacimiento = $_POST['fechaNacimiento'] ?? null;
$direccion = $_POST['direccion'] ?? null;
$numeroFinca = $_POST['numeroFinca'] ?? null;
$observacion = $_POST['observacion'] ?? null;

$socioObj->setCodPersona($codPersona);
$socioObj->setCodSocio($codSocio);
$socioObj->setNombres($nombre);
$socioObj->setApellidoPaterno($apellidoPaterno);
$socioObj->setApellidoMaterno($apellidoMaterno);
$socioObj->setDni($dni);
$socioObj->setSexo($sexo);
$socioObj->setCodAsociacion($asociacion);
$socioObj->setCodSectorZona($sectorZona);
$socioObj->setTelefono($telefono);
$socioObj->setCelular($celular);
$socioObj->setFechaNacimiento($fechaNacimiento);
$socioObj->setDireccion($direccion);
$socioObj->setNumeroFinca($numeroFinca);
$socioObj->setObservaciones($observacion);

$response = $socioObj->actualizarSocio();

print json_encode($response);