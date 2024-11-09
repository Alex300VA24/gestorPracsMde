insert into Roles(descripcion) values('administrador'),('usuario');
insert into Estados(abreviatura,descripcion) values('a', 'activo'),('i', 'inactivo'),('h', 'historico'),('pr', 'reconocimiento pendiente'),('rv', 'reconocimiento vencido');
insert into Cargos(descripcion) values('presidenta'),('vice presidenta'),('almacenera'),('tesorera'),('secretaria'),('vocal'),('coordinadora'),('fizcalizador')

------------------- SECUNDARIA ----------------------------
insert into Sectores(descripcion) values('Wichanzao'),('Central'),('Jerusal�n');

insert into Zonas(descripcion) values('01'),('02');

insert into SectoresZona(codSector, codZona) values(1, 1),(1,2),(2, 2),(3, 1),(3,2);

insert into TiposLocal(descripcion) values('propio'),('provisional'),('municipalidad');

insert into Parentescos(descripcion) values('Hijo(a)'), ('Nieto(a)'), ('Sobrino(a)');

insert into TiposBeneficio(descripcion, edadMinima, edadMaxima, prioridad, observaciones)
values('ni�o (0-6 a�os)', 0, 6, 1, ''),('ni�o (7-13 a�os)', 7, 13, 2, ''),
('adulto mayor', 65, null, 2, ''),('madre gestamte', 12, null, 1, ''),
('madre lactante', 12, null, 1, ''),('persona con TBC', 0, null, 2, '');

insert into UnidadMedida(descripcion) values('Bolsa'),('Tarro');

insert into TipoMovimiento(descripcion) values('Ingreso'),('Salida');

insert into Asociaciones(nombreAsociacion , codSectorZona, codTipoLocal, direccion, numeroFinca, observaciones, codEstado) 
values
('Nuevo Amanecer 2', 3, 1, 'Mz. L lt. 15',null, null, 4),
('Divino Jesus', 2, 1, 'Mz. H lt. 23',null, null, 4);

insert into usuarios(nombresApellidos, nombreUsuario, password, dni, cui,codRol, codEstado)
values
('Larri Rodrigo Estrada Le�n', 'lestradal', 'admin', '71086437', '9',1, 1),
('Miguel Angel Vega Perez', 'mvegape', 'admin', '74283707', '1',1, 1);

INSERT INTO Personas(nombres, apellidoPaterno, apellidoMaterno, dni, sexo, telefono, celular,
        fechaNacimiento, codSectorZona, direccion, 
        numeroFinca)
VALUES 
    ('Mar�a Alejandra', 'L�pez', 'Rodr�guez', '12345678', 'f', null, '912345678', '1990-04-15', 1, 'Av. Primavera 100', null),
    ('Ana Sof�a', 'Garc�a', 'Mendoza', '23456789', 'f', null, '912345679', '1992-08-22', 2, 'Calle Olivo 200', null),
    ('Valeria Isabel', 'Morales', 'Jim�nez', '34567890', 'f', null, '912345680', '1988-12-11', 3, 'Paseo de las Flores 300', null),
    ('Daniela Fernanda', 'Ruiz', 'P�rez', '45678901', 'f', null, '912345681', '1991-06-09', 4, 'Av. Los Nogales 400', null),
    ('Camila Victoria', 'Castro', 'Ram�rez', '56789012', 'f', null, '912345682', '1993-01-25', 5, 'Calle Las Rosas 500', null),
    ('Laura Gabriela', 'Torres', 'S�nchez', '67890123', 'f', null, '912345683', '1989-10-14', 1, 'Av. Los Pinos 600', null),
    ('Sara Luc�a', 'R�os', 'Fern�ndez', '78901234', 'f', null, '912345684', '1990-05-07', 2, 'Paseo del Bosque 700', null),
    ('Paula Andrea', 'Castillo', 'G�mez', '89012345', 'f', null, '912345685', '1987-03-03', 3, 'Calle Los �lamos 800', null),
    ('Elena Patricia', 'Delgado', 'Torres', '90123456', 'f', null, '912345686', '1994-09-19', 4, 'Av. Los Robles 900', null),
    ('Rosa Emilia', 'Mart�nez', 'Campos', '01234567', 'f', null, '912345687', '1995-02-28', 5, 'Calle Las Acacias 1000', null),
    ('Julia Alejandra', 'Fern�ndez', 'L�pez', '12345679', 'f', null, '912345688', '1988-11-10', 1, 'Calle Santa Rosa 110', null),
    ('Gabriela Estefan�a', 'V�squez', 'Mart�n', '23456780', 'f', null, '912345689', '1991-02-20', 2, 'Av. del Sol 220', null),
    ('Carla Andrea', 'P�rez', 'Castillo', '34567891', 'f', null, '912345690', '1993-04-15', 3, 'Calle Las Palmas 330', null),
    ('Ver�nica Elena', 'Hern�ndez', 'Salazar', '45678902', 'f', null, '912345691', '1990-08-02', 4, 'Av. San Mart�n 440', null),
    ('Patricia Isabel', 'Mora', 'Quispe', '56789013', 'f', null, '912345692', '1989-05-29', 5, 'Calle Las Lilas 550', null),
    ('Nancy Julieta', 'Torres', 'Cruz', '67890124', 'f', null, '912345693', '1992-07-12', 1, 'Paseo del R�o 660', null),
    ('In�s Carolina', 'Ramos', 'Aldana', '78901235', 'f', null, '912345694', '1994-09-05', 2, 'Calle El Manzano 770', null),
    ('Karla Andrea', 'Vera', 'Arce', '89012346', 'f', null, '912345695', '1987-01-17', 3, 'Av. El Cedro 880', null),
    ('Silvia Estela', 'N��ez', 'Paredes', '90123457', 'f', null, '912345696', '1990-12-11', 4, 'Calle Las Guayabas 990', null),
    ('M�nica Patricia', 'Soto', 'Mart�nez', '01234568', 'f', null, '912345697', '1993-03-26', 5, 'Calle El Sauce 1000', null);

		

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

insert into Reconocimientos(codAsociacion, documento,fechaInicio, fechaFin, codEstado)
values(2, 'RS-203-2024', '2024-10-26', '2026-10-26', 1)

insert into Directivas(codReconocimiento, codSocio, codCargo, codEstado)
values(1, 3, 1, 1)

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