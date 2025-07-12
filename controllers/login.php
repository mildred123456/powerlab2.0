<?php
session_start(); // Inicia o reanuda la sesión

include "../models/usuario.php"; // Incluye el archivo con la clase usuario

$objeto = new usuario(); // Crea una instancia de la clase usuario

// Llama al método Login con el correo y la contraseña del formulario
$datos = $objeto->Login($_POST["correo"], $_POST["contrasenia"]);

//var_dump($_POST); // Muestra por pantalla los datos enviados por POST (solo para depurar)

// Verifica si se encontró un usuario con esas credenciales
if (count($datos) == 1) {
    $_SESSION["usuario"] = $datos[0]; // Guarda los datos del usuario en sesión
    $rol = $datos[0]["rol"]; // Extrae el rol del usuario

    // Redirige a la vista correspondiente según el rol del usuario
    if ($rol == "administrador") {
        header("Location: ../views/usuarios.php");
    } elseif ($rol == "instructor") {
        header("Location: ../views/rutinas.php");
    } elseif ($rol == "deportista") {
        header("Location: ../views/deportista.php");
    } elseif ($rol == "nutricionista") {
        header("Location: ../views/planes.php");
    } else {
        // Si el rol no está definido correctamente, muestra alerta y redirige al login
        echo "<script>
            alert('Rol no reconocido');
            location.href='../views/login.php';
        </script>";
    }
} else {
    // Si no se encontró el usuario, muestra mensaje de error y redirige
    echo "<script>
    alert('Correo o clave incorrectos');
        location.href='../views/inicio-de-sesion.php';
    </script>";
}

?>
