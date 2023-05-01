--database
CREATE DATABASE notas;
--tables
--estudiantes
CREATE TABLE estudiantes (
    idEstudiante int NOT NULL AUTO_INCREMENT,
    Nombre varchar(255) NULL ,
    edad int,
    grado int,
    PRIMARY KEY (idEstudiante),
    UNIQUE (Nombre)
);
--materias
CREATE TABLE materias (
    idMateria int NOT NULL AUTO_INCREMENT,
    NombreMateria varchar(255) NOT NULL ,
    PRIMARY KEY (idMateria),
     UNIQUE (NombreMateria)
);
--calificaciones
CREATE TABLE calificaciones (
    idCalificaciones int NOT NULL AUTO_INCREMENT,
    FechaRegistro DATE NOT NULL,
    NombreEstudiante varchar(255) NOT NULL,
    NombreMateria  varchar(255) NOT NULL,
    CalificacionFinal DECIMAL NOT NULL,
    PRIMARY KEY (idCalificaciones)
);

--data in table
INSERT INTO 
`estudiantes`(
    
     `Nombre`, 
     `edad`, 
     `grado`) 
VALUES 
    ('Jenny Mesa','21','9'), 
    ('Felipe Mesa','25','11'), 
    ('Pepito Perez','17','6'), 
    ('Mildred Angarita','14','3');

INSERT INTO  `materias`
 (
  `NombreMateria`) 
  VALUES 
  ('Matematicas'),
  ('Sociales'),
  ('Ingles');

INSERT INTO `calificaciones`
(
`FechaRegistro`, 
`NombreEstudiante`, 
`NombreMateria`, 
`CalificacionFinal`) 
VALUES 
('2023-05-1','Jenny Mesa','Matematicas','5'),
('2023-05-1','Jenny Mesa','Ingles','4'),
('2023-05-1','Jenny Mesa','Sociales','9'),
('2023-05-1','Felipe Mesa','Matematicas','8'),
('2023-05-1','Felipe Mesa','Sociales','4'),
('2023-05-1','Felipe Mesa','Ingles','3'),
('2023-05-1','Pepito Perez','Matematicas','10'),
('2023-05-1','Pepito Perez','Sociales','1'),
('2023-05-1','Pepito Perez','Ingles','8');