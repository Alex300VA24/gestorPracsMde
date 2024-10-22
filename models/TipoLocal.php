<?php

class TipoLocal{
    private int $codLocal;
    private int $descripcion;

    public function getCodLocal(): int{
        return $this->codLocal;
    }

    public function setCodLocal(int $codLocal): void{
        $this->codLocal = $codLocal;
    }

    public function getDescripcion(): int{
        return $this->descripcion;
    }

    public function setDescripcion(int $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function listarTiposLocal(){
        $sql = "SELECT * FROM TipoLocales";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de tipos de local',
                'action' => 'listarTiposLocal',
                'module' => 'tipoLocal',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los tipos de local',
                'action' => 'listarTiposLocal',
                'module' => 'tipoLocal',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }



}