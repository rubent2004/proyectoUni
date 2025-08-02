
<?php
require_once("C:/xampp/htdocs/universidad/views/head/header.php");
?>
  <div class="card-container">
    <div class="card">
      <h5 class="card-title">Ver Estudiantes</h5>
      <p class="card-text">En este apartado podrás administrar los estudiantes registrados.</p>
      <a href="/universidad/views/verestudiantes/verestudiantes.php" class="card-link">Ver Estudiantes</a>
    </div>

    <div class="card">
      <h5 class="card-title">Agregar Estudiante</h5>
      <p class="card-text">Registra un nuevo estudiante en la base de datos.</p>
      <a href="/universidad/views/crearestudiantes/crearestudiantes.php" class="card-link">Agregar Estudiante</a>
    </div>

    <div class="card">
      <h5 class="card-title">Ver Carreras</h5>
      <p class="card-text">Consulta las carreras académicas disponibles.</p>
      <a href="/universidad/views/vercarrera/vercarreras.php" class="card-link">Ver Carreras</a>
    </div>

    <div class="card">
      <h5 class="card-title">Agregar Carrera</h5>
      <p class="card-text">Añade una nueva carrera universitaria al sistema.</p>
      <a href="/universidad/views/crearcarrera/crearcarrera.php" class="card-link">Agregar Carrera</a>
    </div>

    <div class="card">
      <h5 class="card-title">Reportes PDF</h5>
      <p class="card-text">Genera reportes PDF de los registros disponibles.</p>
      <a href="/universidad/views/reportecarrera/reportecarrera.php" class="card-link">Generar Reporte</a>
    </div>
  </div>


<?php
require_once("C:/xampp/htdocs/universidad/views/head/footer.php");
?>