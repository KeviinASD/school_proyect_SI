-- Creación de la tabla NIVELES
CREATE TABLE NIVELES (
    idNivel INT PRIMARY KEY AUTO_INCREMENT,
    nombreNivel VARCHAR(255) NOT NULL UNIQUE,
    estado TINYINT(1) DEFAULT 1
);

-- Creación de la tabla GRADOS
CREATE TABLE GRADOS (
    idGrado INT AUTO_INCREMENT,
    idNivel INT,
    nombreGrado VARCHAR(255) NOT NULL,
    estado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (idNivel) REFERENCES NIVELES(idNivel),

    CONSTRAINT Pk_Grados PRIMARY KEY (idGrado, idNivel)
);

-- Creación de la tabla SECCIONES
CREATE TABLE SECCIONES (
    idSeccion INT AUTO_INCREMENT,
    idGrado INT,
    idNivel INT,
    nombreSeccion VARCHAR(255) NOT NULL,
    estado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (idGrado, idNivel) REFERENCES GRADOS(idGrado, idNivel),

    CONSTRAINT PK_Secciones PRIMARY KEY (idSeccion, idGrado, idNivel)
);

-- Creamos el año_escolar

CREATE TABLE AÑO_ESCOLAR(
    añoEscolar VARCHAR(10) PRIMARY KEY UNIQUE,
    estado TINYINT(1) DEFAULT 1
);

-- Creación de la tabla CURSOS
CREATE TABLE CURSOS (
    idCurso INT PRIMARY KEY AUTO_INCREMENT,
    nombreCurso VARCHAR(255) NOT NULL,
    estado TINYINT(1) DEFAULT 1
);

-- Creación de la tabla ASIGNATURAS
CREATE TABLE ASIGNATURAS (
    idAsignatura INT AUTO_INCREMENT,
    idCurso INT,
    idGrado INT,
    idNivel INT,
    estado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (idGrado, idNivel) REFERENCES GRADOS(idGrado, idNivel),
    FOREIGN KEY (idCurso) REFERENCES CURSOS(idCurso),

    CONSTRAINT PK_Asignatura PRIMARY KEY (idAsignatura, idCurso)
);

-- Creación de la tabla CAPACIDADES
CREATE TABLE CAPACIDADES (
    idCapacidad INT AUTO_INCREMENT,
    idAsignatura INT,
    idCurso INT,
    descripcion VARCHAR(255) NOT NULL,
    abreviatura VARCHAR(50),
    orden INT,
    estado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (idAsignatura, idCurso) REFERENCES ASIGNATURAS(idAsignatura, idCurso),

    CONSTRAINT PK_Capacidades PRIMARY KEY (idCapacidad, idAsignatura, idCurso)
);

-- ALUMNOS --------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE DOMICILIO (
    idDomicilio  INT(3) NOT NULL,
    direccion    CHAR(18) NULL,
    telefono     CHAR(18) NULL,
    departamento CHAR(18) NULL,
    provincia    CHAR(18) NULL,
    distrito     CHAR(18) NULL,
    estado TINYINT(1) DEFAULT 1,
    PRIMARY KEY (idDomicilio)
);

CREATE TABLE ESCALA (
    idEscala     INT(1) NOT NULL,
    nombreEscala VARCHAR(10) NULL,
    estado TINYINT(1) DEFAULT 1,
    PRIMARY KEY (idEscala)
);

CREATE TABLE ESTADO_CIVIL (
    idEstadoCivil     INT(2) NOT NULL,
    nombreEstadoCivil VARCHAR(15) NULL,
    estado TINYINT(1) DEFAULT 1,
    PRIMARY KEY (idEstadoCivil)
);

CREATE TABLE RELIGION (
    idReligion     INT(2) NOT NULL,
    nombreReligion VARCHAR(30) NULL,
    estado TINYINT(1) DEFAULT 1,
    PRIMARY KEY (idReligion)
);

CREATE TABLE SEXO (
    idSexo     INT(1) NOT NULL,
    nombreSexo CHAR(15) NULL,
    estado TINYINT(1) DEFAULT 1,
    PRIMARY KEY (idSexo)
);

CREATE TABLE ALUMNOS (
    codigoAlumno       bigint NOT NULL,
    nombres            VARCHAR(30) NOT NULL,
    apellidos          VARCHAR(30) NOT NULL,
    DNI                CHAR(8) NOT NULL,
    fechaNacimiento    DATE NULL,
    añoIngreso         DATE NULL,
    departamento       VARCHAR(15) NULL,
    pais               VARCHAR(15) NULL,
    provincia          VARCHAR(15) NULL,
    distrito           VARCHAR(15) NULL,
    lenguaMaterna      VARCHAR(15) NULL,
    fechaBautizo       DATE NULL,
    parroquiaDeBautizo VARCHAR(30) NULL,
    colegioProcedencia VARCHAR(30) NULL,
    idDomicilio        int NULL,
    idEstadoCivil      int NULL,
    idReligion         int NULL,
    idEscala           int NULL,
    idSexo             int NULL,
    estado TINYINT(1) DEFAULT 1,
    
    FOREIGN KEY (idDomicilio) REFERENCES DOMICILIO(idDomicilio),
    FOREIGN KEY (idEstadoCivil) REFERENCES ESTADO_CIVIL(idEstadoCivil),
    FOREIGN KEY (idReligion) REFERENCES RELIGION(idReligion),
    FOREIGN KEY (idEscala) REFERENCES ESCALA(idEscala),
    FOREIGN KEY (idSexo) REFERENCES SEXO(idSexo),

    PRIMARY KEY (codigoAlumno)
);

-- DOCENTES FALTA COLOCAR DATIÑOS -----------------------------------------------------------------------------------------------

CREATE TABLE TIPO_DOCENTE (
	id_tipo_docente INT PRIMARY KEY AUTO_INCREMENT,
    nombreTipo VARCHAR(255),
    estado TINYINT(1) DEFAULT 1
);

CREATE TABLE DOCENTES (
	codigo_docente VARCHAR(20) PRIMARY KEY UNIQUE,
    DNI VARCHAR(20) UNIQUE,
    apellidos VARCHAR(255),
    nombres VARCHAR(255),
    direccion VARCHAR(255),
    seguroSocial VARCHAR(255),
    fechaIngreso DATE,
    id_tipo_docente INT,
    id_estado_civil INT,
    estado TINYINT(1) DEFAULT 1,
    
    FOREIGN KEY (id_tipo_docente) REFERENCES TIPO_DOCENTE(id_tipo_docente),
    FOREIGN KEY (id_estado_civil) REFERENCES ESTADO_CIVIL(idEstadoCivil)
);

-- CATEDRAS DE DOCENTES
CREATE TABLE CATEDRAS (
    idCatedra INT,
    codigo_docente VARCHAR(20),
    idSeccion INT,
    idGrado INT,
    idNivel INT,
    idCurso INT,
    añoEscolar VARCHAR(10),
    FOREIGN KEY (codigo_docente) REFERENCES DOCENTES(codigo_docente),
    FOREIGN KEY (añoEscolar) REFERENCES AÑO_ESCOLAR(añoEscolar),
    FOREIGN KEY (idSeccion, idGrado, idNivel) REFERENCES SECCIONES(idSeccion, idGrado, idNivel),
    FOREIGN KEY (idCurso) REFERENCES CURSOS(idCurso),

    CONSTRAINT PK_Catedras PRIMARY KEY(idCatedra, codigo_docente)
);  

-- MATRICULAS DE ALUMNOS
CREATE TABLE FICHA_MATRICULAS (
    nroMatricula bigint ,
    codigoAlumno bigint,
    fechaMatricula DATETIME,
    idSeccion INT,
    idGrado INT,
    idNivel INT,
    añoEscolar VARCHAR(10),

    FOREIGN KEY (codigoAlumno) REFERENCES ALUMNOS(codigoAlumno),
    FOREIGN KEY (idSeccion, idGrado, idNivel) REFERENCES SECCIONES(idSeccion, idGrado, idNivel),
    FOREIGN KEY (añoEscolar) REFERENCES AÑO_ESCOLAR(añoEscolar),

    CONSTRAINT PK_Catedras PRIMARY KEY(nroMatricula, codigoAlumno)
);

-- FICHA DE NOTAS SEGUN DOCENTE
CREATE TABLE FICHA_NOTAS(
    idFicha INT,
    idAsignatura INT,
    idCurso INT,
    codigo_Docente VARCHAR(20),
    fecha DATETIME,
    idSeccion INT,
    idGrado INT,
    idNivel INT,
    añoEscolar VARCHAR(10),
    periodo VARCHAR(10),

    FOREIGN KEY (idAsignatura, idCurso) REFERENCES ASIGNATURAS(idAsignatura, idCurso),
    FOREIGN KEY (codigo_Docente) REFERENCES DOCENTES(codigo_Docente),
    FOREIGN KEY (idSeccion, idGrado, idNivel) REFERENCES SECCIONES(idSeccion, idGrado, idNivel),
    FOREIGN KEY (añoEscolar) REFERENCES AÑO_ESCOLAR(añoEscolar),

    CONSTRAINT PK_Ficha_Notas PRIMARY KEY(idFicha, idAsignatura, idCurso, codigo_Docente)
);

-- DETALLE_NOTAS SEGUN ALUMNOS

CREATE TABLE DETALLE_NOTAS(
    codigoAlumno bigint,
    idFicha INT,
    idAsignatura INT,
    idCurso INT,
    codigo_Docente VARCHAR(20),

    FOREIGN KEY (idFicha, idAsignatura, idCurso, codigo_Docente) REFERENCES FICHA_NOTAS(idFicha, idAsignatura, idCurso, codigo_Docente),

    CONSTRAINT Pk_Detalle_Notas PRIMARY KEY (codigoAlumno, idFicha, idAsignatura, idCurso, codigo_Docente)
);

CREATE TABLE NOTA_CAPACIDAD(
    idCapacidad INT,
    codigoAlumno bigint,
    idFicha INT,
    idAsignatura INT,
    idCurso INT,
    codigo_Docente VARCHAR(20),
    nota float,

    FOREIGN KEY (codigoAlumno, idFicha, idAsignatura, idCurso, codigo_Docente) REFERENCES DETALLE_NOTAS(codigoAlumno, idFicha, idAsignatura, idCurso, codigo_Docente),
    FOREIGN KEY (idCapacidad, idAsignatura, idCurso) REFERENCES CAPACIDADES(idCapacidad, idAsignatura, idCurso),

    CONSTRAINT PK_Nota_Capacidad PRIMARY KEY(idCapacidad, codigoAlumno, idFicha, idAsignatura, idCurso, codigo_Docente)
);
