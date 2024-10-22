<?php

class SectorZona{
    private int $codSectorZona;
    private int $codZona;
    private string $nombreZona;
    private int $codSector;
    private string $nombreSector;

    public function getCodSectorZona(): int{
        return $this->codSectorZona;
    }

    public function setCodSectorZona(int $codSectorZona): void{
        $this->codSectorZona = $codSectorZona;
    }

    public function getCodZona(): int{
        return $this->codZona;
    }

    public function setCodZona(int $codZona): void{
        $this->codZona = $codZona;
    }

    public function getNombreZona(): string{
        return $this->nombreZona;
    }

    public function setNombreZona(string $nombreZona): void{
        $this->nombreZona = $nombreZona;
    }

    public function getCodSector(): int{
        return $this->codSector;
    }

    public function setCodSector(int $codSector): void{
        $this->codSector = $codSector;
    }

    public function getNombreSector(): string{
        return $this->nombreSector;
    }

    public function setNombreSector(string $nombreSector): void{
        $this->nombreSector = $nombreSector;
    }

    public function listarZonasPorSector(){

    }

    public function listarSectoresYZona(){
        $sql = "select sz.codSectorZona, s.descripcion 'sector', z.descripcion 'zona' from SectoresZona sz
                INNER JOIN Sectores s ON sz.codSector = s.codSector
                INNER JOIN Zonas z ON sz.codZona = z.codZona
                ORDER BY s.descripcion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de sectores y zonas',
                'action' => 'listarSectoresYZona',
                'module' => 'sectorZona',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los sectores y zonas',
                'action' => 'listarSectoresYZona',
                'module' => 'sectorZona',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


}