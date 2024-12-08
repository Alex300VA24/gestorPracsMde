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
}
