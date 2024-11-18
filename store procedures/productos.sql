--Registrar productos---
CREATE PROCEDURE sp_producto_registrar (
    @descripcion VARCHAR(100),
    @abreviatura VARCHAR(5),
    @codUnidadMedida VARCHAR(30)
)
AS
BEGIN
    BEGIN

		DECLARE @codEstadoProducto INT

		SELECT @codEstadoProducto = codEstado FROM Estados WHERE abreviatura = 'a';

        INSERT INTO Productos (descripcion, abreviatura, codUnidadMedida, codEstado, stock)
        VALUES (@descripcion, @abreviatura, @codUnidadMedida, @codEstadoProducto, 0);

    END
	
END
GO


---Lista de productos---
CREATE PROCEDURE sp_producto_listar (
    @Descripcion VARCHAR(100) = NULL
)
AS
BEGIN
    SELECT p.*, e.abreviatura 'abreviaturaEstado', e.descripcion 'descripcionEstado',
	um.codUnidadMedida, um.descripcion AS 'descripcionUnidadMedida'
	FROM Productos p
	INNER JOIN Estados e ON p.codEstado = e.codEstado
	INNER JOIN UnidadMedida um ON p.codUnidadMedida =um.codUnidadMedida
    WHERE (@Descripcion IS NULL OR p.descripcion LIKE @Descripcion + '%')

END
GO

---Actualizar productos---
CREATE PROCEDURE sp_producto_actualizar (
	@codProducto INT,
	@descripcion VARCHAR(100),
    @abreviatura VARCHAR(5),
    @codUnidadMedida VARCHAR(30)
)
AS
BEGIN
	UPDATE Productos SET descripcion = @descripcion, abreviatura = @abreviatura, 
	codUnidadMedida = @codUnidadMedida
	WHERE codProducto = @codProducto
END
GO