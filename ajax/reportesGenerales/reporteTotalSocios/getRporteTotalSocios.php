<?php
require_once '../../../../config/DataBase.php';

class ReporteTotalSocios extends DataBase
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getReporTotalSocios()
  $conector = parent::getConexion();

  $sql = "SELECT * FROM codSocio
          ORDER BY codSocio DESC"; 
  
  $stmt = $conector->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  return $resultado;
  
}

$reporteSociosTotales = new ReporteSociosTotales();
$reporte = $reporteSociosTotales->getRporteTotalSocios();

header('Content-Type: application/json');
echo json_encode($reporte);