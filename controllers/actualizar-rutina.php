<?php
include "../models/usuario.php";
session_start(); // Asegúrate de tener sesión iniciada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = $_POST['titulo'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $nivel = $_POST['nivel'] ?? null;
    $dias_por_semana = $_POST['dias_por_semana'] ?? null;

    // Toma los datos del instructor directamente de la sesión
    $id_instructor = $_SESSION['usuario']['id'] ?? null;
    $nombre = $_SESSION['usuario']['nombre'] ?? null;

    if ($id && $titulo && $descripcion && $nivel && $dias_por_semana && $id_instructor && $nombre) {
        $objeto = new rutinas();
        $respuesta = $objeto->ACTUALIZAR($id, $titulo, $descripcion, $nivel, $dias_por_semana, $id_instructor, $nombre);

        if ($respuesta instanceof Exception) {
            if ($respuesta->getCode() == 23000) {
                echo "<script>
                    alert('Valor duplicado');
                    location.href='../views/rutinas.php';
                </script>";
            } else {
                echo "<script>
                    alert('Error: " . $respuesta->getMessage() . "');
                    location.href='../views/rutinas.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Rutina actualizada correctamente');
                location.href='../views/rutinas.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Faltan datos para actualizar');
            location.href='../views/rutinas.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Acceso inválido');
        location.href='../views/rutinas.php';
    </script>";
}
