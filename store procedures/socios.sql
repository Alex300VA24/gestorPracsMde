

--- buscar socio por asociacion y DNI ----
CREATE PROCEDURE sp_socio_buscar_por_dni(
	@codAsociacion INT,
	@dni VARCHAR(8)
)
AS
BEGIN
	SELECT 
	s.codSocio, p.dni, CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ' , p.apellidoMaterno) 'nombres',
	a.nombreAsociacion, e.descripcion 'estadoSocio'
	FROM socios s
	INNER JOIN Asociaciones a ON s.codAsociacion = a.codAsociacion
	INNER JOIN Personas p ON s.codPersona = p.codPersona
	INNER JOIN Estados e ON s.codEstado = e.codEstado
	WHERE 
	e.abreviatura = 'a'
	AND a.codAsociacion = @codAsociacion
	AND p.dni LIKE @dni + '%'
END
GO