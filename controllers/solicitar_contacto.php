<?php
include_once("../models/conexion.php");

if (!empty($_GET['id_instructor']) && !empty($_GET['id_usuario'])) {
    $id_instructor = $_GET['id_instructor'];
    $id_usuario = $_GET['id_usuario'];

    $sql = "INSERT INTO solicitudes_contacto (id_usuario, id_instructor) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_usuario, $id_instructor]);

    echo "<script>
        alert('Solicitud enviada al instructor.');
        location.href = '../views/depotista.php'; // o la vista donde quieras volver
    </script>";
} else {
    echo "<script>
        alert('Error: faltan datos.');
        history.back();
    </script>";
}