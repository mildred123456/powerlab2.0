<?php
include "../models/asignacion.php";
$asignacion = new Asignacion();

if (!empty($_POST['id_asignacion'])) {
    $asignacion->marcarRealizado($_POST['id_asignacion']);
}

header("Location: consulta_asignaciones.php"); // o el panel del deportista