-- AGREGAR VALORES
INSERT INTO NIVELES (nombreNivel, estado) VALUES 
('Primaria', 1),
('Secundaria', 1),
('Preparatoria', 1),
('Universidad', 1),
('Maestría', 1),
('Doctorado', 1);

INSERT INTO GRADOS (idGrado, idNivel, nombreGrado, estado) VALUES 
(1, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 'Primer Grado', 1),
(2, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 'Segundo Grado', 1),
(1, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 'Primer Grado Secundaria', 1),
(2, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 'Segundo Grado Secundaria', 1),
(1, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Preparatoria'), 'Primer Año Preparatoria', 1),
(1, (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Universidad'), 'Primer Año Universidad', 1);

INSERT INTO SECCIONES (idGrado, idNivel, nombreSeccion, estado) VALUES 
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 'Sección A', 1),
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 'Sección B', 1),
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 'Sección A', 1),
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 'Sección B', 1),
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Año Preparatoria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Preparatoria')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Preparatoria'), 'Sección A', 1),
((SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Año Universidad' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Universidad')), (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Universidad'), 'Sección A', 1);

-- Insertar valores en la tabla AÑO_ESCOLAR
INSERT INTO AÑO_ESCOLAR (añoEscolar, estado) VALUES 
('2024-I', 1),
('2024-II', 1),
('2024-III', 1),
('2025-I', 1),
('2025-II', 1),
('2025-III', 1),
('2026-I', 1),
('2026-II', 1),
('2026-III', 1);

-- Insertar valores en la tabla ASIGNATURAS
INSERT INTO ASIGNATURAS (idCurso, idGrado, idNivel, estado) VALUES 
(
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Matemáticas'), 
    (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria')), 
    (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 
    1
),
(
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Lenguaje'), 
    (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Segundo Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria')), 
    (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'), 
    1
),
(
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Ciencias Naturales'), 
    (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria')), 
    (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 
    1
),
(
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Historia'), 
    (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Segundo Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria')), 
    (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'), 
    1
);

-- Insertar valores en la tabla CAPACIDADES
INSERT INTO CAPACIDADES (idAsignatura, idCurso, descripcion, abreviatura, orden, estado) VALUES 
(
    (SELECT idAsignatura FROM ASIGNATURAS WHERE idCurso = (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Matemáticas') AND idGrado = (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'))), 
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Matemáticas'), 
    'Comprensión y resolución de problemas', 
    'Comp. y Resol. Prob.', 
    1, 
    1
),
(
    (SELECT idAsignatura FROM ASIGNATURAS WHERE idCurso = (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Lenguaje') AND idGrado = (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Segundo Grado' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Primaria'))), 
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Lenguaje'), 
    'Comprensión lectora y expresión escrita', 
    'Comp. Lect. y Escr.', 
    1, 
    1
),
(
    (SELECT idAsignatura FROM ASIGNATURAS WHERE idCurso = (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Ciencias Naturales') AND idGrado = (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Primer Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'))), 
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Ciencias Naturales'), 
    'Investigación científica', 
    'Inv. Científica', 
    1, 
    1
),
(
    (SELECT idAsignatura FROM ASIGNATURAS WHERE idCurso = (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Historia') AND idGrado = (SELECT idGrado FROM GRADOS WHERE nombreGrado = 'Segundo Grado Secundaria' AND idNivel = (SELECT idNivel FROM NIVELES WHERE nombreNivel = 'Secundaria'))), 
    (SELECT idCurso FROM CURSOS WHERE nombreCurso = 'Historia'), 
    'Análisis histórico', 
    'Anál. Hist.', 
    1, 
    1
);