
-- REGISTRO PRODUCTOS
CREATE PROCEDURE sp_producto_registrar
	@codigo INT,
    @descripcion VARCHAR(100),
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

--- LISTA DE PRODUCTOS
CREATE PROCEDURE [dbo].[sp_producto_listar](
    @Descripcion VARCHAR(100) = NULL,
    @Codigo INT = NULL
 
)
AS
BEGIN
    SELECT p.*, e.abreviatura 'abreviaturaEstado', e.descripcion 'descripcionEstado'
	FROM Productos p
	INNER JOIN Estados e ON p.codEstado = e.codEstado
    WHERE (@Descripcion IS NULL OR p.descripcion LIKE @Descripcion + '%')
    AND (@Codigo IS NULL OR p.codigo = @Codigo);
END;



---ACTUALIZAR PRODUCTOS
CREATE PROCEDURE sp_producto_actualizar (
	@codProducto INT,
	@codigo INT,
	@descripcion VARCHAR(100),
    @abreviatura VARCHAR(5),
    @unidadMedida VARCHAR(30)
)
AS
BEGIN
	UPDATE Productos SET codigo = @codigo, descripcion = @descripcion, abreviatura = @abreviatura, 
	unidadMedida = @unidadMedida
	WHERE codProducto = @codProducto
END