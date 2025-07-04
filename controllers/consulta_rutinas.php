<?php
require_once '../models/usuario.php';
include('../models/conexion.php');

$rutinas = new rutinas(); 

if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $rutinas->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    if (isset($_SESSION['usuario']['id'])) {
        $id_instructor = $_SESSION['usuario']['id'];
        $respuesta = $rutinas->ConsultaEspecifica("id_instructor", $id_instructor);
    } else {
        echo "<script>
                alert('No has iniciado sesión');
                location.href = '../views/login.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Rutinas - PowerLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">

    <script>
    function editarFila(enlace) {
        const fila = enlace.closest('tr');
        const id = fila.querySelector('.id');
        const titulo = fila.querySelector('.titulo');
        const descripcion = fila.querySelector('.descripcion');
        const nivel = fila.querySelector('.nivel');
        const dias_por_semana = fila.querySelector('.dias_por_semana');

        const idVal = id.textContent.trim();
        const tituloVal = titulo.textContent.trim();
        const descripcionVal = descripcion.textContent.trim();
        const nivelVal = nivel.textContent.trim();
        const diasVal = dias_por_semana.textContent.trim();

        titulo.innerHTML = `<input type='text' name='titulo' class='form-control' value='${tituloVal}'>`;
        descripcion.innerHTML = `<input type='text' name='descripcion' class='form-control' value='${descripcionVal}'>`;
        nivel.innerHTML = `
            <select name='nivel' class='form-control'>
                <option value='principiante' ${nivelVal === 'principiante' ? 'selected' : ''}>Principiante</option>
                <option value='intermedio' ${nivelVal === 'intermedio' ? 'selected' : ''}>Intermedio</option>
                <option value='avanzado' ${nivelVal === 'avanzado' ? 'selected' : ''}>Avanzado</option>
            </select>`;
        dias_por_semana.innerHTML = `<input type='number' name='dias_por_semana' class='form-control' value='${diasVal}' min='1' max='7'>`;

        const btnEditar = fila.querySelector('.btn-editar');
        const form = document.getElementById("formu");

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
            form.action = '../controllers/actualizar-rutina.php';
            form.submit();
        };

        btnEditar.replaceWith(boton);
    }

    function confirmarEliminar(id) {
        if (confirm("¿Estás seguro de eliminar esta rutina?")) {
            window.location.href = `../controllers/eliminar-rutina.php?id=${id}`;
        }
    }
    </script>
</head>

<body>
<div class="container bg-black text-white p-4 rounded">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <span class="text-warning">Gestión de Rutinas - PowerLab</span>
        <a href="admin-inicio.php" class="btn btn-outline-light btn-sm">← Volver</a>
    </header>

    <form id="formu" method="post">
        <table class="table table-dark table-hover text-center align-middle">
            <thead class="text-warning">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Nivel</th>
                    <th>Días por Semana</th>
                    <th>Fecha de Creación</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($respuesta as $fila): ?>
                    <tr>
                        <td class="id"><?= htmlspecialchars($fila[0]) ?></td>
                        <td class="titulo"><?= htmlspecialchars($fila[1]) ?></td>
                        <td class="descripcion"><?= htmlspecialchars($fila[2]) ?></td>
                        <td class="nivel"><?= htmlspecialchars($fila[3]) ?></td>
                        <td class="dias_por_semana"><?= htmlspecialchars($fila[4]) ?></td>
                        <td class="fecha_creacion"><?= htmlspecialchars($fila[5]) ?></td>
                        <td><button type="button" class="btn btn-warning btn-sm btn-editar" onclick="editarFila(this)">Editar</button></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $fila[0] ?>)">Eliminar</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

    <div class="text-center mt-4">
        <a href="../controllers/reportexls_rutinas.php" class="btn btn-outline-success">Exportar Excel</a>
        <a href="../controllers/reportepdf_rutinas.php" class="btn btn-outline-danger">Exportar PDF</a>
    </div>
</div>
</body>
</html>
