<?php
include_once(__DIR__ . '/../models/asignaciones.php');

if (isset($_GET['id'])) {
    $asignacion = new asignaciones();
    $resultado = $asignacion->ELIMINAR($_GET['id']);

    if ($respuesta instanceof Exception) {
        echo "<script>
            alert('Error al eliminar rutina');
            location.href='../views/ver_asignaciones.php';
        </script>";
    } else {
        echo "<script>
            alert('Usuario eliminado correctamente');
            location.href='../views/ver_asignaciones.php';
        </script>";
    }
}
    ?>