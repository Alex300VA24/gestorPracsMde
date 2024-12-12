CREATE PROCEDURE sp_detallePecosa_guardar(  
 @codProducto INT,  
 @prioridad INT,  
 @fehcaDesde DATETIME,  
 @fechaHasta DATETIME,  
 @cantidad INT,  
 @precioUnitario DECIMAL(9,2)  
  
)  
AS  
BEGIN  
 INSERT INTO DetallePecosa (codProducto, prioridad, fechaDesde, fechaHasta, cantidad, precioUnitario)  
 VALUES (@codProducto, @prioridad, @fehcaDesde, @fechaHasta, @cantidad, @precioUnitario)  
END