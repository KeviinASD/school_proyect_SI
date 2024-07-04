
-- TABLAS DE LA BASE DE DATOS

-- Tabla niveles
CREATE TABLE NIVELES (
    idNivel INT PRIMARY KEY AUTO_INCREMENT,
    nombreNivel VARCHAR(20) NOT NULL
);
-- Tabla GRADOS
CREATE TABLE GRADOS (
    idGrado INT AUTO_INCREMENT,
    idNivel INT ,
    PRIMARY KEY (idGrado, idNivel),
    nombreGrado VARCHAR(20) NOT NULL,

    FOREIGN KEY (idNivel) REFERENCES NIVELES(idNivel) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Tabla SECCIONES
CREATE TABLE SECCIONES (
    idSeccion INT AUTO_INCREMENT,
    idGrado INT,
    idNivel INT,
    PRIMARY KEY (idSeccion, idGrado, idNivel),
    nombreSeccion VARCHAR(4) NOT NULL,

    FOREIGN KEY (idGrado) REFERENCES GRADOS(idGrado) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idNivel) REFERENCES GRADOS(idNivel) ON DELETE CASCADE ON UPDATE CASCADE
);


-- VALORES PREDETERMINADOS

INSERT INTO NIVELES (nombreNivel) VALUES ('Inicial');       --ID 1
INSERT INTO NIVELES (nombreNivel) VALUES ('Primaria');      --ID 2
INSERT INTO NIVELES (nombreNivel) VALUES ('Secundaria');    --ID 3

INSERT INTO GRADOS (idNivel, nombreGrado) VALUES (1, 'Primer Grado');    --ID 1
INSERT INTO GRADOS (idNivel, nombreGrado) VALUES (1, 'Segundo Grado');    --ID 1

INSERT INTO GRADOS (idNivel, nombreGrado) VALUES (2, 'Primer Grado');    --ID 1
INSERT INTO GRADOS (idNivel, nombreGrado) VALUES (2, 'Segundo Grado');    --ID 1

INSERT INTO SECCIONES (idGrado, idNivel, nombreSeccion) VALUES (1, 1, 'A');

-- Tabla CURSOS
CREATE TABLE CURSOS (
    idCurso INT AUTO_INCREMENT,
    nombreCurso VARCHAR(50) NOT NULL,
    idNivel INT,
    PRIMARY KEY(idCurso),  
    FOREIGN KEY (idNivel) REFERENCES NIVELES(idNivel)
);

-- Tabla ASIGNATURA
CREATE TABLE ASIGNATURA (
    idAsignatura INT AUTO_INCREMENT,
    idCurso INT,
    añoAcademico INT NOT NULL,
    idGrado INT,
    idNivel INT,

    PRIMARY KEY(idAsignatura, idCurso),
    FOREIGN KEY (idCurso) REFERENCES CURSOS(idCurso),
    FOREIGN KEY (idGrado) REFERENCES GRADOS(idGrado),
    FOREIGN KEY (idNivel) REFERENCES SECCIONES(idNivel)
);

-- Tabla CAPACIDADES
CREATE TABLE CAPACIDADES (
    idCapacidad INT AUTO_INCREMENT,
    idCurso INT,
    descripcion VARCHAR(100) NOT NULL,
    abreviatura VARCHAR(10) NOT NULL,
    orden INT NOT NULL,
    PRIMARY KEY(idCapacidad),  
    FOREIGN KEY (idCurso) REFERENCES CURSOS(idCurso)
);