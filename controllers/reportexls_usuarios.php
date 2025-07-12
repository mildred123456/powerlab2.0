<?php
// Forzar descarga como archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Incluir tu modelo
include "../models/usuario.php";
$usuario = new usuario();

// Obtener los datos desde la base
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}

// Inicia tabla
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Fecha de nacimiento</th>
            <th>Genero</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Contrasenia</th>
        </tr>";

if (is_array($respuesta) && count($respuesta) > 0) {
    foreach ($respuesta as $fila) {
        echo "<tr>";
        for ($i = 0; $i <= 8; $i++) {
            $valor = isset($fila[$i]) ? $fila[$i] : '';
            echo "<td>" . htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') . "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay datos disponibles</td></tr>";
}

echo "</table>";
?>
