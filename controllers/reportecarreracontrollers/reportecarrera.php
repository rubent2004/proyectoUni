<?php
class ReportecarreraControllers
{
    private $modeloreporte;

    public function __construct()
    {
        require_once("C:/xampp/htdocs/universidad/models/reportecarreramodels/reportecarrera.php");
        $this->modeloreporte = new Reportecarreramodels();
    }

    public function ReporteCarrera($id_carrera = null)
    {
        return $this->modeloreporte->ReporteCarrera($id_carrera);
    }

    public function ObtenerCarreras()
    {
        return $this->modeloreporte->ObtenerCarreras();
    }
}

