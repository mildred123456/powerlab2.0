<?php
include_once(__DIR__ . '/../models/usuario.php');

$objeto = new rutinas();
$respuesta = $objeto->ELIMINAR($_GET["id"]);

if ($respuesta instanceof Exception) {
    echo "<script>
        alert('Error al eliminar rutina');
        location.href='../views/rutinas.php';
    </script>";
} else {
    echo "<script>
        alert('Usuario eliminado correctamente');
        location.href='../views/rutinas.php';
    </script>";
}
?>