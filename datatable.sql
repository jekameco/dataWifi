--database
CREATE DATABASE notas;
--tables
--estudiantes
CREATE TABLE estudiantes (
    idEstudiante int NOT NULL AUTO_INCREMENT,
    Nombre varchar(255) NULL,
    edad int,
    grado int,
    PRIMARY KEY (idEstudiante)
);
--materias
CREATE TABLE materias (
    idMateria int NOT NULL AUTO_INCREMENT,
    NombreMateria varchar(255) NOT NULL,
    PRIMARY KEY (idMateria)
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