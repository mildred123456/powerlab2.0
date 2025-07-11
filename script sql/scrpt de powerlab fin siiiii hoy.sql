use powerlab;
DROP TABLE IF EXISTS rutinas;

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


CREATE TABLE solicitudes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_instructor INT NOT NULL,
    estado VARCHAR(20) DEFAULT 'pendiente',
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
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




SELECT * FROM usuario;
SELECT * FROM asignaciones;
SELECT * FROM solicitudes_contacto;


INSERT INTO asignaciones (
    id_deportista,
    id_instructor,
    tipo_asignacion,
    estado,
    contenido
) VALUES (
    20,               -- ID del deportista (ajusta según tu base de datos)
    23,               -- ID del instructor
    'rutina',        -- o 'reporte'
    'completado',
    'Rutina de pierna: sentadillas, prensa, zancadass.'
);
ALTER TABLE solicitudes_contacto
ADD UNIQUE INDEX solicitud_unica (id_usuario, id_instructor, estado);