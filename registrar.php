<?php

var_dump($_POST);

include "../models/usuario.php";

if ($_POST["rol"] == "instructor") {
    $objeto = new instructor();
    $respuesta = $objeto->REGISTRAR( $_POST["nombre"],$_POST["apellido"],$_POST["correo"],$_POST["fecha_nacimiento"], $_POST["genero"], $_POST["rol"],$_POST["contrasenia"] );

} else if ($_POST["rol"] == "nutricionista") {
    $objeto = new nutricionista();
    $respuesta = $objeto->REGISTRAR($_POST["nombre"], $_POST["apellido"], $_POST["correo"],$_POST["fecha_nacimiento"], $_POST["genero"],  $_POST["rol"], $_POST["contrasenia"]
    );

} else if ($_POST["rol"] == "admin") {
    $objeto = new administrador();
    $respuesta = $objeto->REGISTRAR($_POST["nombre"],$_POST["apellido"], $_POST["correo"],$_POST["fecha_nacimiento"],$_POST["genero"],$_POST["rol"],$_POST["contrasenia"]
    );

} else {
    // Caso por defecto: deportista
    $objeto = new deportista();
    $respuesta = $objeto->REGISTRAR($_POST["nombre"], $_POST["apellido"],$_POST["correo"],$_POST["fecha_nacimiento"],$_POST["genero"],$_POST["rol"],$_POST["contrasenia"]);
}

if ($respuesta instanceof Exception) {
    if ($respuesta->getCode() == 23000) {
        echo "<script>
            alert('El correo ya está registrado');
            location.href='../views/usuarios.php';
        </script>";
    } else {
        echo "<script>
            alert('Error en la conexión, intente más tarde');
        </script>";
    }
} else if (!empty($respuesta)) {
    session_start();
    $_SESSION["id"] = $respuesta[0][0];
    $rol = strtolower(trim($respuesta[0][6]));

    if ($rol == "instructor") {
        header("Location: ../views/rutinas.php");
        exit();
    } elseif ($rol == "deportista") {
        header("Location: ../views/deportista-inicio.php");
        exit();
    } elseif ($rol == "nutricionista") {
        header("Location: ../views/nutricionista-inicio.php");
        exit();
    } elseif ($rol == "administrador") {
        header("Location: ../views/usuarios.php");
        exit();
    } else {
        echo "<script>alert('Rol no reconocido: $rol'); location.href='../views/login.php';</script>";
    }
}
?>