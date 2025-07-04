<?php
include_once(__DIR__ . '/../models/usuario.php');
$usuario = new rutinas();

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
        const titulo = fila.querySelector('.titulo');
        const descripcion = fila.querySelector('.descripcion');
        const nivel = fila.querySelector('.nivel');
        const dias_por_semana = fila.querySelector('.dias_por_semana'); 
        const fecha_creacion = fila.querySelector('.fecha_creacion');  
        const estado = fila.querySelector('.estado');
       

        // valores actuales
        const idVal = id.textContent.trim();
        const tituloVal = apellido.textContent.trim();
        const descripcionVal = correo.textContent.trim();
        const nivelVal = fecha_nacimiento.textContent.trim();
        const dias_por_semanaVal = dias_por_semana.textContent.trim();
        const fecha_creacionVal = genero.textContent.trim();          
        const estadoVal = estado.textContent.trim();
        

        // inputs
        titulo.innerHTML = `<input type='text' name=' titulo' class='form-control' value='${ tituloVal}'>`;
        descripcion.innerHTML = `<input type='text' name='descripcion' class='form-control' value='${descripcionVal}'>`;
        nivel.innerHTML = `<input type='text' name='nivel' class='form-control' value='${nivelVal}'>`;
        dias_por_semana.innerHTML = `<input type='text' name='dias_por_semana' class='form-control' value='${dias_por_semanaVal}'>`;
        fecha_creacion.innerHTML = `<input type='text' name='fecha_creacion' class='form-control' value='${fecha_creacionVal}'>`;
        estado.innerHTML = `<input type='text' name='estado' class='form-control' value='${estadoVal}'>`;
        

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
            form.action = '../controllers/actualizar-rutina.php';
            form.submit();
        };

        btnEditar.replaceWith(boton);
    }

    function confirmarEliminar(id) {
        if (confirm("¿Estás seguro de eliminar este usuario?")) {
            window.location.href = `../controllers/eliminar-rutina.php?id=${id}`;
        }
    }
</script>
</head>

<body>
<div class="container bg-black text-white p-4 rounded">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                
                <span class="text-warning">Gestión de rutinas - PowerLab</span>
            </div>
            <div>
                <a href="admin-inicio.php" class="btn btn-outline-light btn-sm">← Volver</a>
            </div>
        </header>

        <form id="formu" method="post">
            <table class="table table-dark table-hover text-center align-middle">
                <thead class="text-warning">
                    <tr>
                        <th>ID</th>
                        <th>titulo</th>
                        <th>descripcion</th>
                        <th>nivel</th>
                        <th>dias_por_semana</th>
                        <th>fecha_creacion</th>
                        <th>estado</th>
                        <th>actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($respuesta as $fila): ?>
                        <tr>
                            <td class="id"><?= $fila[0] ?></td>
                            <td class="titulo"><?= $fila[1] ?></td>
                            <td class="descripcion"><?= $fila[2] ?></td>
                            <td class="nivel"><?= $fila[3] ?></td>
                            <td class="dias_por_semana"><?= $fila[4] ?></td>
                            <td class="fecha_creacion"><?= $fila[5] ?></td>
                            <td class="estado"><?= $fila[6] ?></td>
                            <td><button type="button" class="btn btn-warning btn-sm btn-editar" onclick="editarFila(this)">Editar</button></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $fila[0] ?>)">Eliminar</button></td>
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
