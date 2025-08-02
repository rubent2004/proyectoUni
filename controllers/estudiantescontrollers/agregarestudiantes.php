<?php
class AgregarEstudiantesControllers
{
    private $modeloestudiantes;

    public function __construct()
    {
        require_once __DIR__ . '/../../models/estudiantesmodels/crearestudiantes.php';
        $this->modeloestudiantes = new AgregarEstudiantesModels();
    }

    public function AgregarEstudiantes($nombre_completo, $carnet,  $edad, $direccion, $telefono, $correo, $id_carrera)
    {
        try {
            return $this->modeloestudiantes->AgregarEstudiantes($nombre_completo, $carnet,  $edad, $direccion, $telefono, $correo, $id_carrera);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function ObtenerCarreras()
    {
        return $this->modeloestudiantes->obtenercarreras();
    }
}
