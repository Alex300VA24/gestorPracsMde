ALTER PROCEDURE sp_pecosa_registrar (  
 @numeroPecosa VARCHAR(8),  
 @codAsociacion INT,  
 @codSocioPresidenta INT,  
 @fechaReparto DATETIME,  
 @observacion VARCHAR(255),
 @codEstado INT
)  
AS  
BEGIN  
 INSERT INTO Pecosas (numeroPecosa, codAsociacion, codSocioPresidenta, fechaReparto, observacion, codEstado)  
 VALUES (@numeroPecosa, @codAsociacion, @codSocioPresidenta, @fechaReparto, @observacion, @codEstado);  
END  

