<?php

class Productos{

    private int $codProducto;
    private string $descripcion;
    private string $abreviatura;
    private string $unidadMedida;
    private int $stock;
    private string $precioUnitario;
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

    public function getStock(): int{
        return $this->getStock;
    }

    public function setStock(int $stock): void{
        $this->stock = $stock;
    }

    public function getPrecioUnitario(): string{
        return $this->getPrecioUnitario;
    }

    public function setPreciounitario(string $precioUnitario): void{
        $this->precioUnitario = $precioUnitario;
    }

    public function getCodEstado(): int{
        return $this->getCodEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function guardarProductos(){
        $sql = "EXEC sp_producto_registrar :descripcion, :abreviatura, :unidadMedida";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('descripcion',$this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam('abreviatura',$this->abreviatura, PDO::PARAM_STR);
            $stmt->bindParam('unidadMedida',$this->unidadMedida, PDO::PARAM_STR); 
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Producto registrado exitosamente',
                    'data' => [],
                ];
            }else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar el producto, verifica los datos',
                    'action' => 'guardarProducto',
                    'module' => 'productos',
                    'data' => [],
                ];
            }
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los productos',
                'action' => 'guardarProducto',
                'module' => 'producto',
                'data' => [],
                'info' => $e->getMessage()
            ]; 
        }
    }

}

