<?php
session_start(); // Iniciar sesión para usar variables de sesión
include "../modelo/conexion.php";

if (isset($_POST['registrar'])) {
    // Recuperar datos del formulario y validarlos
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $matricula = trim($_POST['matricula']);
    $color = trim($_POST['color']);

    // Validaciones
    $errors = [];

    if (empty($marca) || empty($modelo) || empty($matricula) || empty($color)) {
        $_SESSION['error'] = "FALTA ALGUN CAMPO OBLIGATORIO";
    } else {
        // Si todo ok se hace la insercion del registro. 
        $sql = $conexion->prepare("INSERT INTO vehiculos (marca, modelo, matricula, color) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $marca, $modelo, $matricula, $color);

        if ($sql->execute()) {
            $_SESSION['success'] = "REGISTRO COMPLETADO";
        } else {
            $_SESSION['error'] = "Error: " . $sql->error;
        }

        $sql->close();
    }

    header("Location: ../index.php"); // Redirigir de vuelta a index.php
    exit();
}
?>
