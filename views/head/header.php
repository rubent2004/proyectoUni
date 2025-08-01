<?php
require_once("/universidad/views/head/head.php");
?>

<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/universidad">Login</a>
    <a class="navbar-brand" href="/universidad/views/principal.php">Inicio</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Que deseas hacer ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
        <a class="nav-link" href="/universidad/views/verestudiantes/verestudiantes.php">
        <i class="fas fa-users"></i> Ver Estudiantes
        </a>
       </li>
         <li class="nav-item">
          <a class="nav-link" href="/universidad/views/vercarrera/vercarreras.php">
            <i class="fas fa-book"></i> Ver Carreras
          </a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="/universidad/views/reportecarrera/reportecarrera.php">
            <i class="fas fa-file-alt"></i> Reporte de las carreras
          </a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="/universidad/views/crearcarrera/crearcarrera.php">
            <i class="fas fa-plus-circle"></i> Agregar Carrera
          </a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="/universidad/views/crearestudiantes/crearestudiantes.php">
            <i class="fas fa-user-plus"></i> Agregar Estudiante
          </a>
        </li>

        </ul>
      </div>
    </div>
  </div>
</nav>

<?php
require_once("/universidad/views/head/footer.php");
?>