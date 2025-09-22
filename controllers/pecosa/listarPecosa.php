<?php
require_once "../../config/DataBase.php";
include_once "../../models/Pecosas.php";

$pecosasObj = new Pecosas();

$descripcionPecosa = $_GET['fechaReparto'] ?? null;

$response = $pecosasObj->listarPecosa($descripcionPecosa);

print json_encode($response);
