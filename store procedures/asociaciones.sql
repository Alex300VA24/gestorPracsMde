--- listar asociaciones ---
ALTER PROCEDURE sp_asociacion_listar(
	@nombreAsociacion VARCHAR(100) = NULL,
	@codSector INT = NULL
)
AS
BEGIN
	SELECT a.codAsociacion, a.nombreAsociacion, sz.codSectorZona, s.descripcion 'sector', a.direccion, 
	CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) 'presidenta', COUNT(b.codBeneficiario) 'cantidadBeneficiarios',
	r.documento, e.abreviatura, e.descripcion 'estado'
	FROM Asociaciones a 
	INNER JOIN SectoresZona sz ON a.codSectorZona = sz.codSectorZona
	INNER JOIN Sectores s ON sz.codSector = s.codSector
	LEFT JOIN Socios so ON a.codAsociacion = so.codAsociacion
	LEFT JOIN Personas p ON so.codPersona = p.codPersona
	LEFT JOIN Beneficiarios b ON so.codSocio = b.codSocio
	LEFT JOIN Reconocimientos r ON a.codAsociacion = r.codAsociacion
	INNER JOIN Estados e ON a.codEstado = e.codEstado
	WHERE 
	(@codSector IS NULL OR s.codSector = @codSector)
	AND 
	(@nombreAsociacion IS NULL OR a.nombreAsociacion LIKE @nombreAsociacion+'%')
	GROUP BY a.codAsociacion, a.nombreAsociacion, sz.codSectorZona, s.descripcion, 
	a.direccion, p.nombres, p.apellidoPaterno, p.apellidoMaterno, e.descripcion, r.documento, e.abreviatura
END
GO