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
CREATE PROCEDURE sp_movimiento_listar (
	@descripcion VARCHAR(100) = NULL
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
END
GO

--- ACTUALIZAR MOVIMIENTOS

CREATE PROCEDURE sp_movimiento_actualizar
    @codMovimiento INT, -- Clave primaria del movimiento a actualizar
    @codProducto INT,
    @codTipoMovimiento INT,
    @fechaMovimiento DATETIME,
    @cantidad INT,
    @precioUnitario DECIMAL(9,2)
AS
BEGIN
    -- Declaraciones de variables
    DECLARE @precioTotal DECIMAL(9,2);
    DECLARE @cantidadAnterior INT;
    DECLARE @codTipoMovimientoAnterior INT;

    -- Iniciar transacción para mantener la integridad
    BEGIN TRANSACTION;

    BEGIN TRY
        -- Obtener los valores anteriores del movimiento
        SELECT 
            @cantidadAnterior = cantidad, 
            @codTipoMovimientoAnterior = codTipoMovimiento
        FROM Movimientos
        WHERE codMovimiento = @codMovimiento;

        -- Revertir el impacto del movimiento anterior en el stock
        IF @codTipoMovimientoAnterior = 1 -- Si era una entrada
        BEGIN
            UPDATE Productos
            SET stock = stock - @cantidadAnterior
            WHERE codProducto = @codProducto;
        END
        ELSE IF @codTipoMovimientoAnterior = 2 -- Si era una salida
        BEGIN
            UPDATE Productos
            SET stock = stock + @cantidadAnterior
            WHERE codProducto = @codProducto;
        END

        -- Calcular el nuevo precio total
        SET @precioTotal = @cantidad * @precioUnitario;

        -- Actualizar el movimiento con los nuevos valores
        UPDATE Movimientos
        SET 
            codProducto = @codProducto,
            codTipoMovimiento = @codTipoMovimiento,
            fechaMovimiento = @fechaMovimiento,
            cantidad = @cantidad,
            precioUnitario = @precioUnitario,
            precioTotal = @precioTotal
        WHERE codMovimiento = @codMovimiento;

        -- Aplicar el impacto del nuevo movimiento en el stock
        IF @codTipoMovimiento = 1 -- Si es una entrada
        BEGIN
            UPDATE Productos
            SET stock = stock + @cantidad, precioUnitario = @precioUnitario
            WHERE codProducto = @codProducto;
        END
        ELSE IF @codTipoMovimiento = 2 -- Si es una salida
        BEGIN
            UPDATE Productos
            SET stock = stock - @cantidad
            WHERE codProducto = @codProducto;
        END

        -- Confirmar la transacción si todo es correcto
        COMMIT TRANSACTION;
    END TRY
    BEGIN CATCH
        -- Si ocurre un error, deshacer los cambios
        ROLLBACK TRANSACTION;
        -- Lanzar el error para depuración
        THROW;
    END CATCH
END