<?php
class VerCarrerasModels
{
    private $db;

    public function __construct()
    {
        require_once("C:/xampp/htdocs/universidad/confi/conexion.php");
        $objbd = new db();
        $this->db = $objbd->conexion();

        if (!$this->db) {
            die("Error: No se pudo conectar a la base de datos.");
        }
    }

    public function VerCarreras()
    {
        
        try {

            $sql = $this->db->prepare("SELECT * FROM carreras");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en carreras: " . $e->getMessage());
            return [];
        }
    }

     public function ActualizarCarrera($nombre, $descripcion, $duraccion,  $id)
    {
        try {
            $sql = $this->db->prepare("UPDATE carreras SET nombre_carrera = ?, descripcion = ?, duracion = ? WHERE id_carrera = ?");
            return $sql->execute([$nombre, $descripcion, $duraccion,  $id]);
        } catch (PDOException $e) {
            error_log("Error al actualizar carrera: " . $e->getMessage());
            return false;
        }
    }
    public function EliminarCarrera($id)
{
    try {
        // Verificar si hay estudiantes asignados a la carrera
        $verificar = $this->db->prepare("SELECT COUNT(*) FROM estudiantes WHERE id_carrera = ?");
        $verificar->execute([$id]);
        $total = $verificar->fetchColumn();

        if ($total > 0) {
            return "relacionado"; // No se puede eliminar
        }

        // Eliminar si no hay estudiantes relacionados
        $sql = $this->db->prepare("DELETE FROM carreras WHERE id_carrera = ?");
        $sql->execute([$id]);

        return "eliminado";
    } catch (PDOException $e) {
        error_log("Error al eliminar carrera: " . $e->getMessage());
        return "error";
    }
}

    
}
