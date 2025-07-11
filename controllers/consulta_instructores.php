<?php
include "../models/usuario.php";
$usuario = new usuario();

if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
   
    $respuesta = $usuario->ConsultaEspecifica("rol", "instructor");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de instructores - PowerLab</title>
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
        const estado = fila.querySelector('.estado');
       

        // valores actuales
        const idVal = id.textContent.trim();
        const nombreVal = nombre.textContent.trim();
        const apellidoVal = apellido.textContent.trim();
        const correoVal = correo.textContent.trim();
        const fechaNacimientoVal = fecha_nacimiento.textContent.trim();
        const generoVal = genero.textContent.trim();          
        const estadoVal = estado.textContent.trim();
      

        // inputs
        nombre.innerHTML = `<input type='text' name='nombre' class='form-control' value='${nombreVal}'>`;
        apellido.innerHTML = `<input type='text' name='apellido' class='form-control' value='${apellidoVal}'>`;
        correo.innerHTML = `<input type='text' name='correo' class='form-control' value='${correoVal}'>`;
        fecha_nacimiento.innerHTML = `<input type='text' name='fecha_nacimiento' class='form-control' value='${fechaNacimientoVal}'>`;
        genero.innerHTML = `<input type='text' name='genero' class='form-control' value='${generoVal}'>`;
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
<?php
include "../models/conexion.php";


$id_usuario = $_SESSION['usuario']['id'];
$res = $conexion->query("SELECT u.correo FROM solicitudes_contacto sc JOIN usuario u ON sc.id_instructor = u.id WHERE sc.id_usuario = $id_usuario AND sc.estado = 'aceptado' LIMIT 1");
$instructor = $res->fetch(PDO::FETCH_ASSOC);

if ($instructor) {
    echo "<p style='background:#d4edda; padding:10px; color:#155724; border-radius:5px;'> Solicitud aceptada porfavor comunicarse para seguir el proseso. Tu instructor es: <strong>{$instructor['correo']}</strong></p>";
}
?>
<div class="bg-white text-dark shadow-sm p-4 rounded">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                
                <span class="text-warning">instructores - PowerLab</span>
            </div>
            <div>
                <a href="admin-inicio.php" class="btn btn-outline-light btn-sm">← Volver</a>
            </div>
        </header>

        <form id="formu" method="post">
            <table  class="table table-striped table-hover">
                <thead class="text-warning">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>fecha_nacimiento</th>
                        <th>Género</th> 
                        <th>estado</th>
                        
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
                            <td class="estado"><?= $fila[7] ?></td>
                            <td> <a href="../controllers/registrar_contacto.php?id_instructor=<?= $fila[0]; ?>&id_usuario=<?= $_SESSION['usuario']['id'] ?>" class="btn btn-info btn-sm">Contactar</a></td>
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
