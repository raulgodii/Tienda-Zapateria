CREATE DATABASE tienda;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios( 
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
apellidos       varchar(255),
email           varchar(255) not null,
password        varchar(255) not null,
rol             varchar(20),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id) 
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS productos;
CREATE TABLE IF NOT EXISTS productos(
id              int(255) auto_increment not null,
categoria_id    int(255) not null,
nombre          varchar(100) not null,
descripcion     text,
precio          float(100,2) not null,
stock           int(255) not null,
oferta          varchar(2),
fecha           date not null,
imagen          varchar(255),
CONSTRAINT pk_categorias PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS pedidos;
CREATE TABLE IF NOT EXISTS pedidos(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
provincia       varchar(100) not null,
localidad       varchar(100) not null,
direccion       varchar(255) not null,
coste           float(200,2) not null,
estado          varchar(20) not null,
fecha           date,
hora            time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS lineas_pedidos;
CREATE TABLE IF NOT EXISTS lineas_pedidos(
id              int(255) auto_increment not null,
pedido_id       int(255) not null,
producto_id     int(255) not null,
unidades        int(255) not null,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Insertar Admin para probar
INSERT INTO usuarios (nombre, apellidos, email, password, rol)
VALUES ('Administrador', 'Admin Apellidos', 'admin@admin.com', 'admin', 'admin');

-- Insertar 5 categorías
INSERT INTO categorias (nombre) VALUES
('Electrónica'),
('Ropa'),
('Hogar'),
('Deportes'),
('Libros');

-- Insertar 20 productos
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(1, 'Smartphone X', 'Teléfono inteligente de última generación', 699.99, 50, 'No', '2024-01-20', 'producto.png'),
(1, 'Tablet Y', 'Tablet de alta resolución y rendimiento', 299.99, 30, 'Sí', '2024-01-21', 'producto.png'),
(2, 'Camiseta Casual', 'Camiseta cómoda para uso diario', 19.99, 100, 'No', '2024-01-22', 'producto.png'),
(3, 'Sofá Reclinable', 'Sofá cómodo y elegante para el hogar', 799.99, 10, 'No', '2024-01-23', 'producto.png'),
(4, 'Zapatillas Deportivas', 'Zapatillas para correr con tecnología avanzada', 89.99, 50, 'No', '2024-01-24', 'producto.png'),
(5, 'Libro de Ciencia Ficción', 'Novela emocionante ambientada en el futuro', 24.99, 20, 'No', '2024-01-25', 'producto.png'),
(1, 'Auriculares Inalámbricos', 'Auriculares con cancelación de ruido', 129.99, 40, 'Sí', '2024-01-26', 'producto.png'),
(2, 'Vestido Elegante', 'Vestido para ocasiones especiales', 59.99, 25, 'No', '2024-01-27', 'producto.png'),
(3, 'Mesa de Centro', 'Mesa elegante para la sala de estar', 149.99, 15, 'No', '2024-01-28', 'producto.png'),
(4, 'Balón de Fútbol', 'Balón oficial de la liga', 29.99, 30, 'No', '2024-01-29', 'producto.png'),
(5, 'Novela Romántica', 'Historia de amor apasionante', 19.99, 20, 'No', '2024-01-30', 'producto.png');