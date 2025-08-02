 <?php
 class AgregarCarrerasControllers
 {
    private $modelocarrera;
    
    public function __construct()
    {
 require_once("C:/xampp/htdocs/universidad/models/carrerasmodels/crearcarreras.php");

        $this->modelocarrera = new AgregarCarrerasModels();
    }

 public function AgregarCarrera($Nombre, $Descripcion,  $Duracion)
    {
        return $this->modelocarrera->AgregarCarrera($Nombre, $Descripcion,  $Duracion);
    }
}

    ?>