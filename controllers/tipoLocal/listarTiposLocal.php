<?php
require_once "../../config/DataBase.php";
include_once "../../models/TipoLocal.php";

$tipoLocalOjb = new TipoLocal();

$response = $tipoLocalOjb->listarTiposLocal();

print json_encode($response);