<?php
class Reportecarreramodels
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

    public function ReporteCarrera($id_carrera = null)
    {
        try {
            if ($id_carrera) {
                $sql = $this->db->prepare("SELECT 
                    e.carnet,
                    e.nombre_completo AS nombre_estudiante,
                    c.nombre_carrera,
                    c.duracion
                FROM estudiantes e
                INNER JOIN carreras c ON e.id_carrera = c.id_carrera
                WHERE e.id_carrera = :id_carrera");
                $sql->bindParam(':id_carrera', $id_carrera, PDO::PARAM_INT);
            } else {
                $sql = $this->db->prepare("SELECT 
                    e.carnet,
                    e.nombre_completo AS nombre_estudiante,
                    c.nombre_carrera,
                    c.duracion
                FROM estudiantes e
                INNER JOIN carreras c ON e.id_carrera = c.id_carrera");
            }

            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en reporte: " . $e->getMessage());
            return [];
        }
    }

    public function ObtenerCarreras()
    {
        try {
            $sql = $this->db->prepare("SELECT id_carrera, nombre_carrera FROM carreras");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener carreras: " . $e->getMessage());
            return [];
        }
    }
}
