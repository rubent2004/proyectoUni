<?php
class AgregarEstudiantesModels
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

    // Verifica si el carnet ya existe
    public function existeCarnet($carnet)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM estudiantes WHERE carnet = :carnet");
        $sql->bindParam(':carnet', $carnet);
        $sql->execute();
        return $sql->fetchColumn() > 0;
    }

    // Verifica si el correo ya existe
    public function existeCorreo($correo)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM estudiantes WHERE correo = :correo");
        $sql->bindParam(':correo', $correo);
        $sql->execute();
        return $sql->fetchColumn() > 0;
    }

    public function AgregarEstudiantes($nombre_completo, $carnet,  $edad, $direccion, $telefono, $correo, $id_carrera )
    {
        // Verificaciones antes de insertar
        if ($this->existeCarnet($carnet)) {
            throw new Exception("Carnet ya está asignado.");
        }

        if ($this->existeCorreo($correo)) {
            throw new Exception("Correo ya existe.");
        }

        $sql=$this->db->prepare("INSERT INTO estudiantes (nombre_completo, carnet, edad, direccion, telefono, correo, id_carrera)
            VALUES (:nombre_completo, :carnet, :edad, :direccion, :telefono, :correo, :id_carrera)");

         $sql->bindParam(':nombre_completo', $nombre_completo);
         $sql->bindParam(':carnet', $carnet);
         $sql->bindParam(':edad', $edad);
         $sql->bindParam(':direccion', $direccion);
         $sql->bindParam(':telefono', $telefono);
         $sql->bindParam(':correo', $correo);
         $sql->bindParam(':id_carrera', $id_carrera);

        try {
            $sql->execute();
            return true;
        } catch (Exception $e) {
            // Para errores de BD u otros
            throw new Exception("Error al agregar estudiante: " . $e->getMessage());
        }
    }

    public function obtenercarreras()
    {
        $sql = $this->db->prepare("SELECT id_carrera, nombre_carrera FROM carreras");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
