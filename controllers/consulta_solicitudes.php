<?php
session_start();
include_once "../models/solicitudes.php";

// Validación de sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'instructor') {
    die("Acceso denegado. Debes iniciar sesión como instructor.");
}

$id_instructor = $_SESSION['usuario']['id'];

$solicitudes = new SolicitudesContacto();
$respuesta = $solicitudes->obtenerSolicitudesPorInstructor($id_instructor);

// Verificación por seguridad
if (!is_array($respuesta)) {
    $respuesta = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Usuarios - PowerLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">
    

    <script>
    function editarFila(enlace) {
        const fila = enlace.closest('tr');
        const id = fila.querySelector('.id');
        const id_usuario = fila.querySelector('. id_usuario');
        const id_instructor = fila.querySelector('.id_instructor');
        const estado = fila.querySelector('.estado');
        const fecha = fila.querySelector('.fecha');

        // valores actuales
        const idVal = id.textContent.trim();
        const id_usuarioVal = id_usuario.textContent.trim();
        const id_instructorVal = id_instructor.textContent.trim();
        const estadoVal = estado.textContent.trim();
        const fechaVal = fecha.textContent.trim();        
        
       
        // inputs
        id_usuario.innerHTML = `<input type='text' name='id_usuario' class='form-control' value='${id_usuarioVal}'>`;
        id_instructor.innerHTML = `<input type='text' name='id_instructor' class='form-control' value='${id_instructorVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;
        fecha.innerHTML = `<input type='text' name='fecha' class='form-control' value='${fecha}'>`;

        const btnEditar = fila.querySelector('.btn-editar');
        const form = document.getElementById("formu");

        // botón actualizar
        const boton = document.createElement('button');
        boton.textContent = 'Actualizar';
        boton.className = 'btn btn-success btn-sm';
        boton.type = 'button';
        boton.onclick = function () {
            const hiddenId = document.createElement('input');
            hiddenId.type = 'hidden';
            hiddenId.name = 'id';
            hiddenId.value = idVal;
            form.appendChild(hiddenId);
            form.action = '../controllers/actualizar.php';
            form.submit();
        };

        btnEditar.replaceWith(boton);
    }

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
                
                <span class="table-light">Gestión de Usuarios - PowerLab</span>
            </div>
            <div>
                <a href="admin-inicio.php" class="btn-outline-secondary">← Volver</a>
            </div>
        </header>

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
            <?php if ($fila['estado'] === 'pendiente'): ?>
                <a href="../controllers/aceptar_solicitud.php?id=<?= $fila['id'] ?>" class="btn btn-success btn-sm">Aceptar</a>
            <?php else: ?>
                <span class="text-success">Aceptada</span>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </form>

        <div class="text-center mt-4">
            <a href="../controllers/reportexls_usuarios.php" class="btn btn-outline-success"> Exportar Excel</a>
            <a href="../controllers/reportepdf_usuarios.php" class="btn btn-outline-danger"> Exportar PDF</a>
        </div>
    </div>

    
</body>
</html>
