CREATE DATABASE BDPROVALE
COLLATE Latin1_General_100_CI_AS_SC_UTF8;
GO

use BDPROVALE
GO

CREATE TABLE Estados(
	codEstado INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(10) NOT NULL UNIQUE,
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
	codRol INT NOT NULL,
	dni VARCHAR(8) NOT NULL,
	cui CHAR NOT NULL,
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
	edadMinima INT NOT NULL,
	edadMaxima INT NOT NULL, 
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

/*
CREATE TABLE Calles(
	codCalle INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY(codCalle)
);*/

CREATE TABLE Asociaciones(
	codAsociacion INT NOT NULL IDENTITY(1,1),
	nombreAsociacion VARCHAR(100) UNIQUE,
	codSectorZona INT NOT NULL,
	calle VARCHAR(200) NOT NULL,
	numeroFinca INT NOT NULL,
	observaciones VARCHAR(255),
	codEstado INT NOT NULL,
	PRIMARY KEY(codAsociacion),
	FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona),
	FOREIGN KEY(codEstado) REFERENCES Estados(codEstado)
);

CREATE TABLE Reconocimientos(
	codReconocimiento INT NOT NULL IDENTITY(1,1),
	codAsociacion INT NOT NULL,	
	documento VARCHAR(100) NOT NULL,
	fechaDoc DATE NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaFin DATE NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codReconocimiento),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion),
	FOREIGN KEY(codEstado) REFERENCES Estados(codEstado)
);

CREATE TABLE Cargos(
	codCargo INT NOT NULL IDENTITY(1,1),	
	descripcion VARCHAR(100) NOT NULL,
	PRIMARY KEY(codCargo)
);

CREATE TABLE Personas(
	codPersona INT NOT NULL IDENTITY(1,1),
	nombres VARCHAR(100) NOT NULL, 
	apellidoPaterno VARCHAR(50) NOT NULL,
	apellidoMaterno VARCHAR(50) NOT NULL,
	dni VARCHAR(8) NOT NULL UNIQUE,
	sexo CHAR NOT NULL,
	telefono VARCHAR(9) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	aniosNacido INT NOT NULL,
	mesesNacido INT NOT NULL,
	diasNacido INT NOT NULL,
	codSectorZona INT NOT NULL,
	calle VARCHAR(100) NOT NULL,
	numeroFinca VARCHAR(100) NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codPersona),
	FOREIGN KEY(codSectorZona) REFERENCES SectoresZona(codSectorZona),
	FOREIGN KEY(codEstado) REFERENCES Estados(codEstado)
);

CREATE TABLE Asociados(
	codAsociado INT NOT NULL IDENTITY(1,1),	
	codPersona INT NOT NULL,
	codAsociacion INT NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaFin DATE,
	observaciones VARCHAR(255),
	codEstado INT NOT NULL,
	PRIMARY KEY(codAsociado),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codAsociacion) REFERENCES Asociaciones(codAsociacion),
	FOREIGN KEY(codEstado) REFERENCES Estados(codEstado)
);

CREATE TABLE Directivas(
	codDirectiva INT NOT NULL IDENTITY(1,1),	
	codReconocimiento INT NOT NULL,
	codAsociado INT NOT NULL,
	codCargo INT NOT NULL,
	PRIMARY KEY(codDirectiva),
	FOREIGN KEY(codReconocimiento) REFERENCES Reconocimientos(codReconocimiento),
	FOREIGN KEY(codAsociado) REFERENCES Asociados(codAsociado),
	FOREIGN KEY(codCargo) REFERENCES Cargos(codCargo)
);

CREATE TABLE Beneficiarios(
	codBeneficiario INT NOT NULL IDENTITY(1,1),
	codPersona INT NOT NULL,
	codAsociado INT NOT NULL,
	codParentesco INT NOT NULL,
	edad INT NOT NULL,
	peso DECIMAL(9,2),
	talla DECIMAL(9,2),
	hgb DECIMAL(9,2),
	codTipoBeneficiario INT NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaTermino DATE,
	codUsuario INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codBeneficiario),
	FOREIGN KEY(codPersona) REFERENCES Personas(codPersona),
	FOREIGN KEY(codAsociado) REFERENCES Asociados(codAsociado),
	FOREIGN KEY(codParentesco) REFERENCES Parentescos(codParentesco),
	FOREIGN KEY(codTipoBeneficiario) REFERENCES TiposBeneficiario(codTipoBeneficiario),
	FOREIGN KEY(codUsuario) REFERENCES Usuarios(codUsuario),
	FOREIGN KEY(codEstado) REFERENCES Estados(codEstado)
);

