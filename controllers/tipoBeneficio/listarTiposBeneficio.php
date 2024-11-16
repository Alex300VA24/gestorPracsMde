<?php
require_once "../../config/DataBase.php";
include_once "../../models/TipoBeneficio.php";

$tipoBeneficioOjb = new TipoBeneficio();

$response = $tipoBeneficioOjb->listarTipoBeneficios();

print json_encode($response);