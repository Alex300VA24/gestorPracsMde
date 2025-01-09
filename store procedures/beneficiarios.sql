--- listar beneficiarios ---
CREATE PROCEDURE sp_beneficiario_listar(
  @dni_o_apellidos_y_nombres VARCHAR(200) = NULL,
  @codAsociacion INT = NULL,
  @edad_minima INT = NULL,
  @edad_maxima INT = NULL
)
AS
BEGIN
  SELECT 
  b.codBeneficiario,
  p.codPersona,
  p.nombres,
  p.apellidoPaterno,
  p.apellidoMaterno,
  p.aniosNacido,
  p.dni,
  p.sexo,
  p.fechaNacimiento,
  p.codSectorZona,
  p.direccion,
  b.codParentesco,
  hb.fechaInicio,
  s.codAsociacion,
  tb.codTipoBeneficio,
  tb.descripcion 'tipoBeneficio',
  hb.peso,
  hb.talla,
  hb.hmg,
  e.codEstado,
  e.abreviatura,
  e.descripcion 'estado',
  mi.codMotivoInhabilitacion,
  mi.descripcion 'motivoInhabilitacion'
  FROM Beneficiarios b 
  INNER JOIN Personas p ON b.codPersona = p.codPersona
  INNER JOIN HistoricoBeneficiarios hb ON b.codBeneficiario = hb.codBeneficiario
  INNER JOIN TiposBeneficio tb ON hb.codTipoBeneficio = tb.codTipoBeneficio
  INNER JOIN Socios s ON b.codSocio = s.codSocio
  LEFT JOIN MotivosInhabilitacion mi ON hb.codMotivoInhabilitacion = mi.codMotivoInhabilitacion
  INNER JOIN Estados e ON hb.codEstado = e.codEstado
  WHERE 
  e.abreviatura != 'h'
  AND (
    (@dni_o_apellidos_y_nombres IS NULL OR p.dni LIKE @dni_o_apellidos_y_nombres + '%')
    OR (@dni_o_apellidos_y_nombres IS NULL OR CONCAT(p.apellidoPaterno, ' ', p.apellidoMaterno, ' ', p.nombres) LIKE @dni_o_apellidos_y_nombres + '%')
  )
  AND (@codAsociacion IS NULL OR s.codAsociacion = @codAsociacion)
  AND (
  (@edad_minima IS NULL OR p.aniosNacido >= @edad_minima)
  AND (@edad_maxima IS NULL OR p.aniosNacido <= @edad_maxima))
  ORDER BY b.fechaRegistro DESC
END
GO

--- guardar beneficiario ---
CREATE PROCEDURE sp_beneficiario_guardar(
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
  @beneficiario_codSocio INT,    
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
  

    INSERT INTO Beneficiarios(codPersona, codSocio, codParentesco)
    VALUES(@codPersonaInsert, @beneficiario_codSocio, @beneficiario_codParentesco)
    
    DECLARE @codBeneficiarioInsert INT;
    SET @codBeneficiarioInsert = SCOPE_IDENTITY();
    
    INSERT INTO HistoricoBeneficiarios(codTipoBeneficio, codBeneficiario, peso, talla, hmg, fechaUltimaMestruacion,
    fechaProbableParto, fechaDeParto, fechaFinLactancia, codEstado)
    VALUES(@historico_codTipoBeneficio, @codBeneficiarioInsert, @historico_peso, @historico_talla, @historico_hmg, @historico_fechaUltimaMestruacion,
    @historico_fechaProbableParto, @historico_fechaParto, @historico_fechaFinLactancia, @codEstadoActivo)
       
    
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

--- deshabilitar un beneficiario ---
CREATE PROCEDURE sp_beneficiario_inhabilitar(
  @codBeneficiario INT  
)
AS
BEGIN
  DECLARE @codEstadoInactivo INT
  
  SELECT @codEstadoInactivo = codEstado FROM Estados WHERE abreviatura = 'i'
  
  UPDATE HistoricoBeneficiarios SET codEstado = @codEstadoInactivo WHERE codBeneficiario = @codBeneficiario;
END
GO

--- deshabilitar un beneficiario ---
CREATE PROCEDURE sp_beneficiario_habilitar(
  @codBeneficiario INT  
)
AS
BEGIN
  DECLARE @codEstadoActivo INT
  
  SELECT @codEstadoActivo = codEstado FROM Estados WHERE abreviatura = 'a'
  
  UPDATE HistoricoBeneficiarios SET codEstado = @codEstadoActivo WHERE codBeneficiario = @codBeneficiario;
END
GO
