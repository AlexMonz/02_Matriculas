<?php
include "modelo/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Manejar el login
        $email = trim($_POST['login_email']);
        $password = trim($_POST['login_password']);

        $sql = $conexion->prepare("SELECT id, email, password FROM usuarios WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($id, $email, $hashed_password);

        if ($sql->num_rows == 1) {
            $sql->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userid'] = $id;
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
            }
        } else {
            $_SESSION['error'] = "No existe una cuenta con ese correo electrónico.";
        }

        $sql->close();
        $conexion->close();
    } elseif (isset($_POST['register'])) {
        // Manejar el registro
        $email = trim($_POST['register_email']);
        $password = trim($_POST['register_password']);
        $confirm_password = trim($_POST['register_confirm_password']);

        if ($password != $confirm_password) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = $conexion->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
            $sql->bind_param("ss", $email, $hashed_password);

            if ($sql->execute()) {
                $_SESSION['success'] = "Registro exitoso. Por favor, inicia sesión.";
            } else {
                $_SESSION['error'] = "Error: " . $sql->error;
            }

            $sql->close();
            $conexion->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .full-height {
            height: 100vh;
        }
        .center-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header {
            text-align: center;
            margin-top: 20px;
        }
        .bg-light-yellow {
            background-color: #e7b806;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container full-height center-content">
        <div class="col-md-6 col-lg-4 bg-light-yellow">
            <h1 class="header">PARKING UAX</h1>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Registro</button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <form method="POST" action="login.php" class="mt-3">
                        <div class="mb-3">
                            <label for="login_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="login_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="login_password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="login_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Iniciar Sesión</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <form method="POST" action="login.php" class="mt-3">
                        <div class="mb-3">
                            <label for="register_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="register_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="register_password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="register_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="register_confirm_password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="register_confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="register">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
