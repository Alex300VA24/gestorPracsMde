<?php

class UnidadMedida{
    private int $codUnidadMedida;
    private string $descripcion;

    public function getCodUnidadMedida(): int{
        return $this->codUnidadMedida;
    }

    public function setUnidadMedida(int $codUnidadMedida): void{
        $this->codUnidadMedida = $codUnidadMedida;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function listarUnidadMedida(){
        $sql = "SELECT * FROM UnidadMedida";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de unidad de medida',
                'action' => 'listarUnidadMedida',
                'module' => 'unidadMedida',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar las Unidad de Medida',
                'action' => 'listarUnidadMedida',
                'module' => 'unidadMedida',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }
}