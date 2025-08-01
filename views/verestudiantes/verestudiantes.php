<?php
require_once("/universidad/views/head/header.php");
require_once("/universidad/controllers/estudiantescontrollers/verestudiantes.php");

// Controlador estudiantes
$controlador = new VerEstudiantesControllers();

$carnet = $_POST['carnet'] ?? '';
$resultado = false;

$carreras = $controlador->ObtenerCarreras(); // lista completa de carreras

// ELIMINAR estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $resultado = $controlador->EliminarEstudiante($_POST['id_estudiante']);

    if ($resultado) {
        echo "<script>alert('Estudiante eliminado correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar estudiante');</script>";
    }

    header("Location: verestudiantes.php");
    exit;
}

// ACTUALIZAR estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
    $resultado = $controlador->ActualizarEstudiante(
        $_POST['nombre'],
        $_POST['carnet'],
        $_POST['edad'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['carrera'],      // id_carrera seleccionado
        $_POST['id_estudiante']
    );

    if ($resultado) {
        echo "<script>alert('Estudiante actualizado correctamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar estudiante');</script>";
    }

    header("Location: verestudiantes.php");
    exit;
}

$estudiantes = $controlador->VerEstudiantes($carnet);
?>

<link rel="stylesheet" href="/universidad/style/css/estilos.css">

<div class="tabla-container">
    <h1>Listado de Estudiantes</h1>

    <form method="POST">
        <label for="carnet">Filtrar por Carnet:</label>
        <input type="text" name="carnet" id="carnet" value="<?= htmlspecialchars($carnet) ?>">
        <button type="submit">Filtrar</button>
    </form>
    <br>

    <?php if (!empty($estudiantes)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Carnet</th>
                    <th>Edad</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <form method="post" id="form-<?= htmlspecialchars($estudiante['carnet']) ?>">
                            <input type="hidden" name="id_estudiante" value="<?= htmlspecialchars($estudiante['id_estudiante']) ?>">

                            <td><input type="text" name="nombre" value="<?= htmlspecialchars($estudiante['nombre_completo']) ?>" readonly></td>
                            <td><input type="text" name="carnet" value="<?= htmlspecialchars($estudiante['carnet']) ?>" readonly></td>
                            <td><input type="number" name="edad" value="<?= htmlspecialchars($estudiante['edad']) ?>" readonly></td>
                            <td><input type="text" name="direccion" value="<?= htmlspecialchars($estudiante['direccion']) ?>" readonly></td>
                            <td><input type="text" name="telefono" value="<?= htmlspecialchars($estudiante['telefono']) ?>" readonly></td>
                            <td><input type="email" name="correo" value="<?= htmlspecialchars($estudiante['correo']) ?>" readonly></td>

                            <td>
                                <?php 
                                $nombreCarrera = "";
                                foreach ($carreras as $c) {
                                    if ($c['id_carrera'] == $estudiante['id_carrera']) {
                                        $nombreCarrera = $c['nombre_carrera'];
                                        break;
                                    }
                                }
                                ?>
                                <input type="text" name="carrera_nombre" value="<?= htmlspecialchars($nombreCarrera) ?>" readonly class="carrera-nombre">
                                <select name="carrera" class="carrera-select" style="display:none;">
                                    <?php foreach ($carreras as $c): ?>
                                        <option value="<?= $c['id_carrera'] ?>" <?= ($c['id_carrera'] == $estudiante['id_carrera']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c['nombre_carrera']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td>
    <div class="btn-group">
        <button type="button" class="editar-btn btn-accion" onclick="activarEdicion(this)">Editar</button>
        <button type="submit" name="guardar" class="guardar-btn btn-accion" style="display:none;">Guardar</button>
        <button type="button" class="cancelar-btn btn-accion" style="display:none;" onclick="cancelarEdicion(this)">Cancelar</button>
        <button type="submit" name="eliminar" class="eliminar-btn btn-accion" onclick="return confirmarEliminacion()">Eliminar</button>
    </div>
</td>


                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón PDF -->
        <form action="/universidad/pdf/reporteestudiantes.php" method="POST" target="_blank">
            <input type="hidden" name="carnet" value="<?= htmlspecialchars($carnet) ?>">
            <button type="submit" class="btn-generar-pdf">Generar PDF</button>
        </form>

    <?php else: ?>
        <p>No hay estudiantes para mostrar.</p>
    <?php endif; ?>
</div>

<script>
// Habilitar edición
function activarEdicion(boton) {
    const fila = boton.closest('tr');
    fila.querySelectorAll('input[readonly]').forEach(input => input.removeAttribute('readonly'));
    fila.querySelector('.carrera-nombre').style.display = 'none';
    fila.querySelector('.carrera-select').style.display = 'inline-block';

    boton.style.display = 'none';
    fila.querySelector('.guardar-btn').style.display = 'inline-block';
    fila.querySelector('.cancelar-btn').style.display = 'inline-block';

    // Ocultar botón eliminar mientras se edita
    const btnEliminar = fila.querySelector('button[name="eliminar"], .eliminar-btn');
    if (btnEliminar) btnEliminar.style.display = 'none';
}

// Cancelar edición
function cancelarEdicion(boton) {
    const fila = boton.closest('tr');
    fila.querySelectorAll('input').forEach(input => input.setAttribute('readonly', true));
    fila.querySelector('.carrera-nombre').style.display = 'inline-block';
    fila.querySelector('.carrera-select').style.display = 'none';

    fila.querySelector('.guardar-btn').style.display = 'none';
    boton.style.display = 'none';
    fila.querySelector('.editar-btn').style.display = 'inline-block';

    // Mostrar botón eliminar cuando se cancela la edición
    const btnEliminar = fila.querySelector('button[name="eliminar"], .eliminar-btn');
    if (btnEliminar) btnEliminar.style.display = 'inline-block';
}

// Confirmar eliminación
function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar este estudiante? Esta acción no se puede deshacer.');
}
</script>


<?php require_once("/universidad/views/head/footer.php"); ?>
