<?php
/**
 * COMPONENTE MIXTO: CONSULTA Y ACTUALIZACIÓN DE REGISTROS
 * * Este script cumple una doble función:
 * - GET: Busca al cliente según su ID y renderiza un formulario con sus datos actuales.
 * - POST: Procesa los datos modificados y aplica la actualización (U) en el registro.
 */

require_once 'connection_db.php';

// ==========================================
// BLOQUE POST: GUARDAR LOS DATOS MODIFICADOS
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturamos el ID del input oculto (hidden)
    $id       = (int)$_POST['id'];
    $nombre   = trim($_POST['nombre']);
    $email    = trim($_POST['email']);
    $telefono = trim($_POST['telefono']) ?: null;

    if (empty($nombre) || empty($email)) {
        die("Error: Todos los campos marcados como obligatorios deben rellenarse.");
    }

    try {
        // Preparamos el UPDATE correspondiente filtrando estrictamente por el ID recibido
        $sql = "UPDATE clientes SET nombre = ?, email = ?, telefono = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $email, $telefono, $id]);

        // Redirigimos al inicio tras la actualización exitosa
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Error: El correo electrónico introducido ya pertenece a otro cliente.");
        } else {
            die("Error al actualizar la ficha del cliente: " . $e->getMessage());
        }
    }
}

// ==========================================
// BLOQUE GET: CARGAR EL FORMULARIO DE EDICIÓN
// ==========================================
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Buscamos los datos actuales de ese cliente en particular
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cliente = $stmt->fetch();

        // Si el usuario introduce manualmente un ID en la URL que no existe en la BD
        if (!$cliente) {
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al consultar la ficha del cliente: " . $e->getMessage());
    }
} else {
    // Si no se suministra un parámetro ID válido por URL, regresamos al index
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cliente - CRUD PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-card form-card-center">
        <a href="index.php" class="btn-back">← Cancelar y volver al listado</a>
        <h1 style="text-align: center;">Modificar Cliente</h1>
        
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

            <div class="form-group">
                <label for="nombre">Nombre Completo *</label>
                <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($cliente['nombre']) ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico *</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($cliente['email']) ?>">
            </div>
            
            <div class="form-group">
                <label for="telefono">Número de Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
            </div>
            
            <button type="submit" class="btn-submit btn-submit-edit">Guardar Cambios</button>
        </form>
    </div>

</body>
</html>