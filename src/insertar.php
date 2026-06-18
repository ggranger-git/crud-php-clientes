<?php
/**
 * CONTROLADOR: PROCESAMIENTO DE INSERCIÓN DE NUEVOS CLIENTES
 * * Este archivo valida los datos enviados por POST desde index.php y ejecuta
 * la operación de Creación (C) de forma segura. No renderiza código visual.
 */

// 1. Restricción de seguridad: Sólo procesamos datos enviados mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Importamos los parámetros de conexión
    require_once 'connection_db.php';

    // 2. Saneamiento básico: Eliminamos espacios innecesarios al inicio y final de las cadenas
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    
    // Operador ternario shortcut: Si el campo viene vacío, le asignamos NULL en base de datos
    $telefono = trim($_POST['telefono']) ?: null; 

    // 3. Validación en el lado del servidor por si falla el atributo html5 'required'
    if (empty($nombre) || empty($email)) {
        die("Error de validación: El nombre y el email son campos obligatorios.");
    }

    try {
        /* 4. Sentencia Preparada (Seguridad anti Inyección SQL)
           Utilizamos marcadores de posición (?) en lugar de interpolar variables de forma directa.
        */
        $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // 5. Ejecutamos la consulta asociando los datos limpios en un array indexado
        $stmt->execute([$nombre, $email, $telefono]);

        /* 6. Redirección Exitosa (Patrón PRG - Post Redirect Get)
           Al enviar una cabecera de redirección, evitamos que al actualizar la página (F5) 
           el formulario se vuelva a reenviar duplicando registros.
        */
        header("Location: index.php");
        exit; // Detenemos la ejecución por completo

    } catch (PDOException $e) {
        /* 7. Control de Restricciones
           El código SQLSTATE '23000' indica violaciones de clave única (el correo ya existe).
        */
        if ($e->getCode() == 23000) {
            die("Error de Duplicidad: La dirección de correo electrónico ya se encuentra registrada.");
        } else {
            die("Fallo al insertar el registro en la base de datos: " . $e->getMessage());
        }
    }
} else {
    // Si alguien intenta acceder de forma directa escribiendo la URL, lo reconducimos al index
    header("Location: index.php");
    exit;
}