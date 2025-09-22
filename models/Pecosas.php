<?php

class Pecosas
{
    private int $codPecosa;
    private int $codAsociacion;
    private string $numeroPecosa;
    private int $codSocioPresidenta;
    private string $fechaReparto;
    private string $observacion;
    private int $codEstado;

    private array $detallesPecosa = [];


    public function __construct(
        int $codPecosa=0,
        int $codAsociacion=0,
        string $numeroPecosa='',
        int $codSocioPresidenta=0,
        string $fechaReparto='',
        string $observacion='',
        int $codEstado = 0
    ){
        $this->codPecosa = $codPecosa;
        $this->codAsociacion =$codAsociacion;
        $this->numeroPecosa =$numeroPecosa;
        $this->codSocioPresidenta =$codSocioPresidenta;
        $this->fechaReparto =$fechaReparto;
        $this->observacion =$observacion;
        $this->codEstado =$codEstado;
    }

    public function getCodPecosa(): int
    {
        return $this->codPecosa;
    }

    public function setCodPecosa(int $codPecosa): void
    {
        $this->codPecosa = $codPecosa;
    }

    public function getCodAsociacion(): int
    {
        return $this->codAsociacion;
    }

    public function setCodAsociacion(int $codAsociacion): void
    {
        $this->codAsociacion = $codAsociacion;
    }

    public function getNumeroPecosa(): string
    {
        return $this->numeroPecosa;
    }

    public function setNumeroPecosa(string $numeroPecosa): void
    {
        $this->numeroPecosa = $numeroPecosa;
    }

    public function getCodSocioPresidenta(): int
    {
        return $this->codSocioPresidenta;
    }

    public function setCodSocioPresidenta(int $codSocioPresidenta): void
    {
        $this->codSocioPresidenta = $codSocioPresidenta;
    }

    public function getFechaReparto(): string
    {
        return $this->fechaReparto;
    }

    public function setFechaReparto(string $fechaReparto): void
    {
        $this->fechaReparto = $fechaReparto;
    }

    public function getObservacion(): string
    {
        return $this->observacion;
    }

    public function setObservacion(string $observacion): void
    {
        $this->observacion = $observacion;
    }

    public function getCodEstado(): int
    {
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void
    {
        $this->codEstado = $codEstado;
    }

    public function agregarDetallePecosa(DetallePecosa $detalle): void
    {
        $this->detallesPecosa[] = $detalle;
    }

    public function getDetallesPecosa(): array
    {
        return $this->detallesPecosa;
    }

    // Metodo para listar pecosas
    public function listarPecosa()
    {
        $sql = "exec sp_pecosa_listar :fechaInicio, :fechaFin";
        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('fechaInicio', $this->fechaReparto);
            $stmt->bindParam('fechaFin', $this->fechaReparto);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Pecosa registrado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar la pecosa, verifica los datos',
                    'action' => 'guardarPecosa',
                    'module' => 'pecosas',
                    'data' => [],
                ];
            }
        } catch (PDOException $e) {
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

    public function guardarPecosa()
    {
        $sql = "EXEC sp_pecosa_registrar :codAsociacion, :numeroPecosa, :codSocioPresidenta, :fechaReparto, :observacion, :codEstado";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            // Serializar los detalles como JSON o pasarlos como string formateado
            //$detallesJson = json_encode($this->detallesPecosa);

            $stmt->bindParam('codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('numeroPecosa', $this->numeroPecosa, PDO::PARAM_STR);
            $stmt->bindParam('codSocioPresidenta', $this->codSocioPresidenta, PDO::PARAM_INT);
            $stmt->bindParam('fechaReparto', $this->fechaReparto, PDO::PARAM_STR);
            $stmt->bindParam('observacion', $this->observacion, PDO::PARAM_STR);
            $stmt->bindParam('codEstado', $this->codEstado, PDO::PARAM_INT);
            //$stmt->bindParam('detallesPecosa', $detallesJson, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Pecosa registrado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar la pecosa, verifica los datos',
                    'action' => 'guardarPecosa',
                    'module' => 'pecosas',
                    'data' => [],
                ];
            }
        } catch (PDOException $e) {
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
