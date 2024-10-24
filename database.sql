CREATE DATABASE BDPROVALE
COLLATE Latin1_General_100_CI_AS_SC_UTF8;
GO

use BDPROVALE
GO

CREATE TABLE Estados(
	codEstado INT NOT NULL IDENTITY(1,1),
	abreviatura VARCHAR(3) NOT NULL UNIQUE,
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY(codEstado)
);

CREATE TABLE Roles(
	codRol INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY(codRol)
);

CREATE TABLE Usuarios(
	codUsuario INT NOT NULL IDENTITY(1,1),
	nombresApellidos VARCHAR(200) NOT NULL,
	nombreUsuario VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,	
	dni VARCHAR(8) NOT NULL,
	cui CHAR NOT NULL,
	codRol INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codUsuario),
	FOREIGN KEY(codRol) REFERENCES Roles(codRol),
);

CREATE TABLE Parentescos(
	codParentesco INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY(codParentesco)
);

CREATE TABLE TiposBeneficiario(
	codTipoBeneficiario INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	edadMinima INT,
	edadMaxima INT,
	prioridad INT NOT NULL,
	observaciones VARCHAR(255),
	PRIMARY KEY (codTipoBeneficiario)
);

CREATE TABLE Zonas(
	codZona INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) UNIQUE,
	PRIMARY KEY(codZona)
);

CREATE TABLE Sectores(
	codSector INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) UNIQUE,
	PRIMARY KEY(codSector)
);

CREATE TABLE SectoresZona(
	codSectorZona INT NOT NULL IDENTITY(1,1),
	codZona INT NOT NULL,
	codSector INT NOT NULL,
	PRIMARY KEY(codSectorZona),
	FOREIGN KEY(codZona) REFERENCES Zonas(codZona),
	FOREIGN KEY(codSector) REFERENCES Sectores(codSector)
);

CREATE TABLE TipoLocales(
	codTipoLocal INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY(codTipoLocal)
);

CREATE TABLE Asociaciones(
	codAsociacion INT NOT NULL IDENTITY(1,1),
	nombreAsociacion VARCHAR(100) UNIQUE,
	codSectorZona INT NOT NULL,
	codTipoLocal INT NOT NULL,
	direccion VARCHAR(200) NOT NULL,
	numeroFinca INT,
	observaciones VARCHAR(255),
	codEstado INT NOT NULL,
	PRIMARY KEY(codAsociacion),
	FOREIGN KEY(codTipoLocal) REFERENCES TipoLocales(codTipoLocal),
	FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);

CREATE TABLE Reconocimientos(
	codReconocimiento INT NOT NULL IDENTITY(1,1),
	codAsociacion INT NOT NULL,
	documento VARCHAR(100) NOT NULL,
	fechaDocumento DATE NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaFin DATE NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codReconocimiento),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion)
);

CREATE TABLE Cargos(
	codCargo INT NOT NULL IDENTITY(1,1),	
	descripcion VARCHAR(100) NOT NULL,
	PRIMARY KEY(codCargo)
);

/*CREATE TABLE Personas(
	codPersona INT NOT NULL IDENTITY(1,1),
	nombres VARCHAR(100) NOT NULL, 
	apellidoPaterno VARCHAR(50) NOT NULL,
	apellidoMaterno VARCHAR(50) NOT NULL,
	dni VARCHAR(8) NOT NULL UNIQUE,
	sexo CHAR NOT NULL,
	telefono VARCHAR(6),
	celular VARCHAR(9),
	fechaNacimiento DATE NOT NULL,
	aniosNacido INT NOT NULL,
	mesesNacido INT NOT NULL,
	diasNacido INT NOT NULL,
	codSectorZona INT NOT NULL,
	direccion VARCHAR(100) NOT NULL,
	numeroFinca INT,
	codEstado INT NOT NULL,
	PRIMARY KEY(codPersona),
	FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);*/

CREATE TABLE Personas (
    codPersona INT NOT NULL IDENTITY(1,1),
    nombres VARCHAR(100) NOT NULL, 
    apellidoPaterno VARCHAR(50) NOT NULL,
    apellidoMaterno VARCHAR(50) NOT NULL,
    dni VARCHAR(8) NOT NULL UNIQUE,
    sexo CHAR(1) NOT NULL,
    telefono VARCHAR(6),
    celular VARCHAR(9),
    fechaNacimiento DATE NOT NULL,
    aniosNacido AS (
        DATEDIFF(YEAR, fechaNacimiento, GETDATE()) 
        - CASE 
            WHEN MONTH(fechaNacimiento) > MONTH(GETDATE()) 
                OR (MONTH(fechaNacimiento) = MONTH(GETDATE()) 
                    AND DAY(fechaNacimiento) > DAY(GETDATE())) 
            THEN 1 
            ELSE 0 
          END
    ),    
    mesesNacido AS (
        (DATEDIFF(MONTH, fechaNacimiento, GETDATE()) % 12) + 
        CASE 
            WHEN DAY(GETDATE()) < DAY(fechaNacimiento) THEN -1 
            ELSE 0 
        END
    ),       
    diasNacido AS (
        CASE 
            WHEN DAY(GETDATE()) >= DAY(fechaNacimiento) 
            THEN DAY(GETDATE()) - DAY(fechaNacimiento)
            ELSE DAY(EOMONTH(DATEADD(MONTH, -1, GETDATE()))) - DAY(fechaNacimiento) + DAY(GETDATE())
        END
    ),
	codSectorZona INT NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    numeroFinca INT,
    codEstado INT NOT NULL
    PRIMARY KEY(codPersona),
    FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);


CREATE TABLE Socios(
	codSocio INT NOT NULL IDENTITY(1,1),	
	codPersona INT NOT NULL,
	codAsociacion INT NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaFin DATE,
	observaciones VARCHAR(255),
	codEstado INT NOT NULL,
	PRIMARY KEY(codSocio),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion)	
);

CREATE TABLE Directivas(
	codDirectiva INT NOT NULL IDENTITY(1,1),	
	codReconocimiento INT NOT NULL,
	codSocio INT NOT NULL,
	codCargo INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codDirectiva),
	FOREIGN KEY(codReconocimiento) REFERENCES Reconocimientos(codReconocimiento),
	FOREIGN KEY(codSocio) REFERENCES Socios(codSocio),
	FOREIGN KEY(codCargo) REFERENCES Cargos(codCargo)
);

CREATE TABLE Beneficiarios(
	codBeneficiario INT NOT NULL IDENTITY(1,1),
	codPersona INT NOT NULL,
	codSocio INT NOT NULL,
	codParentesco INT NOT NULL,
	edad INT NOT NULL,
	peso DECIMAL(9,2),
	talla DECIMAL(9,2),
	hgb DECIMAL(9,2),
	codTipoBeneficiario INT NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaTermino DATE,
	codEstado INT NOT NULL,
	PRIMARY KEY(codBeneficiario),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codSocio) REFERENCES Socios(codSocio),
	FOREIGN KEY(codParentesco) REFERENCES Parentescos(codParentesco),
	FOREIGN KEY(codTipoBeneficiario) REFERENCES TiposBeneficiario(codTipoBeneficiario),
);

CREATE TABLE Pecosas (
    codPecosa INT IDENTITY PRIMARY KEY,
    codReconocimiento INT NOT NULL,
    codSocioPresidenta INT NOT NULL,
    fechaRegistro DATETIME NOT NULL,
    observacion VARCHAR(255),
    codEstado INT NOT NULL,
    FOREIGN KEY (codReconocimiento) REFERENCES Reconocimientos(codReconocimiento),
);
CREATE TABLE DetallePecosa (
    codDetallePecosa INT IDENTITY PRIMARY KEY,
    codPecosa INT NOT NULL,
    codProducto INT NOT NULL,
    prioridad INT NOT NULL,
    fechaDesde DATETIME,
    fechaHasta DATETIME,
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(9,2) NOT NULL,
);
CREATE TABLE Producto (
    codProducto INT IDENTITY PRIMARY KEY,
	codigo INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL UNIQUE,
    abreviatura CHAR(5),
    unidadMedida VARCHAR(30) NOT NULL,
    fechaRegistro DATETIME DEFAULT GETDATE(),
    stock INT,
    precioUnitario DECIMAL(9,2),
    codEstado INT NOT NULL,
    FOREIGN KEY (codEstado) REFERENCES Estados(codEstado)
);

CREATE TABLE TipoMovimiento (
    codTipoMovimiento INT IDENTITY PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE Movimientos (
    codMovimientoKardex INT IDENTITY PRIMARY KEY,
    codProducto INT NOT NULL,
    codTipoMovimiento INT NOT NULL,
    fechaMovimiento DATETIME DEFAULT GETDATE(),
	documento VARCHAR(150) NOT NULL,
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(9,2) NOT NULL,
    precioTotal DECIMAL(9,2) NOT NULL,
    FOREIGN KEY (codProducto) REFERENCES Producto(codProducto),
    FOREIGN KEY (codTipoMovimiento) REFERENCES TipoMovimiento(codTipoMovimiento)
);
