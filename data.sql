insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(descripcion) values('activo'),('inactivo'),('historico');


insert into usuarios(nombresApellidos, nombreUsuario, password, dni, cui,codRol, codEstado)
values
('Larri Rodrigo Estrada Le�n', 'lestradal', 'admin', '71086437', '9',1, 1),
('Miguel Angel Vega Perez', 'mvegape', 'admin', '74283707', '1',1, 1);





------------------- SECUNDARIA ----------------------------
insert into Sectores(descripcion) values('Wichanzao'),('Central'),('Jerusal�n')

insert into Zonas(descripcion) values('01'),('02')

insert into SectoresZona(codSector, codZona) values(1, 2),(1, 1);

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


select * from Personas