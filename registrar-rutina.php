<?php
include "../models/conexion.php";
session_start();
if (!isset($_SESSION['usuario']['id'])) {
    echo "<script>
            alert('Acceso no autorizado');
            location.href = '../views/login.php';
        </script>";
    exit();
}
$id_instructor = $_SESSION['usuario']['id'];
$nombre = $_SESSION['usuario']['nombre'];
$insertar = $conexion->prepare("INSERT INTO rutinas (titulo, descripcion, nivel, dias_por_semana,id_instructor,nombre) VALUES (?, ?, ?, ?,?,?)");
$insertar->execute([$_POST['titulo'], $_POST['descripcion'],$_POST['nivel'],$_POST['dias_por_semana'] , $id_instructor, $nombre]);
$consultar = $conexion->prepare("SELECT * FROM rutinas");
$consultar->execute();

echo "<script>
        alert('Rutina registrada correctamente');
        location.href = '../views/rutinas.php';
    </script>";
?>

