<?php
include "../models/usuario.php";

$objeto = new usuario();
$respuesta = $objeto->ELIMINAR($_GET["id"]);

if ($respuesta instanceof Exception) {
    echo "<script>
        alert('Error al eliminar usuario');
        location.href='../views/usuarios.php';
    </script>";
} else {
    echo "<script>
        alert('Usuario eliminado correctamente');
        location.href='../views/usuarios.php';
    </script>";
}
?>