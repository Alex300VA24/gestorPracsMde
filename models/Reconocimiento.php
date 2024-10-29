<?php
class Reconocimiento{
    private int $codReconocimiento;
    private int $codAsociacion;
    private string $nombreAsociacion;
    private string $documento;
    private string  $fechaInicio;
    private string $fechaFin;
    private int $codEstado;
    private string $estadoDescripcion;

    public function getCodReconocimiento(): int{
        return $this->codReconocimiento;
    }

    public function setCodReconocimiento(int $codReconocimiento): void{
        $this->codReconocimiento = $codReconocimiento;
    }

    public function getCodAsociacion(): int{
        return $this->codAsociacion;
    }

    public function setCodAsociacion(int $codAsociacion): void{
        $this->codAsociacion = $codAsociacion;
    }

    public function getNombreAsociacion(): string{
        return $this->nombreAsociacion;
    }

    public function setNombreAsociacion(string $nombreAsociacion): void{
        $this->nombreAsociacion = $nombreAsociacion;
    }

    public function getDocumento(): string{
        return $this->documento;
    }

    public function setDocumento(string $documento): void{
        $this->documento = $documento;
    }

    public function getFechaInicio(): string{
        return $this->fechaInicio;
    }

    public function setFechaInicio(string $fechaInicio): void{
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin(): string{
        return $this->fechaFin;
    }

    public function setFechaFin(string $fechaFin): void{
        $this->fechaFin = $fechaFin;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function getEstadoDescripcion(): string{
        return $this->estadoDescripcion;
    }

    public function setEstadoDescripcion(string $estadoDescripcion): void{
        $this->estadoDescripcion = $estadoDescripcion;
    }

    public function registrarReconocimiento(){
        $sql = "EXEC sp_reconocimiento_registrar :codAsociacion, :documento, :fechaInicio, :fechaFin";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codAsociacion',$this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('documento',$this->documento, PDO::PARAM_STR);
            $stmt->bindParam('fechaInicio',$this->fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam('fechaFin',$this->fechaFin, PDO::PARAM_STR);

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Reconocimiento registrado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar el reconocimiento, verifica los datos',
                    'action' => 'registrarReconocimiento',
                    'module' => 'reconocimiento',
                    'data' => [],
                ];
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar el reconocimiento',
                'action' => 'registrarReconocimiento',
                'module' => 'reconocimiento',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }
}