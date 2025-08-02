<?php
require_once("models/login/login.php");

class LoginController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new LoginModel();
    }

    public function login($correo, $password)
    {
        $usuario = $this->modelo->obtenerUsuarioPorCorreo($correo);

        if ($usuario) {
            if ($password == $usuario['contrasena']) {
                // Si las credenciales son correctas, redirige sin guardar sesión
                header("Location: views/principal.php");
                exit();
            } else {
                return "Contraseña incorrecta.";
            }
        } else {
            return "Correo electrónico no encontrado.";
        }
    }
}
