<?php
include_once(__DIR__ . '/../models/rutina.php');

$objeto = new rutinas();
$respuesta = $objeto->ACTUALIZAR($_POST["id_rutina"], $_POST["titulo"], $_POST["descripcion"], $_POST["nivel"], $_POST["dias_por_semana"]);
if ($respuesta instanceof Exception) {
    if ($respuesta->getCode() == 23000) {
        // Error por clave duplicada
        echo "<script>
                alert('Error: Valor duplicado no permitido.');
                location.href='../views/rutinas.php';
              </script>";
    } else {
        // Otro error (por ejemplo: no se modificó ninguna fila)
        echo "<script>
                alert('Error: " . $respuesta->getMessage() . "');
                location.href='../views/rutinas.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Registro actualizado correctamente');
            location.href='../views/rutinas.php';
          </script>";
}

?>