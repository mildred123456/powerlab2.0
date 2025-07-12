<?php
require('libreria/fpdf.php'); // Asegúrate de que esta ruta sea correcta
include "../models/usuario.php";

$usuario = new usuario();

// Filtra solo deportistas (como en la vista)
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaEspecifica("rol", "deportista");
}

if (!is_array($respuesta) || count($respuesta) === 0) {
    die("No hay datos para generar el PDF.");
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('Reporte de Deportistas - PowerLab'), 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(12, 8, 'ID', 1);
        $this->Cell(25, 8, 'Nombre', 1);
        $this->Cell(25, 8, 'Apellido', 1);
        $this->Cell(35, 8, 'Correo', 1);
        $this->Cell(25, 8, 'Nacimiento', 1);
        $this->Cell(20, 8, utf8_decode('Género'), 1);
        $this->Cell(25, 8, 'Estado', 1);
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

foreach ($respuesta as $fila) {
    $pdf->Cell(12, 8, utf8_decode($fila[0] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[1] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[2] ?? ''), 1);
    $pdf->Cell(35, 8, utf8_decode($fila[3] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[4] ?? ''), 1);
    $pdf->Cell(20, 8, utf8_decode($fila[5] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[7] ?? ''), 1); // Estado
    $pdf->Ln();
}

$pdf->Output('D', 'reporte_deportistas.pdf');
exit;
