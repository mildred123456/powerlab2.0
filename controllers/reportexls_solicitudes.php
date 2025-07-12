<?php
// Encabezados para descargar como Excel
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=solicitudes_contacto.xls");
header("Pragma: no-cache");
header("Expires: 0");

session_start();
include_once "../models/solicitudes.php";

// Validar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'instructor') {
    die("Acceso denegado");
}

$id_instructor = $_SESSION['usuario']['id'];

$solicitudes = new SolicitudesContacto();
$respuesta = $solicitudes->obtenerSolicitudesPorInstructor($id_instructor);

if (!is_array($respuesta)) {
    $respuesta = [];
}

// Crear tabla
echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>ID Usuario</th>
    <th>ID Instructor</th>
    <th>Estado</th>
    <th>Fecha</th>
</tr>";

foreach ($respuesta as $fila) {
    echo "<tr>";
    echo "<td>" . utf8_decode($fila['id']) . "</td>";
    echo "<td>" . utf8_decode($fila['id_usuario']) . "</td>";
    echo "<td>" . utf8_decode($fila['id_instructor']) . "</td>";
    echo "<td>" . utf8_decode($fila['estado']) . "</td>";
    echo "<td>" . utf8_decode($fila['fecha']) . "</td>";
    echo "</tr>";
}

echo "</table>";
exit;
?>
