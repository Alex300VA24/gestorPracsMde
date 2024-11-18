--- listar asociaciones ---
CREATE PROCEDURE sp_asociacion_listar(
	@nombreAsociacion VARCHAR(100) = NULL,
	@codSector INT = NULL
)
AS
BEGIN
	DECLARE @codEstadoPresidenta INT

	SELECT @codEstadoPresidenta = codCargo FROM Cargos WHERE descripcion = 'presidenta'

	SELECT a.codAsociacion, a.codigoAsociacion ,a.nombreAsociacion, sz.codSectorZona, CONCAT(s.descripcion, ' - ', z.descripcion) 'sector', a.direccion, a.numeroFinca, a.observaciones,
	a.codTipoLocal, t.descripcion 'tipoLocal',
	CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) 'presidenta', 
  (SELECT COUNT(b.codBeneficiario) FROM Beneficiarios b INNER JOIN Socios s ON b.codSocio = s.codSocio WHERE s.codAsociacion = a.codAsociacion) 'cantidadBeneficiarios',
	r.documento, e.abreviatura, e.descripcion 'estado'
	FROM Asociaciones a 
	INNER JOIN TiposLocal t ON a.codTipoLocal = t.codTipoLocal
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
	GROUP BY a.codAsociacion, a.codigoAsociacion, a.nombreAsociacion, sz.codSectorZona, s.descripcion, z.descripcion,
	a.direccion, p.nombres, p.apellidoPaterno, p.apellidoMaterno, e.descripcion, r.documento,
	e.abreviatura, a.numeroFinca, a.observaciones, a.codTipoLocal, t.descripcion, a.fechaRegistro
  ORDER BY a.fechaRegistro DESC
END
GO

--- registrar asociacion ---
CREATE PROCEDURE sp_asociacion_registrar(
  @codigoAsociacion VARCHAR(20),
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

	INSERT INTO Asociaciones(codigoAsociacion, nombreAsociacion, codSectorZona, codTipoLocal, direccion, numeroFinca, observaciones, codEstado)
	VALUES(@codigoAsociacion, @nombreAsociacion, @codSectorZona, @codTipoLocal, @direccion, @numeroFinca, @observacion, @codEstadoPendienteResolucion)
END
GO

--- actualizar asociacion ---
CREATE PROCEDURE sp_asociacion_actualizar(
	@codAsociacion INT,
  @codigoAsociacion VARCHAR(20),
	@nombreAsociacion VARCHAR(100),
	@codSectorZona INT,
	@direccion VARCHAR(200),
	@codTipoLocal INT,
	@numeroFinca INT NULL,
	@observacion VARCHAR(255) NULL
)
AS
BEGIN
	UPDATE Asociaciones SET codigoAsociacion = @codigoAsociacion, nombreAsociacion = @nombreAsociacion, codSectorZona = @codSectorZona, 
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

-- listar asociaciones activas, con reconocimiento activo, pendiente o vencido
CREATE OR ALTER PROCEDURE sp_asociaciones_listar_nuevas_rec_pendiente_rec_vencido
AS
BEGIN
	SELECT a.codAsociacion, a.nombreAsociacion, ea.descripcion 'estado asociacion'
	FROM Asociaciones a
	INNER JOIN Estados ea ON a.codEstado = ea.codEstado
	LEFT JOIN Reconocimientos r ON a.codAsociacion = r.codAsociacion	
	WHERE
	ea.abreviatura = 'pr'
	OR ea.abreviatura = 'a'	
	OR ea.abreviatura = 'rv'
END
GO


--- listar asociaciones activas ---
CREATE OR ALTER PROCEDURE sp_asociacion_listar_activas
AS
BEGIN
	SELECT a.codAsociacion, a.nombreAsociacion,
	s.codSocio 'codSocioPresidenta',
	CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) 'presidenta'
	FROM Asociaciones a 
	INNER JOIN Reconocimientos r ON a.codAsociacion = r.codAsociacion
	INNER JOIN Directivas d ON r.codReconocimiento = d.codReconocimiento
	INNER JOIN Cargos c ON d.codCargo = c.codCargo
	INNER JOIN Estados ea ON a.codEstado = ea.codEstado
	INNER JOIN Estados ed ON d.codEstado = ed.codEstado
	INNER JOIN Socios s ON d.codSocio = s.codSocio
	INNER JOIN Personas p ON s.codPersona = p.codPersona
	INNER JOIN Estados er ON r.codEstado = er.codEstado
	WHERE c.descripcion = 'presidenta'
	AND ea.abreviatura = 'a'
	AND ed.abreviatura = 'a'
	AND er.abreviatura = 'a'
END
GO