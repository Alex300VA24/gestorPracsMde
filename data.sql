select * from usuarios
select * from roles

insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(descripcion) values('activo'),('inactivo');

insert into usuarios(nombresApellidos, nombreUsuario, password, dni, codRol, codEstado)
values('Miguel Angel Vega Perez', 'mvegape', 'admin', '74283707', 1, 1)


SELECT u.codUsuario, u.nombresApellidos, u.nombreUsuario, u.codRol, r.descripcion 'rol', u.dni, u.codEstado, e.descripcion 'estado'
FROM Usuarios u INNER JOIN Roles r ON u.codRol = r.codRol
JOIN Estados e ON u.codEstado = e.codEstado
WHERE nombreUsuario = 'mvegape' AND password = 'admin';

SELECT name, state_desc
FROM sys.databases
WHERE name = 'DBPROVALE';

USE DBPROVALE;
GO
EXEC sp_addrolemember 'db_owner', 'sa';