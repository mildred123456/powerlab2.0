<?php
// Configuración de cabecera para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=usuarios_powerlab.xls");
header("Pragma: no-cache");
header("Expires: 0");

ob_start();
session_start();
$respuesta = $_SESSION["respuesta"];

echo "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1'>";
echo "<table border='1'>
        <tr style='background-color:#f2f2f2; font-weight:bold;'>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>fecha_nacimiento</th>
            <th>Género</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>contrasenia</th>
        </tr>";

foreach($respuesta as $fila){
    echo "<tr>
            <td>".utf8_decode($fila[0])."</td>
            <td>".utf8_decode($fila[1])."</td>
            <td>".utf8_decode($fila[2])."</td>
            <td>".utf8_decode($fila[3])."</td>
            <td>".utf8_decode($fila[5])."</td>
            <td>".utf8_decode($fila[6])."</td>
            <td>".utf8_decode($fila[7])."</td>
            <td>".utf8_decode($fila[8])."</td>
        </tr>";
}
echo "</table>";
?>
