-- Se ejecuta SOLO la primera vez que arranca MariaDB (volumen dbdata vacío),
-- sobre la base de datos indicada en MARIADB_DATABASE.

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO productos (nombre, precio, stock) VALUES
    ('Café Etiopía Yirgacheffe', 8.50, 40),
    ('Café Colombia Huila', 7.90, 25),
    ('Café Brasil Cerrado', 6.75, 60),
    ('Café Guatemala Antigua', 8.20, 0),
    ('Descafeinado Perú Cajamarca', 7.40, 15);
