<?php
class LoginModel
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../../confi/conexion.php';

        $conexion = new db();
        $this->db = $conexion->conexion();
    }

    public function obtenerUsuarioPorCorreo($correo)
    {
        $query = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }
}
