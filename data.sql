insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(abreviatura,descripcion) values('a', 'activo'),('i', 'inactivo'),('h', 'historico'),('pr', 'reconocimiento pendiente'),('rv', 'reconocimiento vencido');
insert into Cargos(descripcion) values('presidenta'),('vice presidenta'),('almacenera'),('tesorera'),('secretaria'),('vocal'),('coordinadora'),('fizcalizador')

------------------- SECUNDARIA ----------------------------
insert into Sectores(descripcion) values('Wichanzao'),('Central'),('Jerusalén');

insert into Zonas(descripcion) values('01'),('02');

insert into SectoresZona(codSector, codZona) values(1, 1),(1,2),(2, 2),(3, 1),(3,2);

insert into TiposLocal(descripcion) values('propio'),('provisional'),('municipalidad');

insert into Parentescos(descripcion) values('Hijo(a)'), ('Nieto(a)'), ('Sobrino(a)');

insert into TiposBeneficio(descripcion, edadMinima, edadMaxima, prioridad, observaciones)
values('niño (0-6 años)', 0, 6, 1, ''),('niño (7-13 años)', 7, 13, 2, ''),
('adulto mayor', 65, null, 2, ''),('madre gestamte', 12, null, 1, ''),
('madre lactante', 12, null, 1, ''),('persona con TBC', 0, null, 2, '');


insert into Asociaciones(nombreAsociacion , codSectorZona, codTipoLocal, direccion, numeroFinca, observaciones, codEstado) 
values
('Nuevo Amanecer 2', 3, 1, 'Mz. L lt. 15',null, null, 4),
('Divino Jesus', 2, 1, 'Mz. H lt. 23',null, null, 4);

insert into usuarios(nombresApellidos, nombreUsuario, password, dni, cui,codRol, codEstado)
values
('Larri Rodrigo Estrada León', 'lestradal', 'admin', '71086437', '9',1, 1),
('Miguel Angel Vega Perez', 'mvegape', 'admin', '74283707', '1',1, 1);

INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular,
        fechaNacimiento, codSectorZona, direccion, 
        numeroFinca)
    VALUES 
    ('María Alejandra', 'López', 'Rodríguez', '12345678', 'f', null, '912345678', '15-04-1990', 1, 'Av. Primavera 100', null),
    ('Ana Sofía', 'García', 'Mendoza', '23456789', 'f', null, '912345679', '22-08-1992', 2, 'Calle Olivo 200', null),
    ('Valeria Isabel', 'Morales', 'Jiménez', '34567890', 'f', null, '912345680', '11-12-1988', 3, 'Paseo de las Flores 300', null),
    ('Daniela Fernanda', 'Ruiz', 'Pérez', '45678901', 'f', null, '912345681', '09-06-1991', 4, 'Av. Los Nogales 400', null),
    ('Camila Victoria', 'Castro', 'Ramírez', '56789012', 'f', null, '912345682', '25-01-1993', 5, 'Calle Las Rosas 500', null),
    ('Laura Gabriela', 'Torres', 'Sánchez', '67890123', 'f', null, '912345683', '14-10-1989', 1, 'Av. Los Pinos 600', null),
    ('Sara Lucía', 'Ríos', 'Fernández', '78901234', 'f', null, '912345684', '07-05-1990', 2, 'Paseo del Bosque 700', null),
    ('Paula Andrea', 'Castillo', 'Gómez', '89012345', 'f', null, '912345685', '03-03-1987', 3, 'Calle Los Álamos 800', null),
    ('Elena Patricia', 'Delgado', 'Torres', '90123456', 'f', null, '912345686', '19-09-1994', 4, 'Av. Los Robles 900', null),
    ('Rosa Emilia', 'Martínez', 'Campos', '01234567', 'f', null, '912345687', '28-02-1995', 5, 'Calle Las Acacias 1000', null),
	('Julia Alejandra', 'Fernández', 'López', '12345679', 'f', null, '912345688', '10-11-1988', 1, 'Calle Santa Rosa 110', null),
    ('Gabriela Estefanía', 'Vásquez', 'Martín', '23456780', 'f', null, '912345689', '20-02-1991', 2, 'Av. del Sol 220', null),
    ('Carla Andrea', 'Pérez', 'Castillo', '34567891', 'f', null, '912345690', '15-04-1993', 3, 'Calle Las Palmas 330', null),
    ('Verónica Elena', 'Hernández', 'Salazar', '45678902', 'f', null, '912345691', '02-08-1990', 4, 'Av. San Martín 440', null),
    ('Patricia Isabel', 'Mora', 'Quispe', '56789013', 'f', null, '912345692', '29-05-1989', 5, 'Calle Las Lilas 550', null),
    ('Nancy Julieta', 'Torres', 'Cruz', '67890124', 'f', null, '912345693', '12-07-1992', 1, 'Paseo del Río 660', null),
    ('Inés Carolina', 'Ramos', 'Aldana', '78901235', 'f', null, '912345694', '05-09-1994', 2, 'Calle El Manzano 770', null),
    ('Karla Andrea', 'Vera', 'Arce', '89012346', 'f', null, '912345695', '17-01-1987', 3, 'Av. El Cedro 880', null),
    ('Silvia Estela', 'Núñez', 'Paredes', '90123457', 'f', null, '912345696', '11-12-1990', 4, 'Calle Las Guayabas 990', null),
    ('Mónica Patricia', 'Soto', 'Martínez', '01234568', 'f', null, '912345697', '26-03-1993', 5, 'Calle El Sauce 1000', null);
		

INSERT INTO Socios(codPersona, codAsociacion, observaciones, codEstado)
VALUES
(1, 1, '', 1),
(2, 1, '', 1),
(3, 1, '', 1),
(4, 1, '', 1),
(5, 1, '', 1),
(6, 1, '', 1),
(7, 1, '', 1),
(8, 1, '', 1),
(9, 2, '', 1),
(10, 2, '', 1),
(12, 2, '', 1),
(13, 2, '', 1),
(14, 2, '', 1),
(15, 2, '', 1),
(16, 2, '', 1);

insert into Reconocimientos(codAsociacion, documento, fechaDocumento, fechaInicio, fechaFin, codEstado)
values(2, 'RS-203-2024', '2024-10-20', '2024-10-26', '2026-10-26', 1)

insert into Directivas(codReconocimiento, codSocio, codCargo, codEstado)
values(1, 31, 1, 1)

select * from Socios


--exec sp_persona_insertar 'carlos', 'pereira', 'leyva', '74902012', 'm', null, '900212453', '10-10-1970', 2, 'los jaureles M.2 LT.3', null










select * from asociaciones
select * from Estados
select * from Personas
select * from SectoresZona
exec sp_asociacion_listar

select sz.codSectorZona, s.descripcion 'sector', z.descripcion 'zona' from SectoresZona sz
INNER JOIN Sectores s ON sz.codSector = s.codSector
INNER JOIN Zonas z ON sz.codZona = z.codZona
ORDER BY s.descripcion