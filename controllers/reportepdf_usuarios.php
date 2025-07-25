<?php
require('../controllers/libreria/fpdf.php');
include "../models/usuario.php";

$usuario = new usuario();

// Consulta los datos directamente
if (!empty($_POST["dato"]) && !empty($_POST["valor"])) {
    $respuesta = $usuario->ConsultaEspecifica($_POST["dato"], $_POST["valor"]);
} else {
    $respuesta = $usuario->ConsultaGeneral();
}

// Validación
if (!is_array($respuesta) || count($respuesta) === 0) {
    die("No hay datos para generar el PDF.");
}

// Clase PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Usuarios - PowerLab', 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(12, 8, 'ID', 1);
        $this->Cell(25, 8, 'Nombre', 1);
        $this->Cell(25, 8, 'Apellido', 1);
        $this->Cell(35, 8, 'Correo', 1);
        $this->Cell(25, 8, 'Nacimiento', 1);
        $this->Cell(18, 8, 'Genero', 1);
        $this->Cell(20, 8, 'Rol', 1);
        $this->Cell(25, 8, 'Estado', 1);
        $this->Cell(25, 8, 'Contrasenia', 1);
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

foreach ($respuesta as $fila) {
    $pdf->Cell(12, 8, utf8_decode($fila[0] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[1] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[2] ?? ''), 1);
    $pdf->Cell(35, 8, utf8_decode($fila[3] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[4] ?? ''), 1);
    $pdf->Cell(18, 8, utf8_decode($fila[5] ?? ''), 1);
    $pdf->Cell(20, 8, utf8_decode($fila[6] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[7] ?? ''), 1);
    $pdf->Cell(25, 8, utf8_decode($fila[8] ?? ''), 1);
    $pdf->Ln();
}

$pdf->Output('D', 'reporte_usuarios.pdf');
exit;