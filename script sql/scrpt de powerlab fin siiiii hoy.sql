use powerlab;
DROP TABLE IF EXISTS ;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL,
    genero VARCHAR(10) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    estado CHAR(1) DEFAULT 'A' ,-- 'A' = Activo, 'I' = Inactivo (eliminado)
    contrasenia VARCHAR(255) NOT NULL

);


CREATE TABLE rutinas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    nivel ENUM('principiante', 'intermedio', 'avanzado') NOT NULL,
    dias_por_semana INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_instructor INT,
    nombre VARCHAR(100) NOT NULL,
    estado CHAR(1) DEFAULT 'A',  -- A = Activa, I = Inactiva
    FOREIGN KEY (id_instructor) REFERENCES usuario(id)
);


CREATE TABLE asignaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_deportista INT,
  id_instructor INT,
  tipo_asignacion VARCHAR(20), -- "rutina" o "reporte" ""
  contenido TEXT,
  estado VARCHAR(20) DEFAULT 'pendiente', -- "pendiente", "realizado", "tomado en cuenta "
  fecha_asignacion DATETIME DEFAULT NOW(),
  FOREIGN KEY (id_deportista) REFERENCES usuario(id),
  FOREIGN KEY (id_instructor) REFERENCES usuario(id)
);



INSERT INTO usuario (
    nombre,
    apellido,
    correo,
    fecha_nacimiento,
    genero,
    rol,
    estado,
    contrasenia
) VALUES (
    'mildred',
    'callejas',
    'admin@powerlab.com',
    '1990-01-01',
    'femenino',
    'administrador',
    'A',
    'admin123'
);



SELECT * FROM rutinas;
SELECT * FROM usuario;
SELECT * FROM asignaciones;



INSERT INTO asignaciones (id_instructor, id_deportista, tipo_asignacion, contenido)
VALUES (23, 20, 'rutina', 'Rutina de fuerza: 3 días por semana, 45 min por sesión');