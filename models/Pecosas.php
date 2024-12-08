<?php

class Pecosas{
    private int $codPecosa;
    private int $codAsociacion;
    private string $numeroPecosa;
    private int $codPresidenta;
    private string $fechaRegistro;
    private string $observacion;
    private int $codEstado;

    private array $detallesPecosa = [];

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

    public function getNumeroPecosa(): string{
        return $this->numeroPecosa;
    }

    public function setNumeroPecosa(string $numeroPecosa): void{
        $this->numeroPecosa = $numeroPecosa;
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

    public function agregarDetallePecosa(DetallePecosa $detalle):void {
        $this->detallePecosa[] = $detalle;
    }

    public function getDetallesPecosa(): array {
        return $this->detallesPecosas;
    }

    public function guardarPecosa(){
        $sql = "EXEC sp_movimiento_registrar :codAsociacion, :numeroPecosa, :codSocioPresidenta, :fechaReparto, :observacion, :codEstado, :detallesPecosa";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            // Serializar los detalles como JSON o pasarlos como string formateado
            $detallesJson = json_encode($this->detallesPecosa);

            $stmt->bindParam('codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('numeroPecosa', $this->numeroPecosa, PDO::PARAM_STR);
            $stmt->bindParam('codSocioPresidenta', $this->codSocioPresidenta, PDO::PARAM_INT);
            $stmt->bindParam('fechaReparto', $this->fechaReparto, PDO::PARAM_STR);
            $stmt->bindParam('observacion', $this->observacion, PDO::PARAM_STR);
            $stmt->bindParam('codEstado', $this->codEstado, PDO::PARAM_INT);
            $stmt->bindParam('detallesPecosa', $detallesJson, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Pecosa registrado exitosamente',
                    'data' => [],
                ];
            }else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar la pecosa, verifica los datos',
                    'action' => 'guardarPecosa',
                    'module' => 'pecosas',
                    'data' => [],
                ];
            }

        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de guardar la pecosa',
                'action' => 'guardarPecosa',
                'module' => 'pecosas',
                'data' => [],
                'info' => $e->getMessage()
            ]; 
        }
    }


}