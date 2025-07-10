<?php
session_start();
include_once("../models/conexion.php");

$id_instructor = $_SESSION["usuario"]["id"];

$stmt = $conexion->prepare("SELECT s.*, u.nombre 
                            FROM solicitudes_contacto s
                            JOIN usuario u ON s.id_usuario = u.id
                            WHERE s.id_instructor = ? 
                            ORDER BY s.fecha DESC");
$stmt->execute([$id_instructor]);
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Enviar los datos a la vista
include("../views/ver_solicitudes.php");