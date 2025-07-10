<?php
session_start();
include "../models/usuario.php";


$objeto = new usuario();
$datos = $objeto->Login($_POST["correo"], $_POST["contrasenia"]);
var_dump($_POST);

if (count($datos) == 1) {
    $_SESSION["usuario"] = $datos[0];
    $rol = $datos[0]["rol"]; // ← extraemos el rol

    // Redirigimos según el rol
    if ($rol == "administrador") {
        header("Location: ../views/usuarios.php");
    } elseif ($rol == "instructor") {
        header("Location: ../views/rutinas.php");
    } elseif ($rol == "deportista") {
        header("Location: ../views/deportista.php");
    } elseif ($rol == "nutricionista") {
        header("Location: ../views/planes.php");
    } else {
        echo "<script>
            alert('Rol no reconocido');
            location.href='../views/login.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Correo o clave incorrectos');
        location.href='../views/inicio-de-sesion.php';
    </script>";
}

?>