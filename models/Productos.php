<?php

class Productos{

    private int $codProducto;
    private int $codigo;
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

    public function getCodigo(): int{
        return $this->codigo;
    }

    public function setCodigo(int $codigo): void{
        $this->codigo = $codigo;
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

    public function listarProductos($codigo, $descripcion){
        $sql = "EXEC sp_producto_listar :codigo, :descripcion";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codigo',$codigo, PDO::PARAM_INT);
            $stmt->bindParam('descripcion',$descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de productos',
                'action' => 'listarProductos',
                'module' => 'productos',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los productos',
                'action' => 'listarProductos',
                'module' => 'productos',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function guardarProductos(){
        $sql = "EXEC sp_producto_registrar :codigo, :descripcion, :abreviatura, :unidadMedida";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codigo',$this->codigo, PDO::PARAM_INT);
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
                'message' => 'Ocurrio un error al momento de guardar los productos',
                'action' => 'guardarProducto',
                'module' => 'producto',
                'data' => [],
                'info' => $e->getMessage()
            ]; 
        }
    }

    public function actualizarProductos(){
        $sql="EXEC sp_producto_actualizar :codProducto, :codigo, :descripcion, :abreviatura, :unidadMedida";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codProducto',$this->codProducto, PDO::PARAM_INT);
            $stmt->bindParam('codigo',$this->codigo, PDO::PARAM_INT);
            $stmt->bindParam('descripcion',$this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam('abreviatura',$this->abreviatura, PDO::PARAM_STR);
            $stmt->bindParam('unidadMedida',$this->unidadMedida, PDO::PARAM_STR); 
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Producto actualizado exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo actualizar el producto, verifica los datos',
                    'action' => 'actualizarProducto',
                    'module' => 'productos',
                    'data' => [],
                ];
            }
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de actualizar los productos',
                'action' => 'actualizarProducto',
                'module' => 'productos',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}

