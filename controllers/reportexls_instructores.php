<?php
// Descargar como Excel con codificación correcta
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=instructores.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/usuario.php";
$usuario = new usuario();

// Si hay búsqueda específica, úsala; si no, filtra por rol = instructor
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaEspecifica("rol", "instructor");
}

// Cabecera de tabla
echo "<table border='1'>
<tr>
    <th>" . utf8_decode("ID") . "</th>
    <th>" . utf8_decode("Nombre") . "</th>
    <th>" . utf8_decode("Apellido") . "</th>
    <th>" . utf8_decode("Correo") . "</th>
    <th>" . utf8_decode("Fecha de nacimiento") . "</th>
    <th>" . utf8_decode("Género") . "</th>
    <th>" . utf8_decode("Estado") . "</th>
</tr>";

// Datos
foreach ($respuesta as $fila) {
    echo "<tr>";
    echo "<td>" . utf8_decode($fila[0] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[1] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[2] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[3] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[4] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[5] ?? '') . "</td>";
    echo "<td>" . utf8_decode($fila[7] ?? '') . "</td>"; // Estado
    echo "</tr>";
}

echo "</table>";
exit;
?>
