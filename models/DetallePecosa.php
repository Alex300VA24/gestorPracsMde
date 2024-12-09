<?php

class DetallePecosa {
    private int $codDetallePecosa;
    private int $codProducto;
    private int $codPecosa;
    private int $prioridad;
    private string $fechaDesde;
    private string $fechaHasta;
    private int $cantidad;
    private float $precioUnitario;

    public function getCodDetallePecosa(): int {
        return $this->codDetallePecosa;
    }

    public function setCodDetallePecosa(int $codDetallePecosa): void {
        $this->codDetallePecosa = $codDetallePecosa;
    }

    public function getCodProducto(): int {
        return $this->codProducto;
    }

    public function setCodProducto(int $codProducto): void {
        $this->codProducto = $codProducto;
    }

    public function getCodPecosa(): int {
        return $this->codPecosa;
    }

    public function setCodPecosa(int $codPecosa): void {
        $this->codPecosa = $codPecosa;
    }

    public function getPrioridad(): int {
        return $this->prioridad;
    }

    public function setPrioridad(int $prioridad): void {
        $this->prioridad = $prioridad;
    }

    public function getFechaDesde(): string {
        return $this->fechaDesde;
    }

    public function setFechaDesde(string $fechaDesde): void {
        $this->fechaDesde = $fechaDesde;
    }

    public function getFechaHasta(): string {
        return $this->fechaHasta;
    }

    public function setFechaHasta(string $fechaHasta): void {
        $this->fechaHasta = $fechaHasta;
    }

    public function getCantidad(): int {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function getPrecioUnitario(): float {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario(float $precioUnitario): void {
        $this->precioUnitario = $precioUnitario;
    }

    public function guardarDetallePecosa(){
        $sql = "EXEC sp_detallePecosa_guardar :codProducto, :prioridad, :fechaDesde, :fechaHasta, :cantidad, :precioUnitario";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codProducto', $this->codProducto, PDO::PARAM_INT);
            $stmt->bindParam('prioridad', $this->prioridad, PDO::PARAM_INT);
            $stmt->bindParam('fechaDesde', $this->fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam('fechaHasta', $this->fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam('cantidad', $this->cantidad, PDO::PARAM_INT);
            $stmt->bindParam('precioUnitario', $this->precioUnitario, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Detalle Pecosa registrado exitosamente',
                    'data' => [],
                ];
            }else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar el detalle pecosa, verifica los datos',
                    'action' => 'guardarDetallePecosa',
                    'module' => 'detallepecosas',
                    'data' => [],
                ];
            }

        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de guardar el detalle pecosa',
                'action' => 'guardarDetallePecosa',
                'module' => 'detallepecosas',
                'data' => [],
                'info' => $e->getMessage()
            ]; 
        }


    }
    
}
