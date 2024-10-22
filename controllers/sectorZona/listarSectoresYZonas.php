<?php
require_once "../../config/DataBase.php";
include_once "../../models/SectorZona.php";

$sectorZanaOjb = new SectorZona();

$response = $sectorZanaOjb->listarSectoresYZona();

print json_encode($response);