<?php
require_once("../confi/conexion.php");
require_once("TCPDF-main/tcpdf.php");

$carnet = $_POST['carnet'] ?? null;

$db = new db();
$conn = $db->conexion();

try {
    if ($carnet) {
        $stmt = $conn->prepare("
            SELECT 
                e.nombre_completo, e.carnet, e.edad, e.direccion, e.telefono, e.correo,
                c.nombre_carrera, c.duracion 
            FROM estudiantes e
            INNER JOIN carreras c ON e.id_carrera = c.id_carrera
            WHERE e.carnet LIKE :carnet
        ");
        $carnet = "%$carnet%";
        $stmt->bindParam(':carnet', $carnet, PDO::PARAM_STR);
    } else {
        $stmt = $conn->prepare("
            SELECT 
                e.nombre_completo, e.carnet, e.edad, e.direccion, e.telefono, e.correo,
                c.nombre_carrera, c.duracion 
            FROM estudiantes e
            INNER JOIN carreras c ON e.id_carrera = c.id_carrera
        ");
    }

    $stmt->execute();
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en consulta: " . $e->getMessage());
}

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Universidad');
$pdf->SetTitle('Reporte de Estudiantes');
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 10, 'Reporte de Estudiantes', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 12);

if (!empty($estudiantes)) {
    foreach ($estudiantes as $estudiante) {
        // Título de sección
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Carrera Inscrita: ' . $estudiante['nombre_carrera'], 0, 1);

        // Información estudiante, vertical
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(50, 8, 'Nombre Completo:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['nombre_completo'], 0, 1);

        $pdf->Cell(50, 8, 'Carnet:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['carnet'], 0, 1);

        $pdf->Cell(50, 8, 'Edad:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['edad'], 0, 1);

        $pdf->Cell(50, 8, 'Dirección:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['direccion'], 0, 1);

        $pdf->Cell(50, 8, 'Teléfono:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['telefono'], 0, 1);

        $pdf->Cell(50, 8, 'Correo:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['correo'], 0, 1);

        $pdf->Cell(50, 8, 'Duración Carrera:', 0, 0);
        $pdf->Cell(0, 8, $estudiante['duracion'] . ' años', 0, 1);

        // Espacio entre estudiantes
        $pdf->Ln(10);
    }
} else {
    $pdf->Cell(0, 10, 'No hay estudiantes para mostrar.', 0, 1, 'C');
}

ob_end_clean();
$pdf->Output('reporte_estudiantes_vertical.pdf', 'I');
