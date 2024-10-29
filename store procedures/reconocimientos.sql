-- registrar reconocimiento ---
CREATE PROCEDURE sp_reconocimiento_registrar(
	@codAsociacion INT,
	@documento VARCHAR(100),
	@fechaInicio DATE,
	@fechaFin DATE
)
AS
BEGIN
	DECLARE @codEstadoActivo INT

	SELECT @codEstadoActivo = codEstado FROM Estados WHERE abreviatura = 'a'

	INSERT INTO Reconocimiento(codAsociacion, documento, fechaInicio, fechaFin, codEstado)
	VALUES(@codAsociacion, @documento, @fechaInicio, @fechaFin, @codEstadoActivo)
END
GO

-- listar reconocimientos ---



