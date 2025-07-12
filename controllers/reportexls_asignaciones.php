<?php
// Encabezados para forzar descarga como Excel
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=asignaciones.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/asignaciones.php";
$usuario = new asignaciones();

// Obtener datos
if (!empty($_GET["id_deportista"])) {
    $respuesta = $usuario->ConsultaEspecifica("id_deportista", $_GET["id_deportista"]);
} elseif (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}

// Comenzar tabla
echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Deportista</th>
    <th>Tipo</th>
    <th>Contenido</th>
    <th>Estado</th>
    <th>Fecha</th>
</tr>";

// Imprimir filas
foreach ($respuesta as $fila) {
    echo "<tr>";
    echo "<td>" . utf8_decode($fila[0] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[1] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[2] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[3] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[4] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[5] ?? '') . "</td>";
    echo "</tr>";
}

echo "</table>";
exit;
?>
