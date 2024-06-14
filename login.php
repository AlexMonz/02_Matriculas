<?php
include "modelo/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

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
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: login.php");
        }
    } else {
        $_SESSION['error'] = "No existe una cuenta con ese correo electrónico.";
        header("Location: login.php");
    }

    $sql->close();
    $conexion->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">INICIO SESION UAX PARKING</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
