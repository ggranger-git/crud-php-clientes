-- =====================================================================
-- SCRIPT DE INICIALIZACIÓN DE LA BASE DE DATOS
-- Este script crea la tabla 'clientes' e inserta 20 registros de prueba.
-- =====================================================================

-- 1. Creación de la tabla 'clientes' si no existe previamente
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identificador único autoincremental
    nombre VARCHAR(100) NOT NULL,               -- Nombre completo del cliente (Obligatorio)
    email VARCHAR(100) NOT NULL UNIQUE,         -- Correo electrónico (Obligatorio y único)
    telefono VARCHAR(20) DEFAULT NULL,          -- Teléfono (Opcional, por defecto NULL)
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de alta automática
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Inserción masiva de 20 clientes con datos ficticios para pruebas
INSERT INTO clientes (nombre, email, telefono) VALUES
('Ana García', 'ana@ejemplo.com', '600111222'),
('Luis López', 'luis@ejemplo.com', '600222333'),
('María Ruiz', 'maria@ejemplo.com', '600333444'),
('Carlos Sánchez', 'carlos@ejemplo.com', '600444555'),
('Elena Martínez', 'elena@ejemplo.com', '600555666'),
('Jorge Torres', 'jorge@ejemplo.com', '600666777'),
('Lucía Díaz', 'lucia@ejemplo.com', '600777888'),
('Miguel Castro', 'miguel@ejemplo.com', '600888999'),
('Sofía Romero', 'sofia@ejemplo.com', '600999000'),
('David Navarro', 'david@ejemplo.com', '600000111'),
('Carmen Gil', 'carmen@ejemplo.com', '600111333'),
('Javier Ortiz', 'javier@ejemplo.com', '600222444'),
('Laura Vega', 'laura@ejemplo.com', '600333555'),
('Pablo Serrano', 'pablo@ejemplo.com', '600444666'),
('Marta Molina', 'marta@ejemplo.com', '600555777'),
('Sergio Blanco', 'sergio@ejemplo.com', '600666888'),
('Irene Ramos', 'irene@ejemplo.com', '600777999'),
('Daniel Castro', 'daniel@ejemplo.com', '600888000'),
('Beatriz Pardo', 'beatriz@ejemplo.com', '600999111'),
('Raúl Giménez', 'raul@ejemplo.com', '600000222');