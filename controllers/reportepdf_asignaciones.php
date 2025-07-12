<?php
require('libreria/fpdf.php'); // Asegúrate que la ruta esté bien
include "../models/asignaciones.php";

$usuario = new asignaciones();

// Obtener datos según filtros
if (!empty($_GET["id_deportista"])) {
    $respuesta = $usuario->ConsultaEspecifica("id_deportista", $_GET["id_deportista"]);
} elseif (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}

if (!is_array($respuesta) || count($respuesta) === 0) {
    die("No hay datos para generar el PDF.");
}

// Clase personalizada PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('Asignaciones - PowerLab'), 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(10, 8, 'ID', 1);
        $this->Cell(30, 8, 'Deportista', 1);
        $this->Cell(25, 8, 'Tipo', 1);
        $this->Cell(60, 8, 'Contenido', 1);
        $this->Cell(25, 8, 'Estado', 1);
        $this->Cell(30, 8, 'Fecha', 1);
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

// Cargar datos
foreach ($respuesta as $fila) {
    $pdf->Cell(10, 8, utf8_decode($fila[0] ?? ''), 1); // ID
    $pdf->Cell(30, 8, utf8_decode($fila[1] ?? ''), 1); // Deportista
    $pdf->Cell(25, 8, utf8_decode($fila[2] ?? ''), 1); // Tipo
    $pdf->Cell(60, 8, utf8_decode($fila[3] ?? ''), 1); // Contenido
    $pdf->Cell(25, 8, utf8_decode($fila[4] ?? ''), 1); // Estado
    $pdf->Cell(30, 8, utf8_decode($fila[5] ?? ''), 1); // Fecha
    $pdf->Ln();
}

$pdf->Output('D', 'asignaciones.pdf');
exit;
?>
