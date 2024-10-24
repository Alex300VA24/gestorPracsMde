CREATE PROCEDURE sp_producto_registrar
    @descripcion VARCHAR(18),
    @abreviatura VARCHAR(5),
    @unidadMedida VARCHAR(30)
AS
BEGIN
    BEGIN

		DECLARE @codEstadoProducto INT

		SELECT @codEstadoProducto = codEstado FROM Estados WHERE abreviatura = 'a';

        INSERT INTO Producto (descripcion, abreviatura, unidadMedida, codEstado)
        VALUES (@descripcion, @abreviatura, @unidadMedida, @codEstadoProducto);

    END
	
END;