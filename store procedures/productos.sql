CREATE PROCEDURE sp_producto_registrar
	@codigo INT,
    @descripcion VARCHAR(18),
    @abreviatura VARCHAR(5),
    @unidadMedida VARCHAR(30)
AS
BEGIN
    BEGIN

		DECLARE @codEstadoProducto INT

		SELECT @codEstadoProducto = codEstado FROM Estados WHERE abreviatura = 'a';

        INSERT INTO Productos (codigo, descripcion, abreviatura, unidadMedida, codEstado)
        VALUES (@codigo, @descripcion, @abreviatura, @unidadMedida, @codEstadoProducto);

    END
	
END;