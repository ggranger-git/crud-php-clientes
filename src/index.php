<?php
/**
 * VISTA PRINCIPAL: LISTADO Y FORMULARIO DE ALTA DE CLIENTES
 * * Este archivo lee los registros guardados y provee la interfaz para interactuar
 * con las operaciones de creación (C) y lectura (R) del CRUD.
 */

// Importamos la conexión segura a la base de datos
require_once 'connection_db.php';

try {
    // Definimos la consulta SQL (Ordenamos por ID descendente para ver lo más nuevo primero)
    $sql = "SELECT id, nombre, email, telefono, fecha_registro FROM clientes ORDER BY id DESC";
    
    // Ejecutamos una consulta directa (query) ya que no intervienen variables del usuario
    $stmt = $pdo->query($sql);
    
    // Recuperamos todos los registros devueltos por la base de datos
    $clientes = $stmt->fetchAll();

} catch (PDOException $e) {
    // Manejo de errores en caso de fallo en la consulta de lectura
    die("Error al consultar el listado de clientes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - CRUD PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="max-container">
    <h1>Gestión de Clientes</h1>

    <div class="form-card">
        <h2>Añadir Nuevo Cliente</h2>
        <form action="insertar.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre Completo *</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej. Juan Pérez">
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico *</label>
                <input type="email" id="email" name="email" required placeholder="Ej. juan@correo.com">
            </div>
            
            <div class="form-group">
                <label for="telefono">Número de Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Ej. 600123456">
            </div>
            
            <button type="submit" class="btn-submit">Insertar Cliente</button>
        </form>
    </div>

    <hr>

    <h2>Listado de Clientes Registrados</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clientes) > 0): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id']) ?></td>
                            <td><strong><?= htmlspecialchars($cliente['nombre']) ?></strong></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($cliente['fecha_registro']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $cliente['id'] ?>" class="btn-action btn-edit">Modificar</a>
                                
                                <a href="eliminar.php?id=<?= $cliente['id'] ?>" class="btn-action btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar permanentemente a este cliente?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #7f8c8d;">No se han encontrado clientes en la base de datos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>