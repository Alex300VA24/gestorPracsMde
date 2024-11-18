<?php
require_once "../../config/DataBase.php";
include_once "../../models/Socio.php";

$socioObj = new Socio(0, 0, 0, '', '', '',
    '', '', '', '', '', 0, '', 0);

$dniSocio = $_POST['dniSocio'] ?? null;
$nombresSocio = $_POST['nombresSocio'] ?? null;
$apellidoPaternoSocio = $_POST['apellidoPaternoSocio'] ?? null;
$apellidoMaternoSocio = $_POST['apellidoMaternoSocio'] ?? null;
$sexoSocio = $_POST['sexoSocio'] ?? null;
$telefonoSocio = $_POST['telefonoSocio'] ?? null;
$celularSocio = $_POST['celularSocio'] ?? null;
$fechaNacimientoSocio = $_POST['fechaNacimientoSocio'] ?? null;
$sectorZonaSocio = $_POST['sectorZonaSocio'] ?? null;
$direccionSocio = $_POST['direccionSocio'] ?? null;
$numeroFincaSocio = $_POST['numeroFincaSocio'] ?? null;
$asociacionSocio = $_POST['asociacionSocio'] ?? null;
$observacionesSocio = $_POST['observacionesSocio'] ?? null;
$esSocioBeneficiario = $_POST['esSocioBeneficiario'] ?? null;
$parentesco = $_POST['parentesco'] ?? null;
$tipoBeneficio = $_POST['tipoBeneficio'] ?? null;
$talla = $_POST['talla'] ?? null;
$peso = $_POST['peso'] ?? null;
$hmg = $_POST['hmg'] ?? null;
$fechaUltimaMestruacion = $_POST['fechaUltimaMestruacion'] ?? null;
$fechaProbableParto = $_POST['fechaProbableParto'] ?? null;
$fechaParto = $_POST['fechaParto'] ?? null;
$fechaFinLactancia = $_POST['fechaFinLactancia'] ?? null;
$beneficiarios = $_POST['beneficiarios'] ?? null;

$socioObj->setDni($dniSocio);
$socioObj->setNombres($nombresSocio);
$socioObj->setApellidoPaterno($apellidoPaternoSocio);
$socioObj->setApellidoMaterno($apellidoMaternoSocio);
$socioObj->setSexo($sexoSocio);
$socioObj->setTelefono($telefonoSocio);
$socioObj->setCelular($celularSocio);
$socioObj->setFechaNacimiento($fechaNacimientoSocio);
$socioObj->setCodSectorZona($sectorZonaSocio);
$socioObj->setDireccion($direccionSocio);
$socioObj->setNumeroFinca($numeroFincaSocio);
$socioObj->setCodAsociacion($asociacionSocio);
$socioObj->setObservaciones($observacionesSocio);


$response = $socioObj->registrarSocio($esSocioBeneficiario, $parentesco, $tipoBeneficio,
    $talla, $peso, $hmg, $fechaUltimaMestruacion, $fechaProbableParto, $fechaParto,
    $fechaFinLactancia, $beneficiarios);

print json_encode($response);