<?php
require_once __DIR__ . '/../head/header.php';
require_once __DIR__ . '/../../controllers/reportecarreracontrollers/reportecarrera.php';

$controlador = new ReportecarreraControllers();

// Cargar carreras para el filtro
$carreras = $controlador->ObtenerCarreras();

$idCarreraSeleccionada = $_POST['id_carrera'] ?? null;

// Si el botón "regresar" fue presionado, limpiar el filtro
if (isset($_POST['regresar'])) {
    $idCarreraSeleccionada = null;
}

$reporte = $controlador->ReporteCarrera($idCarreraSeleccionada);
?>
<link rel="stylesheet" href="/style/css/estilos.css">
<div class="tabla-container">
    <h1>Listado de Carreras con Estudiantes</h1>

    <form method="POST" style="display: inline-block; margin-right: 10px;">
        <label for="id_carrera">Filtrar por carrera:</label>
        <select name="id_carrera" id="id_carrera" <?= (isset($_POST['regresar'])) ? '' : 'required' ?>>
            <option value="">-- Selecciona una carrera --</option>
            <?php foreach ($carreras as $carrera): ?>
                <option value="<?= $carrera['id_carrera'] ?>"
                    <?= ($idCarreraSeleccionada == $carrera['id_carrera']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($carrera['nombre_carrera']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="filtrar">Filtrar</button>
    </form>

    <!-- Botón regresar para eliminar el filtro -->
    <form method="POST" style="display: inline-block;">
        <button type="submit" name="regresar">Regresar</button>
    </form>

    <br><br>

    <?php if (!empty($reporte)): ?>
        <table>
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Duración</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reporte as $reportes): ?>
                    <tr>
                        <td><?= htmlspecialchars($reportes['carnet']) ?></td>
                        <td><?= htmlspecialchars($reportes['nombre_estudiante']) ?></td>
                        <td><?= htmlspecialchars($reportes['nombre_carrera']) ?></td>
                        <td><?= htmlspecialchars($reportes['duracion']) ?> Años</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para generar PDF -->
        <form action="/pdf/reportecarrera.php" method="POST" target="_blank">
            <input type="hidden" name="id_carrera" value="<?= $idCarreraSeleccionada ?>">
            <button type="submit" class="btn-generar-pdf">Generar PDF</button>
        </form>

    <?php else: ?>
        <p>No hay estudiantes para mostrar.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../head/footer.php';  ?>