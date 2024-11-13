---REGISTRO MOVIMIENTOS
CREATE   PROCEDURE sp_movimiento_registrar (
    @codProducto INT,
    @codTipoMovimiento INT,
    @fechaMovimiento DATETIME,
    @cantidad INT,
    @precioUnitario DECIMAL(9,2)
	
)
AS
BEGIN
    
	DECLARE @precioTotal DECIMAL(9,2);

    SET @precioTotal = @cantidad * @precioUnitario;
    
    INSERT INTO Movimientos(
        codProducto,
        codTipoMovimiento,
        fechaMovimiento,
        cantidad,
        precioUnitario,
		precioTotal
        
    )
    VALUES (
        @codProducto,
        @codTipoMovimiento,
        @fechaMovimiento,
        @cantidad,
        @precioUnitario,
		@cantidad * @precioUnitario
        
    );

	 -- Actualiza el stock en la tabla Producto según el tipo de movimiento
    IF @codTipoMovimiento = 1 -- Ejemplo: 1 = Entrada de producto
    BEGIN
        UPDATE Productos
        SET stock = stock + @cantidad, precioUnitario = @precioUnitario
        WHERE codProducto = @codProducto;
    END
    ELSE IF @codTipoMovimiento = 2 -- Ejemplo: 2 = Salida de producto
    BEGIN
        UPDATE Productos
        SET stock = stock - @cantidad
        WHERE codProducto = @codProducto;
    END
END
GO

--- LISTAR MOVIMIENTOS
CREATE   PROCEDURE sp_movimiento_listar (
	@descripcion VARCHAR(100) = NULL,
	@codUnidadMedida INT = NULL
)
AS
BEGIN
	select m.codMovimiento, p.codProducto,tp.codTipoMovimiento, m.fechaMovimiento, m.cantidad, 
	m.precioUnitario, m.precioTotal, p.descripcion, tp.descripcion AS 'descripcionTipoMov', 
	um.codUnidadMedida, um.descripcion AS 'descripcionUnidadMedida'
	from
	Movimientos m
	INNER JOIN Productos p ON m.codProducto = p.codProducto
	INNER JOIN TipoMovimiento tp ON m.codTipoMovimiento = tp.codTipoMovimiento
	INNER JOIN UnidadMedida um ON p.codUnidadMedida = um.codUnidadMedida
	WHERE (@descripcion IS NULL OR p.descripcion LIKE @descripcion + '%')
	AND (@codUnidadMedida IS NULL OR p.codUnidadMedida = @codUnidadMedida);
END
GO