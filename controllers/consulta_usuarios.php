<?php
include "../models/usuario.php";
$usuario = new usuario();

if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}

if ($respuesta instanceof Exception) {
    die("Error en la consulta: " . $respuesta->getMessage());
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
        const nombre = fila.querySelector('.nombre');
        const apellido = fila.querySelector('.apellido');
        const correo = fila.querySelector('.correo');
        const fecha_nacimiento = fila.querySelector('.fecha_nacimiento');
        const genero = fila.querySelector('.genero');
        const rol = fila.querySelector('.rol');
        const estado = fila.querySelector('.estado');
        const contrasenia = fila.querySelector('.contrasenia');

        // valores actuales
        const idVal = id.textContent.trim();
        const nombreVal = nombre.textContent.trim();
        const apellidoVal = apellido.textContent.trim();
        const correoVal = correo.textContent.trim();
        const fechaNacimientoVal = fecha_nacimiento.textContent.trim();
        const generoVal = genero.textContent.trim();          
        const rolVal = rol.textContent.trim();
        const estadoVal = estado.textContent.trim();
        const contraseniaVal = contrasenia.textContent.trim();

        // inputs
        nombre.innerHTML = `<input type='text' name='nombre' class='form-control' value='${nombreVal}'>`;
        apellido.innerHTML = `<input type='text' name='apellido' class='form-control' value='${apellidoVal}'>`;
        correo.innerHTML = `<input type='text' name='correo' class='form-control' value='${correoVal}'>`;
        fecha_nacimiento.innerHTML = `<input type='text' name='fecha_nacimiento' class='form-control' value='${fechaNacimientoVal}'>`;
        genero.innerHTML = `<input type='text' name='genero' class='form-control' value='${generoVal}'>`;
        rol.innerHTML = `<input type='text' name='rol' class='form-control' value='${rolVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;
        contrasenia.innerHTML = `<input type='text' name='contrasenia' class='form-control' value='${contraseniaVal}'>`;

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
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>fecha_nacimiento</th>
                        <th>Género</th>
                        <th>Rol</th>
                        <th>estado</th>
                        <th>contraseña</th>
                        <th>actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($respuesta as $fila): ?>
                        <tr>
                            <td class="id"><?= $fila[0] ?></td>
                            <td class="nombre"><?= $fila[1] ?></td>
                            <td class="apellido"><?= $fila[2] ?></td>
                            <td class="correo"><?= $fila[3] ?></td>
                            <td class="fecha_nacimiento"><?= $fila[4] ?></td>
                            <td class="genero"><?= $fila[5] ?></td>
                            <td class="rol"><?= $fila[6] ?></td>
                            <td class="estado"><?= $fila[7] ?></td>
                            <td class="contrasenia"><?= $fila[8] ?></td>
                            <td><button type="button" class="btn btn-warning btn-sm btn-editar" onclick="editarFila(this)">Editar</button></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $fila[0] ?>)">Eliminar</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>

        <div class="text-center mt-4">
        <form method="POST" action="../controllers/reportexls_usuarios.php" target="_blank" class="d-inline">
  <input type="hidden" name="dato" value="<?= $_POST['dato'] ?? '' ?>">
  <input type="hidden" name="valor" value="<?= $_POST['valor'] ?? '' ?>">
  <button type="submit" class="btn btn-outline-success">📥 Exportar Excel</button>
</form>
            <a href="../controllers/reportepdf_usuarios.php" class="btn btn-outline-danger"> Exportar PDF</a>
        </div>
    </div>

    
</body>
</html>
