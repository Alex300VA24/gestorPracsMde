insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(abreviatura,descripcion) values('a', 'activo'),('i', 'inactivo'),('h', 'historico'),('pr', 'pendiente reconocimiento');


insert into usuarios(nombresApellidos, nombreUsuario, password, dni, cui,codRol, codEstado)
values
('Larri Rodrigo Estrada León', 'lestradal', 'admin', '71086437', '9',1, 1),
('Miguel Angel Vega Perez', 'mvegape', 'admin', '74283707', '1',1, 1);





------------------- SECUNDARIA ----------------------------
insert into Sectores(descripcion) values('Wichanzao'),('Central'),('Jerusalén')

insert into Zonas(descripcion) values('01'),('02')

insert into SectoresZona(codSector, codZona) values(1, 1),(1,2),(2, 2),(3, 1),(3,2);

insert into TipoLocales(descripcion) values('propio'),('provisional'),('municipalidad')

exec sp_persona_insertar 'carlos', 'pereira', 'leyva', '74902012', 'm', null, '900212453', '10-10-1970', 2, 'los jaureles M.2 LT.3', null

INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular,
        fechaNacimiento, codSectorZona, direccion, 
        numeroFinca, codEstado)
    VALUES('jose', 'rojas', 'perez', '78390212', 'm', null, '912030123', 
	'20-01-2020', 1, 'jr montufar 1024', null, 1)

INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular,
        fechaNacimiento, codSectorZona, direccion, 
        numeroFinca, codEstado)
    VALUES('angela', 'perez', 'quezada', '78490124', 'f', null, '922041111', 
	'15-10-2020', 2, 'jr jaureles 2203', null, 1)


insert into Asociaciones(nombreAsociacion , codSectorZona, codLocal, direccion, numeroFinca,
observaciones, codEstado) values('Nuevo Renacer', 3, 1, 'Mz. L lt. 15',null, null, 2)


select * from asociaciones
select * from Estados
select * from Personas
select * from SectoresZona
exec sp_asociacion_listar

select sz.codSectorZona, s.descripcion 'sector', z.descripcion 'zona' from SectoresZona sz
INNER JOIN Sectores s ON sz.codSector = s.codSector
INNER JOIN Zonas z ON sz.codZona = z.codZona
ORDER BY s.descripcion