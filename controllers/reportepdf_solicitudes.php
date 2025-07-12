<?php
require('libreria/fpdf.php'); // Asegúrate que la ruta sea correcta
include_once "../models/solicitudes.php";
session_start();

// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'instructor') {
    die("Acceso denegado");
}

$id_instructor = $_SESSION['usuario']['id'];

$solicitudes = new SolicitudesContacto();
$respuesta = $solicitudes->obtenerSolicitudesPorInstructor($id_instructor);

if (!is_array($respuesta) || count($respuesta) === 0) {
    die("No hay datos para generar el PDF.");
}

// Clase personalizada para PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('Solicitudes de Contacto - PowerLab'), 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(10, 8, 'ID', 1);
        $this->Cell(30, 8, 'ID Usuario', 1);
        $this->Cell(30, 8, 'ID Instructor', 1);
        $this->Cell(30, 8, 'Estado', 1);
        $this->Cell(40, 8, 'Fecha', 1);
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

// Imprimir datos
foreach ($respuesta as $fila) {
    $pdf->Cell(10, 8, utf8_decode($fila['id']), 1);
    $pdf->Cell(30, 8, utf8_decode($fila['id_usuario']), 1);
    $pdf->Cell(30, 8, utf8_decode($fila['id_instructor']), 1);
    $pdf->Cell(30, 8, utf8_decode($fila['estado']), 1);
    $pdf->Cell(40, 8, utf8_decode($fila['fecha']), 1);
    $pdf->Ln();
}

$pdf->Output('D', 'solicitudes_contacto.pdf');
exit;
?>
