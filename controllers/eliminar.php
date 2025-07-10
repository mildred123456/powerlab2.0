<?php
include "../models/usuario.php";

if (isset($_GET['id'])) {
    $asignacion = new usuario();
    $resultado = $asignacion->ELIMINAR($_GET['id']);

    if ($respuesta instanceof Exception) {
        echo "<script>
            alert('Error al eliminar rutina');
            location.href='../views/usuarios.php';
        </script>";
    } else {
        echo "<script>
            alert('Usuario eliminado correctamente');
            location.href='../views/usuarios.php';
        </script>";
    }
}
    ?>