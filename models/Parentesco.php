<?php

class Parentesco{
    private int $codParentesco;
    private string $descripcion;
    private string $fechaRegistro;

    public function getCodParentesco(): int{
        return $this->codParentesco;
    }

    public function setCodParentesco(int $codParentesco): void{
        $this->codParentesco = $codParentesco;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function getFechaRegistro(): string{
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(string $fechaRegistro): void{
        $this->fechaRegistro = $fechaRegistro;
    }

    public function listarParentescos(){
        $sql = "SELECT * FROM Parentescos";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de parentescos',
                'action' => 'listarParentescos',
                'module' => 'parentesco',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los parentescos',
                'action' => 'listarParentescos',
                'module' => 'parentesco',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}
