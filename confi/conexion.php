<?php
class db
{
    private $server = '185.27.134.131'; // nombre del servicio en docker-compose
    private $user = 'if0_39615798';
    private $pass = 'uzFXWATSg8jAX';
    private $db = 'if0_39615798_universidad';

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
