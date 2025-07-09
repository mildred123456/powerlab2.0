<?php
include "../models/asignaciones.php"; // Clase Asignacion que hicimos antes
$asignacion = new Asignacion();

// Puedes usar sesión si el instructor ya está logueado
// session_start();
// $id_instructor = $_SESSION['id_usuario'];

$id_instructor = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_instructor) {
    $respuesta = $asignacion->obtenerPorInstructor($id_instructor);
} else {
    die("No se ha especificado un instructor.");
}

if ($respuesta instanceof Exception) {
    die("Error en la consulta: " . $respuesta->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignaciones del Instructor - PowerLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">
</head>

<body>
<div class="container bg-white text-dark shadow-sm">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="table-light">Asignaciones realizadas por el Instructor - PowerLab</span>
        </div>
        <div>
            <a href="admin-inicio.php" class="btn-outline-secondary">← Volver</a>
        </div>
    </header>

    <table class="table table-striped table-hover">
    <thead class="text-warning">
    <tr>
        <th>ID</th>
        <th>Deportista</th>
        <th>Tipo</th>
        <th>Contenido</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Actualizar</th>
        <th>Eliminar</th>
    </tr>
</thead>
<tbody>
<?php foreach ($respuesta as $fila): ?>
    <tr>
        <td><?= $fila['id'] ?></td>
        <td><?= $fila['nombre_deportista'] ?></td>
        <td><?= ucfirst($fila['tipo_asignacion']) ?></td>
        <td><?= $fila['contenido'] ?></td>
        <td><?= ucfirst($fila['estado']) ?></td>
        <td><?= $fila['fecha_asignacion'] ?></td>
        <td>
        <td><button type="button" class="btn btn-warning btn-sm btn-editar" onclick="editarFila(this)">Editar</button></td>
        </td>
        <td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $fila[0] ?>)">Eliminar</button></td>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

    </table>
</div>
</body>
</html>
