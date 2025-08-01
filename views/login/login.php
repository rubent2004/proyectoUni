<?php
require_once("/universidad/controllers/login/login.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new LoginController();
    $error = $controller->login($_POST['correo'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fondo-login {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0F172A;
        }
        .login {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            color: blue;
            background-color: white;
        }
        .btn-primary {
            background-color: #0F172A;
            color: white;
        }
        .form-control {
            background-color: #e5e5e5ff;
            border: #a5a0a0ff solid 3px;
        }
        .form-label {
            color: #0F172A;
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="fondo-login">
    <div class="card col-md-4 login">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" id="correo" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>

                <?php if ($error): ?>
                    <p class="mt-3 text-danger text-center"><?= $error ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

</body>
</html>
