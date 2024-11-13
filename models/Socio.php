<?php

include_once "Persona.php";

class Socio extends Persona {
    private int $codSocio;
    private int $codAsociacion;
    private string $nombreAsociacion;
    private string $fechaInicio;
    private string $fechaFin;
    private string $observaciones;
    private int $codEstado;
    private string $descripcionEstado;

    public function __construct(int $codSocio, int $codAsociacion,
                                int $codPersona, string $nombres, string $apellidoPaterno, string $apellidoMaterno,
                                string $dni, string $sexo, string $telefono, string $celular, string $fechaNacimiento,
                                int $codSectorZona, string $direccion, int $numeroFinca){
        parent::__construct($codPersona, $nombres, $apellidoPaterno, $apellidoMaterno,
            $dni, $sexo, $telefono, $celular, $fechaNacimiento, $codSectorZona, $direccion, $numeroFinca);
        $this->codSocio = $codSocio;
        $this->codAsociacion = $codAsociacion;
    }

    public function getCodSocio(): int{
        return $this->codSocio;
    }

    public function setCodSocio(int $codSocio): void{
        $this->codSocio = $codSocio;
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

    public function getObservaciones(): string{
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void{
        $this->observaciones = $observaciones;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function getDescripcionEstado(): string{
        return $this->descripcionEstado;
    }

    public function setDescripcionEstado(string $descripcionEstado): void{
        $this->descripcionEstado = $descripcionEstado;
    }

    public function buscarByDNI(string $dni){
        $sql = "EXEC sp_socio_buscar_por_dni :codAsociacion, :dni";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if ($stmt->rowCount() > 0){
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'datos del socio',
                    'action' => 'buscarByDNI',
                    'module' => 'socio',
                    'data' => $result[0],
                    'info' => '',
                ];
            }else{
                return [
                    'status' => 'success',
                    'code' => 404,
                    'message' => 'El socio que intenta buscar no se encuentra en el club de madre seleccionado o no está activo.',
                    'data' => [],
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de buscar el socio por DNI y club de madre',
                'action' => 'buscarByDNI',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}