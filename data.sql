select * from usuarios
select * from roles

insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(descripcion) values('activo'),('inactivo');

insert into usuarios(nombresApellidos, nombreUsuario, password, dni, cui,codRol, codEstado)
values('Larri Rodrigo Estrada León', 'lestradal', 'admin', '71086437', '9',1, 1)


SELECT u.codUsuario, u.nombresApellidos,u.dni, u.cui, u.nombreUsuario, u.codRol, r.descripcion 'rol', u.codEstado, e.descripcion 'estado'
FROM Usuarios u INNER JOIN Roles r ON u.codRol = r.codRol
JOIN Estados e ON u.codEstado = e.codEstado
WHERE nombreUsuario = 'mvegape' AND password = 'admin' AND e.descripcion = 'activo';

