<?php

class Movimientos{
    private int $codMovimiento;
    private int $codProducto;
    private int $codTipoMovimiento;
    private string $fechaMovimiento;
    private string $documento;
    private int $cantidad;
    private string $precioUnitario;
    private string $precioTotal;

    public function getCodMovimiento(): int{
        return $this->codMovimento;
    }

    public function setCodMovimiento(int $codMovimiento): void{
        $this->codMovimiento = $codMovimiento;
    }

    public function getCodProducto(): int{
        return $this->getCodProducto;
    }

    public function setCodProducto(int $codProducto): void{
        $this->codProducto = $codProducto;
    }

    public function getCodTipoMovimiento(): int{
        return $this->codTipoMovimientos;
    }

    public function setCodTipoMovimiento(int $codTipoMovimiento): void{
        $this->codTipoMovimiento = $codTipoMovimiento;
    }

    public function getFechaMovimiento(): string{
        return $this->fechaMovimiento;
    }

    public function setFechaMovimiento(string $fechaMovimiento): void{
        $this->fechaMovimiento = $fechaMovimiento;
    }

    public function getDocumento(): string{
        return $this->documento;
    }

    public function setDocumento(string $documento): void{
        $this->documento = $documento;
    }

    public function getCantidad(): int{
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void{
        $this->cantidad = $cantidad;
    }

    public function getPrecioUnitario(): string{
        return $this->precioUnitario;
    }

    public function setPrecioUnitario(string $precioUnitario): void{
        $this->precioUnitario = $precioUnitario;
    }

    public function getPrecioTotal(): string{
        return $this->precioTotal;
    }

    public function setPrecioTotal(string $precioTotal){
        $this->precioTotal = $precioTotal;
    }

    public function listarMovimientos($codigo, $descripcion){
        $sql = "EXEC sp_movimiento_listar :codigo, :descripcion";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codigo',$codigo, PDO::PARAM_INT);
            $stmt->bindParam('descripcion',$descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de movimientos',
                'action' => 'listarMovimientos',
                'module' => 'movimientos',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los movimientos',
                'action' => 'listarMovimientos',
                'module' => 'movimientos',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
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

    public function actualizarMovimientos(){
        $sql="sp_movimiento_actualizar :codMovimiento, :codProducto, :precioUnitario, :fechaMovimiento, :documento, :cantidad, :codTipoMovimiento";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codMovimiento',$this->codProducto, PDO::PARAM_INT);
            $stmt->bindParam('codProducto',$this->codigo, PDO::PARAM_INT);
            $stmt->bindParam('precioUnitario',$this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam('fechaMovimiento',$this->abreviatura, PDO::PARAM_STR);
            $stmt->bindParam('documento',$this->abreviatura, PDO::PARAM_STR);
            $stmt->bindParam('cantidad',$this->abreviatura, PDO::PARAM_INT);
            $stmt->bindParam('codTipoMovimiento',$this->unidadMedida, PDO::PARAM_INT); 
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Movimiento actualizado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo actualizar el movimiento, verifica los datos',
                    'action' => 'actualizarMovimiento',
                    'module' => 'movimientos',
                    'data' => [],
                ];
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de actualizar los movimientos',
                'action' => 'actualizarMovimiento',
                'module' => 'movimientos',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }



}