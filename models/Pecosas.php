<?php

class Pecosas{
    private int $codPecosa;
    private int $codAsociacion;
    private int $codPresidenta;
    private string $fechaRegistro;
    private string $observacion;
    private int $codEstado;

    public function getCodPecosa(): int{
        return $this->codPecosa;
    }

    public function setCodPecosa(int $codPecosa): void{
        $this->codPecosa = $codPecosa;
    }

    public function getCodAsociacion(): int{
        return $this->codAsociacion;
    }

    public function setCodAsociacion(int $codAsociacion): void{
        $this->codAsociacion = $codAsociacion;
    }

    public function getCodPresidenta(): int{
        return $this->codPresidenta;
    }

    public function setCodPresidenta(int $codPresidenta): void{
        $this->codPresidenta = $codPresidenta;
    }

    public function getFechaRegistro(): string{
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(string $fechaRegistro): void{
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getObservacion(): string{
        return $this->observacion;
    }

    public function setObservacion(string $observacion): void{
        $this->observacion = $observacion;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function guardarMovimientos(){
        $sql = "EXEC sp_movimiento_registrar :codProducto, :codTipoMovimiento, :fechaMovimiento, :documento, :cantidad, :precioUnitario";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codProducto',$this->codProducto, PDO::PARAM_INT);
            $stmt->bindParam('codTipoMovimiento',$this->codTipoMovimiento, PDO::PARAM_INT);
            $stmt->bindParam('fechaMovimiento',$this->fechaMovimiento, PDO::PARAM_STR);
            $stmt->bindParam('documento',$this->documento, PDO::PARAM_STR);
            $stmt->bindParam('cantidad',$this->cantidad, PDO::PARAM_INT);
            $stmt->bindParam('precioUnitario',$this->precioUnitario, PDO::PARAM_STR); 
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Movimiento registrado exitosamente',
                    'data' => [],
                ];
            }else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar el movimiento, verifica los datos',
                    'action' => 'guardarMovimiento',
                    'module' => 'movimiento',
                    'data' => [],
                ];
            }

        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de guardar los movimientos',
                'action' => 'guardarMovimiento',
                'module' => 'movimiento',
                'data' => [],
                'info' => $e->getMessage()
            ]; 
        }
    }


}