<?php
class AgregarCarrerasControllers
{
    private $modelocarrera;

    public function __construct()
    {
        // Incluimos el modelo, no el controlador
        require_once __DIR__ . '/../../models/carrerasmodels/crearcarreras.php';

        $this->modelocarrera = new AgregarCarrerasModels();
    }

    public function AgregarCarrera($Nombre, $Descripcion,  $Duracion)
    {
        return $this->modelocarrera->AgregarCarrera($Nombre, $Descripcion,  $Duracion);
    }
}
