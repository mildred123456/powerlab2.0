<?php
// Incluye el modelo de usuario
include "../models/usuario.php";

// Crea un objeto de la clase usuario
$usuario = new usuario();

// Si se enviaron datos por POST (filtro específico)
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    // Realiza una consulta específica según el filtro recibido
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    // Si no se especifica filtro, muestra solo los usuarios con rol 'deportista'
    $respuesta = $usuario->ConsultaEspecifica("rol", "deportista");
}
?>


<!-- Página de consulta de deportistas -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de deportistas - PowerLab</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fuente Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../views/css/consulta_usuarios.css">

    <script>
    // Función para habilitar la edición de una fila de la tabla
    function editarFila(enlace) {
        const fila = enlace.closest('tr');

        // Captura de celdas
        const id = fila.querySelector('.id');
        const nombre = fila.querySelector('.nombre');
        const apellido = fila.querySelector('.apellido');
        const correo = fila.querySelector('.correo');
        const fecha_nacimiento = fila.querySelector('.fecha_nacimiento');
        const genero = fila.querySelector('.genero');
        const estado = fila.querySelector('.estado');

        // Obtención de valores actuales
        const idVal = id.textContent.trim();
        const nombreVal = nombre.textContent.trim();
        const apellidoVal = apellido.textContent.trim();
        const correoVal = correo.textContent.trim();
        const fechaNacimientoVal = fecha_nacimiento.textContent.trim();
        const generoVal = genero.textContent.trim();          
        const estadoVal = estado.textContent.trim();

        // Reemplaza celdas por inputs para editar
        nombre.innerHTML = `<input type='text' name='nombre' class='form-control' value='${nombreVal}'>`;
        apellido.innerHTML = `<input type='text' name='apellido' class='form-control' value='${apellidoVal}'>`;
        correo.innerHTML = `<input type='text' name='correo' class='form-control' value='${correoVal}'>`;
        fecha_nacimiento.innerHTML = `<input type='text' name='fecha_nacimiento' class='form-control' value='${fechaNacimientoVal}'>`;
        genero.innerHTML = `<input type='text' name='genero' class='form-control' value='${generoVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;

        // Botón de actualizar
        const btnEditar = fila.querySelector('.btn-editar');
        const form = document.getElementById("formu");

        const boton = document.createElement('button');
        boton.textContent = 'Actualizar';
        boton.className = 'btn btn-success btn-sm';
        boton.type = 'button';

        // Al pulsar actualizar, se crea un input oculto con el ID y se envía el formulario
        boton.onclick = function () {
            const hiddenId = document.createElement('input');
            hiddenId.type = 'hidden';
            hiddenId.name = 'id';
            hiddenId.value = idVal;
            form.appendChild(hiddenId);
            form.action = '../controllers/actualizar.php';
            form.submit();
        };

        // Reemplaza botón editar por el de actualizar
        btnEditar.replaceWith(boton);
    }

    // Confirmación para eliminar usuario
    function confirmarEliminar(id) {
        if (confirm("¿Estás seguro de eliminar este usuario?")) {
            window.location.href = `../controllers/eliminar.php?id=${id}`;
        }
    }
    </script>
</head>

<!-- Estilos CSS personalizados -->
<style>
    body {
      background-color: #fefefe;
      font-family: 'Montserrat', sans-serif;
    }

    .powerlab-card {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      padding: 2rem;
    }

    .btn-info {
      background-color: #ffa726;
      border-color: #ffa726;
      color: #fff;
    }

    .btn-info:hover {
      background-color: #fb8c00;
      border-color: #fb8c00;
    }

    .table thead {
      background-color: #fff8e1;
      color: #6c4c00;
    }

    .btn-outline-success,
    .btn-outline-danger {
      border-radius: 2rem;
      font-weight: 600;
    }
</style>

<body>
<div class="container mt-5 animate__animated animate__fadeInUp powerlab-card">

  <!-- Encabezado -->
  <header class="d-flex justify-content-between align-items-center mb-4">
    <span class="text-warning fs-5"> Gestión de deportistas - PowerLab</span>
    <a href="admin-inicio.php" class="btn btn-outline-secondary btn-sm">← Volver</a>
  </header>

  <!-- Tabla de usuarios -->
  <form id="formu" method="post">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead class="table-warning">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Fecha nacimiento</th>
          <th>Género</th>
          <th>Estado</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($respuesta as $fila): ?>
          <!-- Muestra cada usuario en una fila -->
          <tr>
            <td class="id"><?= $fila[0] ?></td>
            <td class="nombre"><?= $fila[1] ?></td>
            <td class="apellido"><?= $fila[2] ?></td>
            <td class="correo"><?= $fila[3] ?></td>
            <td class="fecha_nacimiento"><?= $fila[4] ?></td>
            <td class="genero"><?= $fila[5] ?></td>
            <td class="estado"><?= $fila[7] ?></td>
            <!-- Enlaces a acciones específicas -->
            <td><a href="ver_asignaciones.php?id_deportista=<?= $fila[0]; ?>" class="btn btn-info btn-sm"> Ver rutinas</a></td>
            <td><a href="../views/asignar_rutina.php?id_deportista=<?= $fila[0] ?>" class="btn btn-info btn-sm"> Asignar rutina</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>

  <!-- Botones para exportar los datos -->
  <div class="text-center mt-4">
    <form method="POST" action="../controllers/reportexls_deportistas.php" target="_blank" class="d-inline">
      <!-- Envío oculto de filtros aplicados para incluir en el reporte -->
      <input type="hidden" name="dato" value="<?= $_POST['dato'] ?? '' ?>">
      <input type="hidden" name="valor" value="<?= $_POST['valor'] ?? '' ?>">
      <button type="submit" class="btn btn-outline-success"> Exportar Excel</button>
    </form>
    <a href="../controllers/reportepdf_deportistas.php" class="btn btn-outline-danger"> Exportar PDF</a>
  </div>

</div>
</body>
</html>