<?php

class Prodcutos{

    private int $codProducto;
    private string $descripcion;
    private string $abreviatura;
    private string $unidadMedida;
    private string $fechaRegistro;
    private int $stock;
    private decimal $precioUnitario;
    private int $codEstado;

    public function getCodProducto(): int{
        return $this->codProducto;
    }

    public function setCodProducto(int $codProducto): void{
        $this->codProducto = $codProducto;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function getAbreviatura(): string{
        return $this->abreviatura;
    }

    public function setAbreviatura(string $abreviatura): void{
        $this->abreviatura = $abreviatura;
    }

    public function getUnidadMedida(): string{
        return $this->unidadMedida;
    }

    public function setUnidadMedida(string $unidadMedida): void{
        $this->unidadMedida = $unidadMedida;
    }

    public function getFechaRegistro(): string{
        return $this->getFechaRegistro;
    }

    public function setFechaRegistro(string $fechaRegistro): void {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getStock(): int{
        return $this->getStock;
    }

    public function setStock(int $stock): void{
        $this->stock = $stock;
    }

    public function getPrecioUnitario(): decimal{
        return $this->getPrecioUnitario;
    }

    public function setPreciounitario(decimal $precioUnitario): void{
        $this->precioUnitario = $precioUnitario;
    }

    public function getCodEstado(): int{
        return $this->getCodEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function guardarProductos(){
        
    }

}

