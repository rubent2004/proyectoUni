<?php
class db
{
   private $server = 'localhost'; // Hostname del servidor MySQL
private $user = 'root';              // Tu usuario MySQL 
private $pass = 'Cesar';        // La que escribiste al crear la base
private $db = 'universidad';    // El nombre de tu base de datos

    public function conexion()
    {
        try {
            $conn = new PDO("mysql:host={$this->server};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
?>
