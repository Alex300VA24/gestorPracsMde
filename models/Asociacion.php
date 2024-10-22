<?php

class Asociacion{
    private int $codAsociacion;
    private string $nombreAsociacion;
    private int $codSectorZona;
    private int $codSector;
    private string $nombreSectorZona;
    private int $codLocal;
    private string $nombreLocal;
    private string $direccion;
    private int $numeroFinca;
    private string $observaciones;
    private int $codEstado;

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

    public function getCodSectorZona(): int{
        return $this->codSectorZona;
    }

    public function getCodSector(): int{
        return $this->codSector;
    }

    public function setCodSector(int $codSector): void{
        $this->codSector = $codSector;
    }

    public function setCodSectorZona(int $codSectorZona): void{
        $this->codSectorZona = $codSectorZona;
    }

    public function getNombreSectorZona(): string{
        return $this->nombreSectorZona;
    }

    public function setNombreSectorZona(string $nombreSectorZona): void{
        $this->nombreSectorZona = $nombreSectorZona;
    }

    public function getCodLocal(): int{
        return $this->codLocal;
    }

    public function setCodLocal(int $codLocal): void{
        $this->codLocal = $codLocal;
    }

    public function getNombreLocal(): string{
        return $this->nombreLocal;
    }

    public function setNombreLocal(string $nombreLocal): void{
        $this->nombreLocal = $nombreLocal;
    }

    public function getDireccion(): string{
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void{
        $this->direccion = $direccion;
    }

    public function getNumeroFinca(): int{
        return $this->numeroFinca;
    }

    public function setNumeroFinca(int $numeroFinca): void{
        $this->numeroFinca = $numeroFinca;
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

    public function listarAsociaciones($nombreAsociacion, $codSector){
        $sql = "EXEC sp_asociacion_listar :nombreAsociacion, :codSector";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('nombreAsociacion',$nombreAsociacion, PDO::PARAM_STR);
            $stmt->bindParam('codSector',$codSector, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de asociaciones',
                'action' => 'listarAsociaciones',
                'module' => 'asociacion',
                'data' => $result,
                'info' => '',
            ];


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los club de madres',
                'action' => 'listarAsoaciaciones',
                'module' => 'asociacion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}
