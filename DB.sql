CREATE DATABASE IF NOT EXISTS ProyectoAmbienteWebG5;
USE ProyectoAmbienteWebG5;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    usuario VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contrasena VARCHAR(255),
    rol ENUM('admin', 'cliente') NOT NULL
);

INSERT INTO usuarios (nombre, correo, usuario, contrasena, rol)
VALUES ('Administrador General', 'admin@demo.com', 'admin',
        '$2y$10$6c4CyJT6jwKEYpjwF0GJFebHRGP40KzxMC40rzXueLAxYOBsO6cBi', 'admin');

CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(100) NOT NULL
);

CREATE TABLE Productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_producto VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255),
    id_categoria INT,
    especie_relacionada VARCHAR(100),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabla para los servicios
CREATE TABLE Servicios (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_servicio VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2),
    tipo_servicio ENUM('Talleres', 'Visitas educativas') NOT NULL
);

-- Insertar categorías
INSERT INTO categorias (nombre_categoria) VALUES
('Alimento para Mascotas'),
('Peces'),
('Acuarios y Equipos'),
('Cuidado Personal'),
('Accesorios'),
('Juguetes'),
('Camas y Descanso'),
('Decoración'),
('Alimentadores Automáticos'),
('Jaulas y Hábitats');

-- Insertar productos de ejemplo
INSERT INTO Productos (nombre_producto, descripcion, precio, imagen_url, id_categoria, especie_relacionada) VALUES
('Comida para Gatos Bigotes', 'Nutrición completa y balanceada que mantiene a tu gato feliz y saludable.', 15500.00, '../Img/AlimentoParaGatos.jpg', 1, 'Gatos'),
('Pez Koi', 'Perfectos para estanques, estos peces traen belleza y tranquilidad. ¡2x1 por tiempo limitado!', 35000.00, '../Img/PezKoi.jpg', 2, 'Koi'),
('Pecera de Agua Dulce', 'Ideal para peces tropicales. Crea tu propio ecosistema acuático desde cero.', 125000.00, '../Img/pecera1.jpg', 3, 'Peces tropicales'),
('Filtro para Acuario', 'Mantiene el agua limpia y saludable para tus peces, con filtración mecánica y biológica.', 45000.00, '../Img/filtro.jpg', 3, 'Todos los peces'),
('Aireador de Burbujas LED', 'Añade oxígeno y estilo a tu pecera con luces LED y burbujas decorativas.', 25000.00, '../Img/aireador.png', 3, 'Peces de acuario'),
('Shampoo Hipoalergénico', 'Especial para pieles sensibles. Ideal para perros y gatos. Aroma suave y duradero.', 12000.00, '../Img/shampoo.jpg', 4, 'Perros y Gatos'),
('Collar Reflectante', 'Seguridad para tus paseos nocturnos. Ajustable y cómodo para perros de todos los tamaños.', 8500.00, '../Img/collar.jpg', 5, 'Perros'),
('Juguete Interactivo', 'Estimula la mente y el cuerpo de tu mascota. Ideal para juegos de búsqueda y recompensa.', 18000.00, '../Img/juguete.jpg', 6, 'Perros y Gatos'),
('Cama Antiestrés', 'Felpa suave y diseño circular para máximo confort. Ideal para perros y gatos pequeños.', 35000.00, '../Img/cama.jpg', 7, 'Perros y Gatos'),
('Decoración LED para Peceras', 'Rocas artificiales con luz LED. Añade color sin afectar a tus peces.', 15000.00, '../Img/decoracion.jpg', 8, 'Peces de acuario'),
('Dispensador de Alimento', 'Programa comidas para tu mascota. Hasta 6L de capacidad. Ideal para gatos y perros medianos.', 65000.00, '../Img/dispensador.png', 9, 'Perros y Gatos'),
('Jaula para Hámster', 'Con túneles, rueda y doble nivel. Espacio ideal para el juego y descanso de tu roedor.', 45000.00, '../Img/jaula.jpg', 10, 'Hámsters');

CREATE TABLE IF NOT EXISTS especies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  habitat VARCHAR(60),
  dieta VARCHAR(60),
  tamano VARCHAR(40),
  cuidados VARCHAR(255),
  imagen VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS adopciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL,
  especie VARCHAR(100) NOT NULL,
  detalle TEXT,
  fecha_solicitud DATETIME NOT NULL
);