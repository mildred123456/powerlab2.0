<?php
include "../models/usuario.php";

$objeto = new rutinas();
$respuesta = $objeto->ELIMINAR($_POST["id"]);

if ($respuesta instanceof Exception) {
    echo "<script>
        alert('Error al eliminar usuario');
        location.href='../views/rutinas.php';
    </script>";
} else {
    echo "<script>
        alert('Usuario eliminado correctamente');
        location.href='../views/rutinas.php';
    </script>";
}
?>