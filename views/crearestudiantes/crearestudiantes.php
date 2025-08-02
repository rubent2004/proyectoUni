<?php
require_once __DIR__ . '/../head/header.php';
require_once __DIR__ . '/../../controllers/estudiantescontrollers/agregarestudiantes.php';

$controlador = new AgregarEstudiantesControllers();
$carrera = $controlador->ObtenerCarreras();

$mensaje = '';

function calcularEdad($fecha_nacimiento)
{
    $fecha_nac = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nac)->y;
    return $edad;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controlador->AgregarEstudiantes(
        $_POST['nombre_completo'],
        $_POST['carnet'],
        calcularEdad($_POST['fecha_nacimiento']),
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['id_carrera']
    );


    if ($resultado === true) {
        $mensaje = "<script>alert('Estudiante agregado correctamente');</script>";
    } else {
        // $resultado contiene el mensaje de error desde el controlador
        $mensaje = "<script>alert('Error: " . addslashes($resultado) . "');</script>";
    }
}
echo $mensaje;
?>

<div class="form-container">
    <h2>Agregar Estudiantes</h2>
    <form method="POST">
        <label for="nombre_completo">Nombre:</label>
        <input type="text" id="nombre_completo" name="nombre_completo" required>

        <label for="carnet">Carnet:</label>
        <input type="text" id="carnet" name="carnet" required>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>


        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="id_carrera">Carrera:</label>
        <select id="id_carrera" name="id_carrera" required>
            <option value="">Seleccione una carrera</option>
            <?php foreach ($carrera as $carreras): ?>
                <option value="<?= htmlspecialchars($carreras['id_carrera']) ?>">
                    <?= htmlspecialchars($carreras['nombre_carrera']) ?></option>
            <?php endforeach; ?>
        </select>
        <br /><br />

        <button type="submit">Agregar</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../head/footer.php';
?>