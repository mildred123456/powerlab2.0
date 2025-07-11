<?php
include_once("../models/conexion.php");
session_start();

if (!isset($_GET['id'])) {
    die("Solicitud no encontrada.");
}

$id_solicitud = $_GET['id'];

// Actualizamos el estado a 'aceptado'
$actualizar = $conexion->prepare("UPDATE solicitudes_contacto SET estado = 'aceptado' WHERE id = ?");
$actualizar->execute([$id_solicitud]);

// Obtenemos los datos del instructor para mostrar luego
$consulta = $conexion->prepare("
    SELECT u.correo 
    FROM solicitudes_contacto sc 
    JOIN usuario u ON sc.id_instructor = u.id 
    WHERE sc.id = ?
");
$consulta->execute([$id_solicitud]);
$instructor = $consulta->fetch(PDO::FETCH_ASSOC);

if ($instructor) {
    $correo = $instructor['correo'];

    // Redirigir al deportista con mensaje
    echo "<script>
        alert('✅ Se ha aceptado la solicitud. Tu instructor es: $correo');
        location.href = '../views/ver-solicitudes.php';
    </script>";
} else {
    echo "<script>
        alert('Error al recuperar los datos del instructor.');
        location.href = '../views/ver-solicitudes.php';
    </script>";
}
?>
