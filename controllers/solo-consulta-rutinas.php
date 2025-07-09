<?php
include "../models/rutina.php";
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
    const idVal = fila.querySelector('.id').textContent.trim();
    const tituloVal = fila.querySelector('.titulo').textContent.trim();
    const descripcionVal = fila.querySelector('.descripcion').textContent.trim();
    const nivelVal = fila.querySelector('.nivel').textContent.trim();
    const diasVal = fila.querySelector('.dias_por_semana').textContent.trim();
   

    // Convertir celdas a inputs
    fila.querySelector('.titulo').innerHTML = `<input type='text' class='form-control' id='input_titulo' value='${tituloVal}'>`;
    fila.querySelector('.descripcion').innerHTML = `<input type='text' class='form-control' id='input_descripcion' value='${descripcionVal}'>`;
    fila.querySelector('.nivel').innerHTML = `<input type='text' class='form-control' id='input_nivel' value='${nivelVal}'>`;
    fila.querySelector('.dias_por_semana').innerHTML = `<input type='number' class='form-control' id='input_dias' value='${diasVal}'>`;
  

    // Botón "Actualizar"
    const btnEditar = fila.querySelector('.btn-editar');
    const form = document.getElementById("formu");

    const boton = document.createElement('button');
    boton.textContent = 'Actualizar';
    boton.className = 'btn btn-success btn-sm';
    boton.type = 'button';
    boton.onclick = function () {
        // Limpia inputs anteriores del formulario
        form.innerHTML = '';

        // Crea inputs ocultos con los nuevos valores
        form.innerHTML = `
            <input type="hidden" name="id_rutina" value="${idVal}">
            <input type="hidden" name="titulo" value="${document.getElementById('input_titulo').value}">
            <input type="hidden" name="descripcion" value="${document.getElementById('input_descripcion').value}">
            <input type="hidden" name="nivel" value="${document.getElementById('input_nivel').value}">
            <input type="hidden" name="dias_por_semana" value="${document.getElementById('input_dias').value}">
        
        `;
        
       

    btnEditar.replaceWith(boton);
}

function createHiddenInput(name, value) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    return input;
}


</script>
</head>

<body>
<div class="container bg-white text-dark shadow-sm">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                
                <span class="text-warning">Gestión de rutinas - PowerLab</span>
            </div>
            <div>
                <a href="admin-inicio.php" class="btn btn-outline-light btn-sm">← Volver</a>
            </div>
        </header>

        <form id="formu" method="post">
            <table class="table table-striped table-hover">
                <thead class="text-warning">
                    <tr>
                        <th>ID</th>
                        <th>titulo</th>
                        <th>descripcion</th>
                        <th>nivel</th>
                        <th>dias_por_semana</th>
                        <th>fecha_creacion</th>
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
