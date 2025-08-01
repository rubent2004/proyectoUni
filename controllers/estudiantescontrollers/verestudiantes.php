<?php
class VerEstudiantesControllers
{
    private $modeloestudiantes;

    public function __construct()
    {
        require_once("/universidad/models/estudiantesmodels/verestudiantes.php");
        $this->modeloestudiantes = new VerEstudiantesModels();
    }

    public function VerEstudiantes($carnet = null)
    {
        return $this->modeloestudiantes->VerEstudiantes($carnet);
    }

    public function ActualizarEstudiante($nombre, $carnet, $edad, $direccion, $telefono, $correo, $id_carrera, $id_estudiante)
    {
        return $this->modeloestudiantes->ActualizarEstudiante($nombre, $carnet, $edad, $direccion, $telefono, $correo, $id_carrera, $id_estudiante);
    }

    public function ObtenerCarreras()
    {
        return $this->modeloestudiantes->obtenercarreras();
    }

    public function EliminarEstudiante($id_estudiante)
{
    return $this->modeloestudiantes->EliminarEstudiante($id_estudiante);
}

}

