--- listar asociaciones ---
CREATE PROCEDURE sp_asociacion_listar(
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

--- registrar asociacion ---
CREATE PROCEDURE sp_asociacion_registrar(
	@nombreAsociacion VARCHAR(100),
	@codSectorZona INT,
	@direccion VARCHAR(200),
	@codTipoLocal INT,
	@numeroFinca INT NULL,
	@observacion VARCHAR(255) NULL
)
AS
BEGIN
	DECLARE @codEstadoPendienteResolucion INT

	SELECT @codEstadoPendienteResolucion = codEstado FROM Estados WHERE abreviatura = 'pr';	

	INSERT INTO Asociaciones(nombreAsociacion, codSectorZona, codTipoLocal, direccion, numeroFinca, observaciones, codEstado)
	VALUES(@nombreAsociacion, @codSectorZona, @codTipoLocal, @direccion, @numeroFinca, @observacion, @codEstadoPendienteResolucion)
END
GO