<?php
class VerEstudiantesModels
{
    private $db;

    public function __construct()
    {
        require_once("/universidad/confi/conexion.php");
        $objbd = new db();
        $this->db = $objbd->conexion();

        if (!$this->db) {
            die("Error: No se pudo conectar a la base de datos.");
        }
    }

   public function VerEstudiantes($carnet = null)
{
    try {
        if ($carnet) {
            $sql = $this->db->prepare("SELECT e.*, c.nombre_carrera 
                                       FROM estudiantes e 
                                       JOIN carreras c ON e.id_carrera = c.id_carrera 
                                       WHERE e.carnet LIKE :carnet");
            $carnet = "%$carnet%";
            $sql->bindParam(":carnet", $carnet, PDO::PARAM_STR);
        } else {
            $sql = $this->db->prepare("SELECT e.*, c.nombre_carrera 
                                       FROM estudiantes e 
                                       JOIN carreras c ON e.id_carrera = c.id_carrera");
        }

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Error en VerEstudiantes: " . $e->getMessage());
        return [];
    }
}


public function ActualizarEstudiante($nombre, $carnet, $edad,  $direccion, $telefono, $correo, $id_carrera, $id_estudiante)
{
    try {
        $sql = $this->db->prepare("UPDATE estudiantes SET nombre_completo = ?, carnet = ?, edad = ?, direccion = ?, telefono = ?, correo = ?, id_carrera = ? WHERE id_estudiante = ?");
        return $sql->execute([$nombre, $carnet, $edad,  $direccion, $telefono, $correo, $id_carrera, $id_estudiante]);
    } catch (PDOException $e) {
        error_log("Error al actualizar estudiante: " . $e->getMessage());
        return false;
    }
}

 public function obtenercarreras()
    {
        $sql = $this->db->prepare("SELECT id_carrera,  nombre_carrera FROM carreras");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function EliminarEstudiante($id_estudiante)
{
    try {
        $sql = $this->db->prepare("DELETE FROM estudiantes WHERE id_estudiante = ?");
        return $sql->execute([$id_estudiante]);
    } catch (PDOException $e) {
        error_log("Error al eliminar estudiante: " . $e->getMessage());
        return false;
    }
}



}
