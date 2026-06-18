<?php
/**
 * CONFIGURACIÓN DE LA CONEXIÓN A LA BASE DE DATOS (PDO)
 * * Este archivo centraliza la conexión con MariaDB/MySQL. Se incluye en los 
 * scripts mediante 'require_once' para evitar duplicación de código.
 */

// Parámetros de configuración (Ajustar según las credenciales del entorno Docker/Host)
$host    = 'db';             -- Nombre del servicio de la base de datos en Docker Compose
$db      = 'crud_db';        -- Nombre de la base de datos
$user    = 'guille';         -- Usuario de acceso
$pass    = 'password123';    -- Contraseña de acceso
$charset = 'utf8mb4';        -- Codificación para soportar caracteres especiales y acentos

// Construcción del Data Source Name (DSN) necesario para PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones de configuración del Driver PDO para entornos de desarrollo y producción
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, -- Lanza excepciones en caso de errores SQL
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       -- Devuelve las filas como arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  -- Desactiva la emulación; usa sentencias preparadas nativas
];

try {
    // Inicialización del objeto PDO (Conexión real a la BD)
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // NOTA: No imprimimos texto aquí para evitar el error "Headers already sent" al redirigir
} catch (\PDOException $e) {
    // Si la conexión falla, detenemos el script y mostramos el motivo del error
    die("Fallo crítico en la conexión a la base de datos: " . $e->getMessage());
}