<?php
class db
{
    private $server = 'nozomi.proxy.rlwy.net';
    private $port = 18742; // 📌 cámbialo por el correcto desde Railway
    private $user = 'root';
    private $pass = 'eVxpxeszlsipEHBokRwxXizlPRIRbTxk';
    private $db = 'railway';

    public function conexion()
    {
        try {
            $dsn = "mysql:host={$this->server};port={$this->port};dbname={$this->db};charset=utf8";
            $conn = new PDO($dsn, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
