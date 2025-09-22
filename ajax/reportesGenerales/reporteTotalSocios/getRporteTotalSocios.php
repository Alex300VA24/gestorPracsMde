<?php
require_once "config/DataBase.php";

class ReporteSocios extends DataBase
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getReporteSociosTotales()
  {
    $conn = parent::connect();
    $sql = "SELECT * FROM vw_socios
            ORDER BY NombresSocio ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
  }
}

$reporteSocios = new ReporteSocios();
$reporte = $reporteSocios->getReporteSociosTotales();

header('Content-Type: application/json');
echo json_encode($reporte);

