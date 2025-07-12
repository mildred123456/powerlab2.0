<?php
include_once("../models/conexion.php"); // Conecta con la base de datos
session_start(); // Inicia o continúa la sesión para acceder a los datos del usuario logueado

// Verifica que se haya recibido un ID de instructor por GET y que el usuario esté autenticado
if (!empty($_GET['id_instructor']) && isset($_SESSION['usuario']['id'])) {
    
    // Asigna el ID del instructor desde la URL y el ID del usuario desde la sesión
    $id_instructor = $_GET['id_instructor'];
    $id_usuario = $_SESSION['usuario']['id'];

    // Define el estado inicial de la solicitud y la fecha actual
    $estado = 'pendiente';
    $fecha = date("Y-m-d H:i:s");

    try {
        // Prepara la consulta SQL para insertar la solicitud en la base de datos
        $sql = "INSERT INTO solicitudes_contacto (id_usuario, id_instructor, estado, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql); // Prepara la consulta para evitar inyección SQL
        $stmt->execute([$id_usuario, $id_instructor, $estado, $fecha]); // Ejecuta con los valores correspondientes

        // Muestra mensaje de éxito y redirige a la vista del deportista
        echo "<script>
            alert(' Solicitud enviada al instructor.');
            location.href = '../views/deportista.php';
        </script>";

    } catch (PDOException $e) {
        // Si el error es por restricción UNIQUE (solicitud ya existente)
        if ($e->getCode() == 23000) {
            echo "<script>
                alert(' Ya has enviado una solicitud pendiente a este instructor.');
                location.href = '../views/deportista.php';
            </script>";
        } else {
            // Cualquier otro error de base de datos
            echo "<script>
                alert(' Ocurrió un error inesperado. Inténtalo más tarde.');
                location.href = '../views/deportista.php';
            </script>";
        }
    }

} else {
    // Si falta el ID del instructor o el usuario no ha iniciado sesión
    echo "<script>
        alert(' Error: faltan datos o no has iniciado sesión.');
        history.back(); // Vuelve a la página anterior
    </script>";
}
