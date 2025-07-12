<?php
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=deportistas.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/usuario.php";
$usuario = new usuario();

// Detectar si hay filtro aplicado
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaEspecifica("rol", "deportista");
}

// Cabecera de tabla
echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Correo</th>
    <th>Fecha de nacimiento</th>
    <th>Genero</th>
    <th>Estado</th>
</tr>";

// Datos
foreach ($respuesta as $fila) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila[0]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[1]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[2]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[3]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[4]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[5]) . "</td>";
    echo "<td>" . htmlspecialchars($fila[7]) . "</td>"; 
    echo "</tr>";
}
echo "</table>";
exit;
?>
