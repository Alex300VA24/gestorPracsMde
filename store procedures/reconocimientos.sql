-- listar reconocimientos por documento y/o asociacion

CREATE OR ALTER PROCEDURE sp_reconocimiento_listar(
	@documento VARCHAR(100) = NULL,
	@codAsociacion INT = NULL
)
AS
BEGIN
	SELECT 
	r.codReconocimiento, 
	r.documento, 
	r.fechaInicio, 
	r.fechaFin,
	a.nombreAsociacion,
	s.descripcion 'sector',
	CONCAT(p.nombres, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) 'presidenta',
	e.abreviatura,
	e.descripcion 'estado' 
	FROM Reconocimientos r 
	INNER JOIN Asociaciones a ON r.codAsociacion = a.codAsociacion
	INNER JOIN SectoresZona sz ON a.codSectorZona = sz.codSectorZona
	INNER JOIN Sectores s ON sz.codSector = s.codSector
	INNER JOIN Directivas d ON r.codReconocimiento = d.codReconocimiento
	INNER JOIN Socios so ON d.codSocio = so.codSocio
	INNER JOIN Personas p ON so.codPersona = p.codPersona
	INNER JOIN Cargos c ON d.codCargo = c.codCargo
	INNER JOIN Estados e ON r.codEstado = e.codEstado
	WHERE c.descripcion = 'presidenta'
	AND (@documento IS NULL OR r.documento LIKE @documento + '%')
	AND (@codAsociacion IS NULL OR a.codAsociacion = @codAsociacion)
END
GO


-- registrar reconocimiento y directivas con cargos ---
ALTER PROCEDURE sp_reconocimiento_directivas_registrar(
	@codAsociacion INT,
	@documento VARCHAR(100),
	@fechaInicio DATE,
	@fechaFin DATE,
	@codSocioPresidente INT,
	@codSocioVicePresidente INT,
	@codSocioSecretaria INT,
	@codSocioTesorera INT,
	@codSocioVocal INT,
	@codSocioCoordinadora INT,
	@codSocioAlmacenera INT,
	@codSocioFiscalizador INT
)
AS
BEGIN	   
	SET NOCOUNT ON 
	BEGIN TRY		
		BEGIN TRANSACTION;
		
		DECLARE @codReconocimiento INT;
		DECLARE @codEstadoActivo INT;

		SELECT @codEstadoActivo = codEstado FROM Estados WHERE abreviatura = 'a';

		INSERT INTO Reconocimientos(codAsociacion, documento, fechaInicio, fechaFin, codEstado)
		VALUES(@codAsociacion, @documento, @fechaInicio, @fechaFin, @codEstadoActivo);

		SET @codReconocimiento = SCOPE_IDENTITY();

		DECLARE @codCargoPresidente INT;
		DECLARE @codCargoVicePresidente INT;
		DECLARE @codCargoSecretaria INT;
		DECLARE @codCargoTesorera INT;
		DECLARE @codCargoVocal INT;
		DECLARE @codCargoCoordinadora INT;
		DECLARE @codCargoAlmacenera INT;
		DECLARE @codCargoFiscalizador INT;	
		
		SELECT @codCargoPresidente = codCargo FROM Cargos WHERE descripcion = 'presidenta';
		SELECT @codCargoVicePresidente = codCargo FROM Cargos WHERE descripcion = 'vice presidenta';
		SELECT @codCargoSecretaria = codCargo FROM Cargos WHERE descripcion = 'secretaria';
		SELECT @codCargoTesorera = codCargo FROM Cargos WHERE descripcion = 'tesorera';
		SELECT @codCargoVocal = codCargo FROM Cargos WHERE descripcion = 'vocal';
		SELECT @codCargoCoordinadora = codCargo FROM Cargos WHERE descripcion = 'coordinadora';
		SELECT @codCargoAlmacenera = codCargo FROM Cargos WHERE descripcion = 'almacenera';
		SELECT @codCargoFiscalizador = codCargo FROM Cargos WHERE descripcion = 'fizcalizador';						

		INSERT INTO Directivas(codReconocimiento, codSocio, codCargo, codEstado)
		VALUES
			(@codReconocimiento, @codSocioPresidente, @codCargoPresidente, @codEstadoActivo),
			(@codReconocimiento, @codSocioVicePresidente, @codCargoVicePresidente, @codEstadoActivo),
			(@codReconocimiento, @codSocioSecretaria, @codCargoSecretaria, @codEstadoActivo),
			(@codReconocimiento, @codSocioTesorera, @codCargoTesorera, @codEstadoActivo),
			(@codReconocimiento, @codSocioVocal, @codCargoVocal, @codEstadoActivo),
			(@codReconocimiento, @codSocioCoordinadora, @codCargoCoordinadora, @codEstadoActivo),
			(@codReconocimiento, @codSocioAlmacenera, @codCargoAlmacenera, @codEstadoActivo),
			(@codReconocimiento, @codSocioFiscalizador, @codCargoFiscalizador, @codEstadoActivo);			
		
		UPDATE Asociaciones SET codEstado = @codEstadoActivo WHERE codAsociacion = @codAsociacion

		COMMIT TRAN;	
		SELECT 'success' as 'status'			
	END TRY
	BEGIN CATCH
		DECLARE 
		@ErrorMessage VARCHAR(2048),
		@ErServery INT,
		@ErState INT

		SELECT
			@ErrorMessage = ERROR_MESSAGE(),
			@ErServery = ERROR_SEVERITY(),
			@ErState = ERROR_STATE()

		ROLLBACK TRAN;					
		SELECT 'error' AS 'status', @ErrorMessage AS ErrorMessage, @ErServery AS Severity, @ErState AS State;
	END CATCH;
	
END
GO


