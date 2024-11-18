<?php

class TipoBeneficio{
    private int $codTipoBeneficio;
    private string $descripcion;
    private int $edadMinima;
    private int $edadMaxima;
    private int $prioridad;
    private string $fechaRegistro;
    private  string $observaciones;

    public function getCodTipoBeneficio(): int{
        return $this->codTipoBeneficio;
    }

    public function setCodTipoBeneficio(int $codTipoBeneficio): void{
        $this->codTipoBeneficio = $codTipoBeneficio;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function getEdadMinima(): int{
        return $this->edadMinima;
    }

    public function setEdadMinima(int $edadMinima): void{
        $this->edadMinima = $edadMinima;
    }

    public function getEdadMaxima(): int{
        return $this->edadMaxima;
    }

    public function setEdadMaxima(int $edadMaxima): void{
        $this->edadMaxima = $edadMaxima;
    }

    public function getPrioridad(): int{
        return $this->prioridad;
    }

    public function setPrioridad(int $prioridad): void{
        $this->prioridad = $prioridad;
    }

    public function getFechaRegistro(): string{
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(string $fechaRegistro): void{
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getObservaciones(): string{
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void{
        $this->observaciones = $observaciones;
    }

    public function listarTipoBeneficios(){
        $sql = "SELECT * FROM TiposBeneficio";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de tipos de beneficio',
                'action' => 'listarTipoBeneficios',
                'module' => 'TipoBeneficio',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los tipos de beneficio',
                'action' => 'listarTipoBeneficios',
                'module' => 'TipoBeneficio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


}