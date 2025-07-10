<?php
include "../models/asignaciones.php";
$usuario = new asignaciones();

if (!empty($_GET["id_deportista"])) {
    $respuesta = $usuario->ConsultaEspecifica("id_deportista", $_GET["id_deportista"]);
} elseif (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de  - PowerLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">
    

    <script>
    function editarFila(enlace) {
        const fila = enlace.closest('tr');
        const id = fila.querySelector('.id');
        const nombre_deportista = fila.querySelector('.nombre_deportista');
        const tipo_asignacion = fila.querySelector('.tipo_asignacion');
        const contenido = fila.querySelector('.contenido');
        const estado = fila.querySelector('.estado');
        const fecha_asignacion = fila.querySelector('.fecha_asignacion');

        // valores actuales
        const idVal = id.textContent.trim();
        const nombre_deportistaVal = nombre_deportista.textContent.trim();
        const tipo_asignacionVal = tipo_asignacion.textContent.trim();
        const contenidoVal = contenido.textContent.trim();
        const estadoVal = estado.textContent.trim();
        const fecha_asignacionVal = fecha_asignacion.textContent.trim();          

        // inputs
        nombre_deportista.innerHTML = `<input type='text' name='nombre_deportista' class='form-control' value='${nombre_deportistaVal}'>`;
        tipo_asignacion.innerHTML = `<input type='text' name='tipo_asignacion' class='form-control' value='${tipo_asignacionVal}'>`;
        contenido.innerHTML = `<input type='text' name='contenido' class='form-control' value='${contenidoVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;
        fecha_asignacion.innerHTML = `<input type='text' name='fecha_asignacion' class='form-control' value='${fecha_asignacionVal}'>`;
    
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
            form.action = '../controllers/actualizar-asignaciones.php';
            form.submit();
        };

        btnEditar.replaceWith(boton);
    }

    function confirmarEliminar(id) {
        if (confirm("¿Estás seguro de eliminar este usuario?")) {
            window.location.href = `../controllers/eliminar-asignacion.php?id=${id}`;
        }
    }


    
</script>


</head>

<body>
<div class="container bg-white text-dark shadow-sm">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                
                <span class="table-light">Gestión  - PowerLab</span>
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
                <th>Deportista</th>
                <th>tipo</th>
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
                            <td class="id"><?= $fila[0] ?></td>
                            <td class="nombre_deportista"><?= $fila[1] ?></td>
                            <td class="tipo_asignacion"><?= $fila[2] ?></td>
                            <td class="contenido"><?= $fila[3] ?></td>
                            <td class="estado"><?= $fila[4] ?></td>
                            <td class="fecha_asignacion"><?= $fila[5] ?></td>
                            
                            <td><button type="button" class="btn btn-warning btn-sm btn-editar" onclick="editarFila(this)">Actulizar</button></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $fila[0] ?>)">Dar por terminada</button></td>
                            
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
