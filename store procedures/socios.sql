--- listar socios ---
CREATE PROCEDURE sp_socio_listar(
  @dni_o_apellidos_y_nombres VARCHAR(200) = NULL,
  @codAsociacion INT = NULL
)
AS
BEGIN
  SELECT s.codSocio,
  p.codPersona,
  p.nombres,
  p.apellidoPaterno,
  p.apellidoMaterno,
  p.sexo,
  p.fechaNacimiento,
  p.codSectorZona,
  p.direccion,
  p.aniosNacido, 
  p.dni,
  s.observaciones,
  a.codAsociacion,
  a.nombreAsociacion,
  c.descripcion 'cargo',
  s.fechaInicio,
  e.abreviatura,
  e.descripcion 'estado'
  FROM Socios s
  INNER JOIN Personas p ON s.codPersona = p.codPersona
  INNER JOIN Asociaciones a ON s.codAsociacion = a.codAsociacion
  INNER JOIN Estados e ON s.codEstado = e.codEstado
  LEFT JOIN Directivas d ON s.codSocio = d.codSocio
  LEFT JOIN Cargos c ON d.codCargo = c.codCargo
  WHERE
  (@dni_o_apellidos_y_nombres IS NULL OR p.dni LIKE @dni_o_apellidos_y_nombres + '%')
  OR
  (@dni_o_apellidos_y_nombres IS NULL OR CONCAT(p.apellidoPaterno, ' ', p.apellidoMaterno, ' ', p.nombres) LIKE @dni_o_apellidos_y_nombres + '%')
  AND
  (@codAsociacion IS NULL OR a.codAsociacion = @codAsociacion)
END
GO


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

--- guardar socios ---
ALTER PROCEDURE sp_socio_guardar(
  @persona_nombres VARCHAR(100),
  @persona_apellidoPaterno VARCHAR(50),
  @persona_apellidoMaterno VARCHAR(50),
  @persona_dni VARCHAR(8),
  @persona_sexo CHAR(1),
  @persona_telefono VARCHAR(6) = NULL,
  @persona_celular VARCHAR(9) = NULL,
  @persona_fechaNacimiento DATE,
  @persona_codSectorZona INT,
  @persona_direccion VARCHAR(100),
  @persona_numeroFinca INT = NULL,  
  @socio_codAsociacion INT,
  @socio_observacion VARCHAR(255) = NULL,
  @es_socio_beneficiario INT,  
  @beneficiario_codParentesco INT = NULL,
  @historico_codTipoBeneficio INT = NULL,  
  @historico_peso DECIMAL(9,3) = NULL,
  @historico_talla DECIMAL(9,2) = NULL,
  @historico_hmg DECIMAL(9,2) = NULL,
  @historico_fechaUltimaMestruacion DATE = NULL,
  @historico_fechaProbableParto DATE = NULL,
  @historico_fechaParto DATE = NULL,
  @historico_fechaFinLactancia DATE = NULL
)
AS
BEGIN
  SET NOCOUNT ON
  BEGIN TRY
    BEGIN TRANSACTION    

    DECLARE @codEstadoActivo INT
  
    SELECT @codEstadoActivo = codEstado FROM Estados WHERE abreviatura = 'a'         
  
    INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular, fechaNacimiento,
    codSectorZona, direccion, numeroFinca) 
    VALUES (@persona_nombres, @persona_apellidoPaterno, @persona_apellidoMaterno, @persona_dni, @persona_sexo,
    @persona_telefono, @persona_celular, @persona_fechaNacimiento, @persona_codSectorZona, @persona_direccion,
    @persona_numeroFinca)  
  
    DECLARE @codPersonaInsert INT;
    SET @codPersonaInsert = SCOPE_IDENTITY();    
  
  
    INSERT INTO Socios(codPersona, codAsociacion, observaciones, codEstado)
    VALUES(@codPersonaInsert, @socio_codAsociacion, @socio_observacion, @codEstadoActivo)
    
    DECLARE @codSocioInsert INT;
    SET @codSocioInsert = SCOPE_IDENTITY();   
  
    IF @es_socio_beneficiario = 1    
    BEGIN
      INSERT INTO Beneficiarios(codPersona, codSocio, codParentesco)
      VALUES(@codPersonaInsert, @codSocioInsert, @beneficiario_codParentesco)
      
      DECLARE @codBeneficiarioInsert INT;
      SET @codBeneficiarioInsert = SCOPE_IDENTITY();
      
      INSERT INTO HistoricoBeneficiarios(codTipoBeneficio, codBeneficiario, peso, talla, hmg, fechaUltimaMestruacion,
      fechaProbableParto, fechaDeParto, fechaFinLactancia, codEstado)
      VALUES(@historico_codTipoBeneficio, @codBeneficiarioInsert, @historico_peso, @historico_talla, @historico_hmg, @historico_fechaUltimaMestruacion,
      @historico_fechaProbableParto, @historico_fechaParto, @historico_fechaFinLactancia, @codEstadoActivo)
    END     
    
    COMMIT TRAN;
    SELECT 'success' as 'status', @codSocioInsert as 'codSocio'
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