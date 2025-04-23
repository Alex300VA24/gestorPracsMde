CREATE DATABASE BDPROVALE
--COLLATE Latin1_General_100_CI_AS_SC_UTF8;-- 
GO

USE BDPROVALE
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
	fechaRegistro DATETIME DEFAULT GETDATE(),
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
	cui CHAR(13) NOT NULL,  -- Cambiado de CHAR a CHAR(13) para un CUI
	codRol INT NOT NULL,
	codEstado INT NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codUsuario),
	FOREIGN KEY(codRol) REFERENCES Roles(codRol)  -- Coma eliminada
);

CREATE TABLE Parentescos(
	codParentesco INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codParentesco)
);

CREATE TABLE TiposBeneficio(
	codTipoBeneficio INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	edadMinima INT,
	edadMaxima INT,
	prioridad INT NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	observaciones VARCHAR(255),
	PRIMARY KEY(codTipoBeneficio)
);

CREATE TABLE Zonas(
	codZona INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) UNIQUE,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codZona)
);

CREATE TABLE Sectores(
	codSector INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) UNIQUE,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codSector)
);

CREATE TABLE SectoresZona(
	codSectorZona INT NOT NULL IDENTITY(1,1),
	codZona INT NOT NULL,
	codSector INT NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codSectorZona),
	FOREIGN KEY(codZona) REFERENCES Zonas(codZona),
	FOREIGN KEY(codSector) REFERENCES Sectores(codSector)
);

CREATE TABLE TiposLocal(
	codTipoLocal INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codTipoLocal)
);

CREATE TABLE Asociaciones(
	codAsociacion INT NOT NULL IDENTITY(1,1),
	codigoAsociacion VARCHAR(20) NOT NULL UNIQUE,
	nombreAsociacion VARCHAR(100) UNIQUE,
	codSectorZona INT NOT NULL,
	codTipoLocal INT NOT NULL,
	direccion VARCHAR(200) NOT NULL,
	numeroFinca INT,
	observaciones VARCHAR(255),
	fechaRegistro DATETIME DEFAULT GETDATE(),
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
	fechaRegistro DATETIME DEFAULT GETDATE(),
	fechaInicio DATE NOT NULL,
	fechaFin DATE NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codReconocimiento),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion)
);

CREATE TABLE Cargos(
	codCargo INT NOT NULL IDENTITY(1,1),	
	descripcion VARCHAR(100) NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
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
    numeroFinca INT,
	fechaRegistro DATETIME DEFAULT GETDATE(),
    PRIMARY KEY(codPersona),
    FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona)
);

CREATE TABLE Socios(
	codSocio INT NOT NULL IDENTITY(1,1),	
	codPersona INT NOT NULL,
	codAsociacion INT NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
	fechaInicio DATETIME DEFAULT GETDATE(),
	fechaFin DATETIME,
	observaciones VARCHAR(255),	
	codEstado INT NOT NULL,
	PRIMARY KEY(codSocio),  -- Corregido
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion)	
);

CREATE TABLE Directivas(
	codDirectiva INT NOT NULL IDENTITY(1,1),	
	codReconocimiento INT NOT NULL,
	codSocio INT NOT NULL,
	codCargo INT NOT NULL,
	fechaRegistro DATETIME DEFAULT GETDATE(),
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
	fechaRegistro DATETIME DEFAULT GETDATE(),
	PRIMARY KEY(codBeneficiario),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codSocio) REFERENCES Socios(codSocio),
	FOREIGN KEY(codParentesco) REFERENCES Parentescos(codParentesco)	
);

CREATE TABLE HistoricoBeneficiarios(
	codHistoricoBeneficiario INT NOT NULL IDENTITY(1,1),
	codTipoBeneficio INT NOT NULL,
  	codBeneficiario INT NOT NULL,
	peso DECIMAL(9,3),
	talla DECIMAL(9,2),
	hmg DECIMAL(9,2),
	fechaInicio DATETIME DEFAULT GETDATE(),
	fechaTermino DATETIME,
  	fechaUltimaMestruacion DATE NULL,
  	fechaProbableParto DATE NULL,
  	fechaDeParto DATE NULL,
  	fechaFinLactancia DATE NULL,
	codEstado INT NOT NULL,
	codMotivoInhabilitacion INT NULL,  -- Especificar que es nulo
	PRIMARY KEY(codHistoricoBeneficiario),
	FOREIGN KEY(codTipoBeneficio) REFERENCES TiposBeneficio(codTipoBeneficio),
  	FOREIGN KEY(codBeneficiario) REFERENCES Beneficiarios(codBeneficiario),
	FOREIGN KEY(codMotivoInhabilitacion) REFERENCES MotivosInhabilitacion(codMotivoInhabilitacion)
);

CREATE TABLE Pecosas (
    codPecosa INT IDENTITY PRIMARY KEY,
    codAsociacion INT NOT NULL,
    numeroPecosa VARCHAR(8),
    codSocioPresidenta INT NOT NULL,
	fechaReparto DATETIME,
    fechaRegistro DATETIME DEFAULT GETDATE(),
    observacion VARCHAR(255),
    codEstado INT NOT NULL,
    FOREIGN KEY (codAsociacion) REFERENCES Asociaciones(codAsociacion)
);

CREATE TABLE UnidadMedida (
	codUnidadMedida INT IDENTITY PRIMARY KEY,
	descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE Productos (
    codProducto INT IDENTITY PRIMARY KEY,
    codUnidadMedida INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL UNIQUE,
    abreviatura CHAR(5),
    fechaRegistro DATETIME DEFAULT GETDATE(),
    stock INT,
    precioUnitario DECIMAL(9,2),
    codEstado INT NOT NULL,
    FOREIGN KEY (codEstado) REFERENCES Estados(codEstado),
	FOREIGN KEY (codUnidadMedida) REFERENCES UnidadMedida(codUnidadMedida)
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
    fechaRegistro DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (codProducto) REFERENCES Productos(codProducto),
    FOREIGN KEY (codPecosa) REFERENCES Pecosas(codPecosa)
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
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(9,2) NOT NULL,
    precioTotal DECIMAL(9,2) NOT NULL,
    FOREIGN KEY (codProducto) REFERENCES Productos(codProducto),
    FOREIGN KEY (codTipoMovimiento) REFERENCES TipoMovimiento(codTipoMovimiento)
);
