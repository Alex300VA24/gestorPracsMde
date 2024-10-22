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
    private string $numeroFinca;
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

    public function getNumeroFinca(): string{
        return $this->numeroFinca;
    }

    public function setNumeroFinca(string $numeroFinca): void{
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

    public function guardarAsociacion(){
        $sql = "EXEC sp_asociacion_registrar :nombreAsociacion, :codSectorZona, :direccion, :codTipoLocal, :numeroFinca, :observacion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('nombreAsociacion',$this->nombreAsociacion, PDO::PARAM_STR);
            $stmt->bindParam('codSectorZona',$this->codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('codSectorZona',$this->codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('direccion',$this->direccion, PDO::PARAM_STR);
            $stmt->bindParam('codTipoLocal',$this->codLocal, PDO::PARAM_INT);
            $stmt->bindParam('numeroFinca',$this->numeroFinca, PDO::PARAM_INT);
            $stmt->bindParam('observacion',$this->observaciones, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Club de madre registrado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar el club de madre, verifica los datos',
                    'action' => 'guardarAsociacion',
                    'module' => 'asociacion',
                    'data' => [],
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar los club de madres',
                'action' => 'guardarAsociacion',
                'module' => 'asociacion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarAsociacion(){
        $sql = "EXEC sp_asociacion_actualizar :codAsociacion, :nombreAsociacion, :codSectorZona, :direccion, :codTipoLocal, :numeroFinca, :observacion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codAsociacion',$this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('nombreAsociacion',$this->nombreAsociacion, PDO::PARAM_STR);
            $stmt->bindParam('codSectorZona',$this->codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('codSectorZona',$this->codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('direccion',$this->direccion, PDO::PARAM_STR);
            $stmt->bindParam('codTipoLocal',$this->codLocal, PDO::PARAM_INT);
            $stmt->bindParam('numeroFinca',$this->numeroFinca, PDO::PARAM_INT);
            $stmt->bindParam('observacion',$this->observaciones, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Club de madre actualizado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo actualizar el club de madre, verifica los datos',
                    'action' => 'actualizarAsociacion',
                    'module' => 'asociacion',
                    'data' => [],
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de actualizar los club de madres',
                'action' => 'actualizarAsociacion',
                'module' => 'asociacion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}
