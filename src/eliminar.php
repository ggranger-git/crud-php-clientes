<?php
/**
 * CONTROLADOR: BAJA O ELIMINACIÓN DE REGISTROS
 * * Este archivo gestiona la eliminación (D) del CRUD basándose en el ID 
 * recibido a través del método GET (URL).
 */

// 1. Verificamos la existencia del parámetro obligatorio 'id' en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // Cargamos los parámetros de la base de datos
    require_once 'connection_db.php';

    // 2. Casteo explícito a entero (int) para sanitizar la entrada bloqueando inyecciones maliciosas
    $id = (int)$_GET['id'];

    try {
        /* 3. Sentencia preparada para ejecutar el borrado seguro
           Filtramos estrictamente mediante la cláusula WHERE para evitar la pérdida masiva de datos.
        */
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        // 4. Ejecución del borrado pasando el ID desinfectado
        $stmt->execute([$id]);

        // 5. Retorno al flujo principal para comprobar los resultados de la acción
        header("Location: index.php");
        exit;

    } catch (PDOException $e) {
        die("Fallo al intentar dar de baja el registro: " . $e->getMessage());
    }
} else {
    // Si se accede sin ID, redirigimos de vuelta por seguridad
    header("Location: index.php");
    exit;
}