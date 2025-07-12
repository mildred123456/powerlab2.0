<?php
// Encabezados para descarga como Excel
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=pacientes.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/usuario.php";
$usuario = new usuario();

// Obtener datos según filtros
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaEspecifica("rol", "deportista"); // Pacientes = deportistas
}

// Inicia tabla
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

// Cuerpo de la tabla
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