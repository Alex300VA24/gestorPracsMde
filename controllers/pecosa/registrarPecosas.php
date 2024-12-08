<?php
require_once "../../config/DataBase.php";
include_once "../../models/Pecosas.php";

$pecosasObj = new Pecosas();

$codAsociacion = $_POST['clubMadres'] ?? null;
$numeroPecosa = $_POST['numero'] ?? null;
$codAsociacionPresidenta = $_POST['presidenta'] ?? null;
$fechaReparto = $_POST['fechaReparto'] ?? null;
$observacion = $_POST['observacion'] ?? null;

$pecosasObj->setCodAsociacion()