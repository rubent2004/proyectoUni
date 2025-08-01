<?php
require_once("../confi/conexion.php");
require_once("TCPDF-main/tcpdf.php");

// Recibir filtro id_carrera
$id_carrera = $_POST['id_carrera'] ?? null;

$db = new db();
$conn = $db->conexion();

try {
    if ($id_carrera) {
        $stmt = $conn->prepare("
            SELECT 
                e.carnet, 
                e.nombre_completo AS nombre_estudiante, 
                c.nombre_carrera, 
                c.duracion 
            FROM estudiantes e
            INNER JOIN carreras c ON e.id_carrera = c.id_carrera
            WHERE e.id_carrera = :id_carrera
        ");
        $stmt->bindParam(':id_carrera', $id_carrera, PDO::PARAM_INT);
    } else {
        $stmt = $conn->prepare("
            SELECT 
                e.carnet, 
                e.nombre_completo AS nombre_estudiante, 
                c.nombre_carrera, 
                c.duracion 
            FROM estudiantes e
            INNER JOIN carreras c ON e.id_carrera = c.id_carrera
        ");
    }

    $stmt->execute();
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en consulta: " . $e->getMessage());
}

// Crear PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Universidad');
$pdf->SetTitle('Reporte de Carreras');
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Carreras', 0, 1, 'C');
$pdf->Ln(5);

if (!empty($datos)) {
    // Cabecera de tabla
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(40, 10, 'Carnet', 1, 0, 'C');
    $pdf->Cell(70, 10, 'Nombre', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Carrera', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Duración', 1, 1, 'C');

    // Datos
    $pdf->SetFont('helvetica', '', 11);
    foreach ($datos as $fila) {
        $pdf->Cell(40, 10, $fila['carnet'], 1);
        $pdf->Cell(70, 10, $fila['nombre_estudiante'], 1);
        $pdf->Cell(50, 10, $fila['nombre_carrera'], 1);
        $pdf->Cell(30, 10, $fila['duracion'] . ' años', 1, 1);
    }
} else {
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'No hay estudiantes para mostrar.', 0, 1, 'C');
}

ob_end_clean(); // Limpia buffer de salida para evitar errores
$pdf->Output('reporte_carreras.pdf', 'I');
