<?php
require('../controllers/libreria/fpdf.php'); // Ruta a la librería FPDF

session_start();
$datos = $_SESSION['respuesta']; // Datos de la tabla de usuarios

class PDF extends FPDF
{
    // Encabezado del documento
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Usuarios - PowerLab', 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(15, 10, 'ID', 1);
        $this->Cell(30, 10, 'Nombre', 1);
        $this->Cell(30, 10, 'Apellido', 1);
        $this->Cell(30, 10, 'fecha_nacimiento', 1);
        $this->Cell(25, 10, 'Genero', 1);
        $this->Cell(50, 10, 'Correo', 1);
        $this->Cell(30, 10, 'Rol', 1);
        $this->Cell(30, 10, 'contrasenia', 1);
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

foreach ($datos as $fila) {
    $pdf->Cell(15, 8, $fila[0], 1); // ID
    $pdf->Cell(30, 8, utf8_decode($fila[1]), 1); // Nombre
    $pdf->Cell(30, 8, utf8_decode($fila[2]), 1); // Apellido
    $pdf->Cell(50, 8, utf8_decode($fila[3]), 1); // Correo
    $pdf->Cell(25, 8, utf8_decode($fila[5]), 1); // Género
    $pdf->Cell(30, 8, utf8_decode($fila[6]), 1); // Rol
    $pdf->Cell(30, 8, utf8_decode($fila[7]), 1);
    $pdf->Cell(30, 8, utf8_decode($fila[8]), 1);
    $pdf->Ln();
}

$pdf->Output('D', 'reporte_usuarios.pdf'); // Descargar automáticamente
?>
