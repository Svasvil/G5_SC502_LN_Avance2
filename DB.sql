
CREATE DATABASE IF NOT EXISTS citasmedicas;
USE citasmedicas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    usuario VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contrasena VARCHAR(255),
    rol ENUM('admin', 'recepcionista') NOT NULL
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_paciente VARCHAR(100),
    fecha DATE,
    hora TIME,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    nombre_usuario VARCHAR(100)
);

-- correo: admin@demo.com, clave: admin123 , usuario :admin

INSERT INTO usuarios (nombre, correo, usuario, contrasena, rol)
VALUES ('Administrador General', 'admin@demo.com', 'admin',
        '$2y$10$wDFZbnrOavDy2UeH5qFVNeOdqHsqPzbdmjCqQk6nEcO7rkHMmc9me', 'admin');
        
        SHOW DATABASES;
USE citasmedicas;
SHOW TABLES;
SELECT * FROM usuarios WHERE usuario = 'admin';
SELECT usuario, contrasena FROM usuarios WHERE usuario = 'admin';
SET SQL_SAFE_UPDATES = 0;
UPDATE usuarios SET contrasena = '$2y$10$6c4CyJT6jwKEYpjwF0GJFebHRGP40KzxMC40rzXueLAxYOBsO6cBi' WHERE usuario = 'admin';