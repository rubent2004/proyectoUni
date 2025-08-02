<?php
require_once __DIR__ . '/../head/header.php';
require_once __DIR__ . '/../../controllers/carrerascontrollers/vercarreras.php';

$controlador = new VerEstudiantesControllers();
$mensaje = '';

// Eliminar carrera
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $resultado = $controlador->EliminarCarrera($_POST['id']);
    if ($resultado === 'relacionado') {
        $mensaje = "❌ No se puede eliminar. La carrera tiene estudiantes asignados.";
    } elseif ($resultado === 'eliminado') {
        header("Location: vercarreras.php");
        exit;
    } else {
        $mensaje = "❌ Ocurrió un error al eliminar la carrera.";
    }
}

// Guardar carrera actualizada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
    $controlador->ActualizarCarrera(
        $_POST['nombre_carrera'],
        $_POST['descripcion'],
        $_POST['duracion'],
        $_POST['id']
    );
    header("Location: vercarreras.php");
    exit;
}

$carreras = $controlador->VerCarreras();
?>

<link rel="stylesheet" href="/style/css/estilos.css">

<div class="tabla-container">
    <h1>Listado de Carreras</h1>

    <?php if (!empty($carreras)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Duración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carreras as $carrera): ?>
            <tr>
                <td><?= $carrera['id_carrera'] ?></td>
                <form method="post">
                    <td>
                        <input type="hidden" name="id" value="<?= $carrera['id_carrera'] ?>">
                        <input type="text" name="nombre_carrera"
                            value="<?= htmlspecialchars($carrera['nombre_carrera']) ?>" readonly>
                    </td>
                    <td>
                        <input type="text" name="descripcion" value="<?= htmlspecialchars($carrera['descripcion']) ?>"
                            readonly>
                    </td>
                    <td>
                        <input type="number" name="duracion" value="<?= htmlspecialchars($carrera['duracion']) ?>"
                            readonly>
                    </td>
                    <td>
                        <button type="button" class="editar-btn btn-accion"
                            onclick="activarEdicion(this)">Editar</button>
                        <button type="submit" name="guardar" class="guardar-btn btn-accion"
                            style="display:none;">Guardar</button>
                        <button type="button" class="cancelar-btn btn-accion" style="display:none;"
                            onclick="cancelarEdicion(this)">Cancelar</button>
                        <button type="submit" name="eliminar" class="btn-accion"
                            onclick="return confirmarEliminar()">Eliminar</button>
                    </td>

                </form>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No hay carreras para mostrar.</p>
    <?php endif; ?>
</div>

<script>
function activarEdicion(boton) {
    const fila = boton.closest('tr');
    fila.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
    boton.style.display = 'none';
    fila.querySelector('.guardar-btn').style.display = 'inline-block';
    fila.querySelector('.cancelar-btn').style.display = 'inline-block';

    // Ocultar botón eliminar mientras se edita
    const btnEliminar = fila.querySelector('button[name="eliminar"]');
    if (btnEliminar) btnEliminar.style.display = 'none';
}

function cancelarEdicion(boton) {
    const fila = boton.closest('tr');
    fila.querySelectorAll('input').forEach(input => input.setAttribute('readonly', true));
    fila.querySelector('.guardar-btn').style.display = 'none';
    boton.style.display = 'none';
    fila.querySelector('.editar-btn').style.display = 'inline-block';

    // Mostrar botón eliminar cuando se cancela la edición
    const btnEliminar = fila.querySelector('button[name="eliminar"]');
    if (btnEliminar) btnEliminar.style.display = 'inline-block';
}


function confirmarEliminar() {
    return confirm("¿Estás seguro que deseas eliminar esta carrera?");
}
</script>

<?php if (!empty($mensaje)): ?>
<script>
alert("<?= addslashes($mensaje) ?>");
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/../head/footer.php';  ?>