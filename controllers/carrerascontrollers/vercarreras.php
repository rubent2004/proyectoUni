<?php
class VerEstudiantesControllers
{
    private $modelocarrera;

    public function __construct()
    {
        require_once __DIR__ . '/../../models/carrerasmodels/vercarreras.php';
        $this->modelocarrera = new VerCarrerasModels();
    }

    public function VerCarreras()
    {
        return $this->modelocarrera->VerCarreras();
    }

    public function ActualizarCarrera($nombre, $descripcion, $duraccion,  $id)
    {
        return $this->modelocarrera->ActualizarCarrera($nombre, $descripcion, $duraccion,  $id);
    }
    public function EliminarCarrera($id)
    {
        return $this->modelocarrera->EliminarCarrera($id);
    }
}
