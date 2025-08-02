<?php
require_once __DIR__ . '/../head/header.php';
require_once __DIR__ . '/../../controllers/carrerascontrollers/crearcarreras.php';

$controlador = new AgregarCarrerasControllers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controlador->AgregarCarrera(
        $_POST['nombre_carrera'],
        $_POST['descripcion'],
        $_POST['duracion']
    );

    if ($resultado === true) {
        echo "<script>alert('Carrera agregada correctamente');</script>";
    } elseif ($resultado === 'existe') {
        echo "<script>alert('Error: Ya existe una carrera con ese nombre');</script>";
    } else {
        echo "<script>alert('Error al agregar carrera');</script>";
    }
}
?>

<div class="form-container">
    <h2>Agregar Carreras</h2>
    <form method="POST">
        <label for="nombre_carrera">Nombre:</label>
        <input type="text" id="nombre_carrera" name="nombre_carrera" required>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>

        <label for="duracion">Duración:</label>
        <input type="number" id="duracion" name="duracion" required min="1" max="10" step="1">

        <button type="submit">Agregar</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../head/footer.php';
?>