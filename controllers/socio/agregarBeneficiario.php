<?php
require_once "../../config/DataBase.php";
include_once "../../models/Beneficiario.php";

$codSocio = $_POST['codSocio'] ?? null;

$dniSocio = $_POST['dniSocio'] ?? null;
$dniBeneficiario = $_POST['dniBeneficiario'] ?? null;
$nombresBeneficiario = $_POST['nombresBeneficiario'] ?? null;
$apellidoPaternoBeneficiario = $_POST['apellidoPaternoBeneficiario'] ?? null;
$apellidoMaternoBeneficiario = $_POST['apellidoMaternoBeneficiario'] ?? null;
$sexoBeneficiario = $_POST['sexoBeneficiario'] ?? null;
$telefonoBeneficiario = $_POST['telefonoBeneficiario'] ?? null;
$celularBeneficiario = $_POST['celularBeneficiario'] ?? null;
$fechaNacimientoBeneficiario = $_POST['fechaNacimientoBeneficiario'] ?? null;
$edadBeneficiario = $_POST['edadBeneficiario'] ?? null;
$sectorZonaBeneficiario = $_POST['sectorZonaBeneficiario'] ?? null;
$direccionBeneficiario = $_POST['direccionBeneficiario'] ?? null;
$numeroFincaBeneficiario = $_POST['numeroFincaBeneficiario'] ?? null;
$parentescoBeneficiario = $_POST['parentescoBeneficiario'] ?? null;
$tipoBeneficioBeneficiario = $_POST['tipoBeneficioBeneficiario'] ?? null;
$pesoBeneficiario = $_POST['pesoBeneficiario'] ?? null;
$tallaBeneficiario = $_POST['tallaBeneficiario'] ?? null;
$hmgBeneficiario = $_POST['hmgBeneficiario'] ?? null;
$fumBeneficiario = $_POST['fumBeneficiario'] ?? null;
$fechaProbablePartoBeneficiario = $_POST['fechaProablePartoBeneficiario'] ?? null;
$fechaPartoBeneficiario = $_POST['fechaPartoBeneficiario'] ?? null;
$fechaFinLactanciaBeneficiario = $_POST['fechaFinLactanciaBeneficiario'] ?? null;

$objBeneficiario = new Beneficiario($nombresBeneficiario, $apellidoPaternoBeneficiario, $apellidoMaternoBeneficiario, $dniBeneficiario,
    $sexoBeneficiario, $telefonoBeneficiario, $celularBeneficiario, $fechaNacimientoBeneficiario, $sectorZonaBeneficiario, $direccionBeneficiario,
    $numeroFincaBeneficiario, 0, 0, (int) $codSocio, (int) $parentescoBeneficiario, '');

$response = $objBeneficiario->registrarBeneficiario((int) $tipoBeneficioBeneficiario, $tallaBeneficiario, $pesoBeneficiario, $hmgBeneficiario,
    $fumBeneficiario, $fechaProbablePartoBeneficiario, $fechaPartoBeneficiario, $fechaFinLactanciaBeneficiario);

print json_encode($response);
