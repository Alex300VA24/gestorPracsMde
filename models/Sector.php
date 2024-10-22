<?php

class Sector{
    private int $codSector;
    private string $descripcion;

    public function getCodSector(): int{
        return $this->codSector;
    }

    public function setCodSector(int $codSector): void{
        $this->codSector = $codSector;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function listarSectores(){
        $sql = "SELECT * FROM Sectores";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de sectores',
                'action' => 'listarSectores',
                'module' => 'sector',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los sectores',
                'action' => 'listarSectores',
                'module' => 'sector',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


}