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

CREATE TABLE MotivosInhabilitacion(
	codMotivoInhabilitacion INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	observacion VARCHAR(255),
	PRIMARY KEY(codMotivoInhabilitacion)
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

CREATE TABLE TiposBeneficio(
	codTipoBeneficio INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	edadMinima INT,
	edadMaxima INT,
	prioridad INT NOT NULL,
	observaciones VARCHAR(255),
	PRIMARY KEY (codTipoBeneficio)
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

CREATE TABLE TiposLocal(
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
	FOREIGN KEY(codTipoLocal) REFERENCES TiposLocal(codTipoLocal),
	FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);

CREATE TABLE Reconocimientos(
	codReconocimiento INT NOT NULL IDENTITY(1,1),
	codAsociacion INT NOT NULL,
	documento VARCHAR(100) NOT NULL,
	fechaDocumento DATETIME DEFAULT GETDATE(),
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
    numeroFinca INT    
    PRIMARY KEY(codPersona),
    FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);


CREATE TABLE Socios(
	codSocio INT NOT NULL IDENTITY(1,1),	
	codPersona INT NOT NULL,
	codAsociacion INT NOT NULL,
	fechaInicio DATETIME DEFAULT GETDATE(),
	fechaFin DATETIME,
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
	PRIMARY KEY(codBeneficiario),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codSocio) REFERENCES Socios(codSocio),
	FOREIGN KEY(codParentesco) REFERENCES Parentescos(codParentesco),	
);

CREATE TABLE HistoricoBeneficiarios(
	codHistoricoBeneficiario INT NOT NULL IDENTITY(1,1),
	codtipoBeneficio INT NOT NULL,
	peso DECIMAL(3,3),
	talla DECIMAL(3,2),
	hmg DECIMAL(3,2),
	fechaInicio DATETIME,
	fechaTermino DATETIME,
	codEstado INT NOT NULL,
	codMotivoInhabilitacion INT NOT NULL,
	PRIMARY KEY(codHistoricoBeneficiario),
	FOREIGN KEY(codtipoBeneficio) REFERENCES TiposBeneficio(codtipoBeneficio),
	FOREIGN KEY(codMotivoInhabilitacion) REFERENCES MotivosInhabilitacion(codMotivoInhabilitacion)
);

CREATE TABLE Pecosas (
    codPecosa INT IDENTITY PRIMARY KEY,
    codAsociacion INT NOT NULL,
	numeroPecosa VARCHAR(8),
    codSocioPresidenta INT NOT NULL,
    fechaRegistro DATETIME NOT NULL,
    observacion VARCHAR(255),
    codEstado INT NOT NULL,
    FOREIGN KEY (codAsociacion) REFERENCES Asociaciones(codAsociacion),
);
CREATE TABLE DetallePecosa (
    codDetallePecosa INT IDENTITY PRIMARY KEY,
    codProducto INT NOT NULL,
	codPecosa INT NOT NULL,
    prioridad INT NOT NULL,
    fechaDesde DATETIME,
    fechaHasta DATETIME,
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(9,2) NOT NULL,
);

CREATE TABLE UnidadMedida (
	codUnidadMedida INT IDENTITY PRIMARY KEY,
	descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE Productos (
    codProducto INT IDENTITY PRIMARY KEY,
	codUnidadMedida INT NOT NULL,
	codigo INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL UNIQUE,
    abreviatura CHAR(5),
    fechaRegistro DATETIME DEFAULT GETDATE(),
    stock INT,
    precioUnitario DECIMAL(9,2),
    codEstado INT NOT NULL,
    FOREIGN KEY (codEstado) REFERENCES Estados(codEstado),
	FOREIGN KEY (codUnidadMedida) REFERENCES UnidadMedida(codUnidadMedida)
);

CREATE TABLE TipoMovimiento (
    codTipoMovimiento INT IDENTITY PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE Movimientos (
    codMovimiento INT IDENTITY PRIMARY KEY,
    codProducto INT NOT NULL,
    codTipoMovimiento INT NOT NULL,
    fechaMovimiento DATETIME DEFAULT GETDATE(),
	documento VARCHAR(150) NOT NULL,
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(9,2) NOT NULL,
    precioTotal DECIMAL(9,2) NOT NULL,
    FOREIGN KEY (codProducto) REFERENCES Productos(codProducto),
    FOREIGN KEY (codTipoMovimiento) REFERENCES TipoMovimiento(codTipoMovimiento)
);