<?php
require_once "../../config/DataBase.php";
include_once "../../models/Beneficiario.php";

$codBeneficiario = $_POST['codBeneficiario'] ?? null;

$beneficiarioOjb = new Beneficiario("", "", "", "", "", "",
"", "", 0, "", 0, 0, 0, 0, 0, "");

$beneficiarioOjb->setCodBeneficiario($codBeneficiario);

$response = $beneficiarioOjb->inhabilitarBeneficiario();

print json_encode($response);