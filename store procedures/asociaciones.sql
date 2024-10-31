--- listar asociaciones ---
CREATE OR ALTER PROCEDURE sp_asociacion_listar(
	@nombreAsociacion VARCHAR(100) = NULL,
	@codSector INT = NULL
)
AS
BEGIN
	DECLARE @codEstadoPresidenta INT

	SELECT @codEstadoPresidenta = codCargo FROM Cargos WHERE descripcion = 'presidenta'

	SELECT a.codAsociacion, a.nombreAsociacion, sz.codSectorZona, CONCAT(s.descripcion, ' - ', z.descripcion) 'sector', a.direccion, a.numeroFinca, a.observaciones,
	a.codTipoLocal,
	CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) 'presidenta', COUNT(b.codBeneficiario) 'cantidadBeneficiarios',
	r.documento, e.abreviatura, e.descripcion 'estado'
	FROM Asociaciones a 
	INNER JOIN SectoresZona sz ON a.codSectorZona = sz.codSectorZona
	INNER JOIN Sectores s ON sz.codSector = s.codSector	
	INNER JOIN Zonas z ON sz.codZona = z.codZona
	LEFT JOIN Reconocimientos r ON a.codAsociacion = r.codAsociacion
	LEFT JOIN Directivas d ON r.codReconocimiento = d.codReconocimiento
	LEFT JOIN Socios so ON d.codSocio = so.codSocio
	LEFT JOIN Personas p ON so.codPersona = p.codPersona
	LEFT JOIN Beneficiarios b ON so.codSocio = b.codSocio
	INNER JOIN Estados e ON a.codEstado = e.codEstado	
	WHERE 
	(@codSector IS NULL OR s.codSector = @codSector)
	AND 
	(@nombreAsociacion IS NULL OR a.nombreAsociacion LIKE @nombreAsociacion+'%')	
	AND (d.codCargo IS NULL OR d.codCargo = @codEstadoPresidenta)
	GROUP BY a.codAsociacion, a.nombreAsociacion, sz.codSectorZona, s.descripcion, z.descripcion,
	a.direccion, p.nombres, p.apellidoPaterno, p.apellidoMaterno, e.descripcion, r.documento,
	e.abreviatura, a.numeroFinca, a.observaciones, a.codTipoLocal
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

--- actualizar asociacion ---
CREATE PROCEDURE sp_asociacion_actualizar(
	@codAsociacion INT,
	@nombreAsociacion VARCHAR(100),
	@codSectorZona INT,
	@direccion VARCHAR(200),
	@codTipoLocal INT,
	@numeroFinca INT NULL,
	@observacion VARCHAR(255) NULL
)
AS
BEGIN
	UPDATE Asociaciones SET nombreAsociacion = @nombreAsociacion, codSectorZona = @codSectorZona, 
	codTipoLocal= @codTipoLocal, direccion = @direccion, numeroFinca = @numeroFinca, observaciones = @observacion 
	WHERE codAsociacion = @codAsociacion
END
GO

-- listar asociaciones nuevas o con reconocimiento vencido
CREATE PROCEDURE sp_asociaciones_listar_nuevas_y_reconocimiento_vencido
AS
BEGIN
	DECLARE @CodEstadoPendienteReconocimiento INT
	DECLARE @CodEstadoReconocimientoVencido INT

	SELECT @CodEstadoPendienteReconocimiento = codEstado FROM Estados WHERE abreviatura = 'pr'
	SELECT @CodEstadoReconocimientoVencido = codEstado FROM Estados WHERE abreviatura = 'rv'

	SELECT codAsociacion, nombreAsociacion FROM Asociaciones 
	WHERE codEstado = @CodEstadoPendienteReconocimiento OR codEstado = @CodEstadoReconocimientoVencido
END
GO