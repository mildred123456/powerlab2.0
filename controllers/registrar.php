<?php

// Incluye el archivo donde están definidas las clases usuario, instructor, nutricionista, etc.
include "../models/usuario.php";

// Comprueba el valor del rol enviado por el formulario y crea el objeto correspondiente
if ($_POST["rol"] == "instructor") {
    $objeto = new instructor(); // Crea un objeto del tipo instructor
    $respuesta = $objeto->REGISTRAR(
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["correo"],
        $_POST["fecha_nacimiento"],
        $_POST["genero"],
        $_POST["rol"],
        $_POST["contrasenia"]
    );

} else if ($_POST["rol"] == "nutricionista") {
    $objeto = new nutricionista(); // Crea un objeto del tipo nutricionista
    $respuesta = $objeto->REGISTRAR(
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["correo"],
        $_POST["fecha_nacimiento"],
        $_POST["genero"],
        $_POST["rol"],
        $_POST["contrasenia"]
    );

} else if ($_POST["rol"] == "admin") {
    $objeto = new administrador(); // Crea un objeto del tipo administrador
    $respuesta = $objeto->REGISTRAR(
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["correo"],
        $_POST["fecha_nacimiento"],
        $_POST["genero"],
        $_POST["rol"],
        $_POST["contrasenia"]
    );

} else {
    // Por defecto, si el rol no coincide con los anteriores, se asume que es deportista
    $objeto = new deportista();
    $respuesta = $objeto->REGISTRAR(
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["correo"],
        $_POST["fecha_nacimiento"],
        $_POST["genero"],
        $_POST["rol"],
        $_POST["contrasenia"]
    );
}

// Verifica si hubo un error en la base de datos (por ejemplo, correo duplicado)
if ($respuesta instanceof Exception) {
    if ($respuesta->getCode() == 23000) {
        // Código de error 23000 = violación de restricción (correo repetido)
        echo "<script>
            alert('El correo ya está registrado');
            location.href='../views/usuarios.php';
        </script>";
    } else {
        // Otro error desconocido
        echo "<script>
            alert('Error en la conexión, intente más tarde');
        </script>";
    }

// Si el registro fue exitoso, se guarda el ID del usuario en la sesión y se redirige según el rol
} else if (!empty($respuesta)) {
    session_start(); // Inicia sesión
    $_SESSION["id"] = $respuesta[0][0]; // Guarda el ID del usuario registrado en la sesión
    $rol = strtolower(trim($respuesta[0][6])); // Obtiene el rol en minúsculas y sin espacios

    // Redirige según el rol del usuario
    if ($rol == "instructor") {
        header("Location: ../views/rutinas.php");
        exit();
    } elseif ($rol == "deportista") {
        header("Location: ../views/deportista.php");
        exit();
    } elseif ($rol == "nutricionista") {
        header("Location: ../views/planes.php");
        exit();
    } elseif ($rol == "administrador") {
        header("Location: ../views/usuarios.php");
        exit();
    } else {
        // Si el rol no es reconocido, muestra un mensaje de error y redirige al login
        echo "<script>alert('Rol no reconocido: $rol'); location.href='../views/login.php';</script>";
    }
}
?>
