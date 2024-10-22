<?php
require_once "../../config/DataBase.php";
include_once "../../models/Sector.php";

$sectorOjb = new Sector();

$response = $sectorOjb->listarSectores();

print json_encode($response);