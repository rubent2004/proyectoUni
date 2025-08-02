<?php

class AgregarCarrerasModels
{
    private $db;
    public function __construct()
    {
        require_once __DIR__ . '/../../confi/conexion.php';

        $objbd = new db();
        $this->db = $objbd->conexion();

        if (!$this->db) {
            die("Error: No se pudo conectar a la base de datos.");
        }
    }

    // Método para verificar si la carrera ya existe
    public function ExisteCarrera($Nombre)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM carreras WHERE nombre_carrera = :nombre_carrera");
        $sql->bindParam(':nombre_carrera', $Nombre);
        $sql->execute();
        $count = $sql->fetchColumn();
        return $count > 0;
    }

    public function AgregarCarrera($Nombre, $Descripcion,  $Duracion)
    {
        // Validar si ya existe
        if ($this->ExisteCarrera($Nombre)) {
            // Retornamos un valor especial para indicar que ya existe
            return 'existe';
        }

        $sql = $this->db->prepare("INSERT INTO carreras (nombre_carrera, descripcion, duracion)
            VALUES (:nombre_carrera, :descripcion, :duracion)");

        $sql->bindParam(':nombre_carrera', $Nombre);
        $sql->bindParam(':descripcion', $Descripcion);
        $sql->bindParam(':duracion', $Duracion);

        try {
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
