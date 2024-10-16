------- LISTAR PERSONAS -------
ALTER PROCEDURE sp_persona_listar(
	@DNI VARCHAR(8) = NULL,
	@ApellidosNombres VARCHAR(255) = NULL
)
AS
BEGIN
	SELECT * FROM Personas
	WHERE (@DNI IS NULL OR dni LIKE @DNI + '%')
	AND (@ApellidosNombres IS NULL OR CONCAT(apellidoPaterno, ' ', apellidoMaterno, ' ', nombres) LIKE @ApellidosNombres + '%')
END


------- INSERTAR PERSONA -------
CREATE PROCEDURE sp_persona_insertar(
	@nombres VARCHAR(100),
	@apellidoPaterno VARCHAR(50),
	@apellidoMaterno VARCHAR(50),
	@dni VARCHAR(8),
	@sexo CHAR,
	@telefono VARCHAR(6),
	@celular VARCHAR(9),
	@fechaNacimiento DATE, 
	@codSectorZona INT,
	@direccion VARCHAR(100),
	@numeroFinca INT = NULL	
)
AS
BEGIN    
    DECLARE @codEstadoActivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estados WHERE descripcion = 'activo';

    INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular,
        fechaNacimiento, codSectorZona, direccion, numeroFinca, codEstado)
    VALUES(@nombres, @apellidoPaterno, @apellidoMaterno, @dni, @sexo, @telefono, @celular,
        @fechaNacimiento, @codSectorZona, @direccion, @numeroFinca, @codEstadoActivo);
END
GO




------- VISTA PARA LISTA PERSONAS CON AÑOS, MESES Y DIAS DE NACIDO
------------ ESTA MAL
CREATE VIEW vista_listar_personas_detalle_nacimiento AS
SELECT 
    codPersona, nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono,
    celular, fechaNacimiento,    
    DATEDIFF(YEAR, fechaNacimiento, GETDATE()) 
        - CASE 
            WHEN MONTH(fechaNacimiento) > MONTH(GETDATE()) 
                 OR (MONTH(fechaNacimiento) = MONTH(GETDATE()) 
                     AND DAY(fechaNacimiento) > DAY(GETDATE())) 
            THEN 1 
            ELSE 0 
          END AS aniosNacido,        
    DATEDIFF(MONTH, fechaNacimiento, GETDATE()) 
        - CASE 
            WHEN DAY(fechaNacimiento) > DAY(GETDATE()) THEN 1 ELSE 0 END 
        AS mesesNacido,    
    DATEDIFF(DAY, DATEADD(MONTH, DATEDIFF(MONTH, fechaNacimiento, GETDATE()), fechaNacimiento), GETDATE()) 
        AS diasNacido,    
    codSectorZona, direccion, numeroFinca, codEstado
FROM Personas
GO

