<?php
session_start(); // Inicia o reanuda la sesión

include_once "../models/solicitudes.php"; // Incluye el modelo que maneja las solicitudes de contacto

// Validación de sesión y rol
// Verifica si el usuario ha iniciado sesión y tiene rol de instructor
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'instructor') {
    // Si no hay sesión o no es instructor, se deniega el acceso
    die("Acceso denegado. Debes iniciar sesión como instructor.");
}

// Extrae el ID del instructor desde la sesión y lo guarda en la variable $id_instructor
$id_instructor = $_SESSION['usuario']['id'];

// Crea una instancia del modelo de solicitudes
$solicitudes = new SolicitudesContacto();

// Obtiene las solicitudes que le corresponden a ese instructor
$respuesta = $solicitudes->obtenerSolicitudesPorInstructor($id_instructor);

// Verifica que la respuesta sea un array para evitar errores en la vista
if (!is_array($respuesta)) {
    $respuesta = []; // Si hay un error o no hay datos, asigna un array vacío
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Usuarios - PowerLab</title>

    <!-- Bootstrap y estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">

    <script>
    // Función para habilitar edición de fila (no está activada en la tabla actual, pero está lista)
    function editarFila(enlace) {
        const fila = enlace.closest('tr');
        const id = fila.querySelector('.id');
        const id_usuario = fila.querySelector('. id_usuario');
        const id_instructor = fila.querySelector('.id_instructor');
        const estado = fila.querySelector('.estado');
        const fecha = fila.querySelector('.fecha');

        // Extrae valores actuales de las celdas
        const idVal = id.textContent.trim();
        const id_usuarioVal = id_usuario.textContent.trim();
        const id_instructorVal = id_instructor.textContent.trim();
        const estadoVal = estado.textContent.trim();
        const fechaVal = fecha.textContent.trim();

        // Reemplaza las celdas por inputs para permitir la edición
        id_usuario.innerHTML = `<input type='text' name='id_usuario' class='form-control' value='${id_usuarioVal}'>`;
        id_instructor.innerHTML = `<input type='text' name='id_instructor' class='form-control' value='${id_instructorVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;
        fecha.innerHTML = `<input type='text' name='fecha' class='form-control' value='${fecha}'>`;

        const btnEditar = fila.querySelector('.btn-editar');
        const form = document.getElementById("formu");

        // Crea botón para enviar cambios
        const boton = document.createElement('button');
        boton.textContent = 'Actualizar';
        boton.className = 'btn btn-success btn-sm';
        boton.type = 'button';
        boton.onclick = function () {
            // Inserta ID oculto para identificar la fila que se actualiza
            const hiddenId = document.createElement('input');
            hiddenId.type = 'hidden';
            hiddenId.name = 'id';
            hiddenId.value = idVal;
            form.appendChild(hiddenId);
            form.action = '../controllers/actualizar.php';
            form.submit();
        };

        btnEditar.replaceWith(boton); // Reemplaza botón editar por actualizar
    }

    // Confirmación para eliminar usuario (no se usa en esta tabla, pero está preparado)
    function confirmarEliminar(id) {
        if (confirm("¿Estás seguro de eliminar este usuario?")) {
            window.location.href = `../controllers/eliminar.php?id=${id}`;
        }
    }
    </script>
</head>

<body>
<div class="container bg-white text-dark shadow-sm">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <!-- Título de la sección -->
            <span class="table-light">Gestión de Usuarios - PowerLab</span>
        </div>
        <div>
            <!-- Botón para volver -->
            <a href="admin-inicio.php" class="btn-outline-secondary">← Volver</a>
        </div>
    </header>

    <!-- Tabla de solicitudes -->
    <form id="formu" method="post">
        <table class="table table-striped table-hover">
            <thead class="text-warning">
                <tr>
                    <th>ID</th>
                    <th>id_usuario</th>
                    <th>id_instructor</th>
                    <th>estado</th>
                    <th>fecha</th>
                    <th>aceptar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($respuesta as $fila): ?>
                <tr>
                    <td><?= $fila['id'] ?></td>
                    <td><?= $fila['id_usuario'] ?></td>
                    <td><?= $fila['id_instructor'] ?></td>
                    <td><?= $fila['estado'] ?></td>
                    <td><?= $fila['fecha'] ?></td>
                    <td>
                        <!-- Si la solicitud está pendiente, muestra botón para aceptar -->
                        <?php if ($fila['estado'] === 'pendiente'): ?>
                            <a href="../controllers/aceptar_solicitud.php?id=<?= $fila['id'] ?>" class="btn btn-success btn-sm">Aceptar</a>
                        <?php else: ?>
                            <!-- Si ya fue aceptada, muestra texto -->
                            <span class="text-success">Aceptada</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

    <!-- Botones para exportar datos -->
    <div class="text-center mt-4">
        <a href="../controllers/reportexls_solicitudes.php" class="btn btn-outline-success"> Exportar Excel</a>
        <a href="../controllers/reportepdf_solicitudes.php" class="btn btn-outline-danger"> Exportar PDF</a>
    </div>
</div>
</body>
</html>
