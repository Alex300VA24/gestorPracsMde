<?php
require_once "../../config/DataBase.php";
include_once "../../models/UnidadMedida.php";

$unidadMedidaOjb = new UnidadMedida();

$response = $unidadMedidaOjb->listarUnidadMedida();

print json_encode($response);