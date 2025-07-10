<?php
include_once("../models/conexion.php");
session_start();

if (!empty($_GET['id_instructor']) && isset($_SESSION['usuario']['id'])) {
    $id_instructor = $_GET['id_instructor'];
    $id_usuario = $_SESSION['usuario']['id'];
    $estado = 'pendiente';
    $fecha = date("Y-m-d H:i:s");

    try {
        $sql = "INSERT INTO solicitudes_contacto (id_usuario, id_instructor, estado, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_usuario, $id_instructor, $estado, $fecha]);

        echo "<script>
            alert(' Solicitud enviada al instructor.');
            location.href = '../views/deportista.php';
        </script>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            // Entrada duplicada por restricción UNIQUE
            echo "<script>
                alert(' Ya has enviado una solicitud pendiente a este instructor.');
                location.href = '../views/deportista.php';
            </script>";
        } else {
            // Otro error inesperado
            echo "<script>
                alert(' Ocurrió un error inesperado. Inténtalo más tarde.');
                location.href = '../views/deportista.php';
            </script>";
        }
    }

} else {
    echo "<script>
        alert(' Error: faltan datos o no has iniciado sesión.');
        history.back();
    </script>";
}