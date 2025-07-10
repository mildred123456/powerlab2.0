<?php
var_dump($_POST);

include_once(__DIR__ . '/../models/asignaciones.php');

$asignacion = new asignaciones();

// Validar que los datos vengan por POST
if (
    isset($_POST['id_deportista']) &&
    isset($_POST['id_instructor']) &&
    isset($_POST['tipo_asignacion']) &&
    isset($_POST['contenido'])
) {
    // Recoger los datos del formulario
    $id_deportista = $_POST['id_deportista'];
    $id_instructor = $_POST['id_instructor'];
    $tipo_asignacion = $_POST['tipo_asignacion'];
    $contenido = $_POST['contenido'];
    $estado = "pendiente"; // estado por defecto
    $fecha = date("Y-m-d H:i:s"); // fecha actual

    // Llamar al método REGISTRAR
    $respuesta = $asignacion->REGISTRAR(
        $id_deportista,
        $id_instructor,
        $tipo_asignacion,
        $contenido,
        $estado,
        $fecha
    );

    // Verificar resultado
    if ($respuesta === true) {
        echo "<script>
            alert('✅ Rutina asignada correctamente.');
            window.location.href = '../views/rutinas.php';
        </script>";
        exit; // 🔴 AGREGA ESTA LÍNEA
    }elseif ($respuesta instanceof Exception) {
        echo "<script>
            alert(' Error al registrar: " . $respuesta->getMessage() . "');
            history.back();
        </script>";
    } else {
        echo "<script>
            alert(' Error inesperado al registrar rutina.');
            history.back();
        </script>";
    }
} else {
    // Si falta algún dato, mostrar error
    echo "<script>
        alert(' Faltan datos del formulario.');
        history.back();
    </script>";
}
