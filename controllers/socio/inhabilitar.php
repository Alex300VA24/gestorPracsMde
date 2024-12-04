<?php
require_once "../../config/DataBase.php";
include_once "../../models/Socio.php";

$codSocio = $_POST['codSocio'] ?? null;

$socioOjb = new Socio(0, 0, 0, '',
    '', '', '', '', '', '', ''
    ,0, '', 0);

$socioOjb->setCodSocio($codSocio);

$response = $socioOjb->inhabilitarSocio();

print json_encode($response);