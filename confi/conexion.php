<?php
class db
{

    private $server = 'db'; // nombe del servicio en docker-compose
    private $user = 'usuario';
    private $pass = 'usuariopass';
    private $db = 'universidad';

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
