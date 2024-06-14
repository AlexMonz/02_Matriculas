<?php
session_start(); // Iniciar sesión para usar variables de sesión
include "../modelo/conexion.php";

if (isset($_POST['btn_actualizar'])) {
    // Recuperar datos del formulario y validarlos
    $id = $_POST['id'];
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $matricula = trim($_POST['matricula']);
    $color = trim($_POST['color']);

    // Validaciones
    if (empty($marca) || empty($modelo) || empty($matricula) || empty($color)) {
        $_SESSION['error'] = "FALTA ALGUN CAMPO OBLIGATORIO";
    } else {
        // Si todo ok se hace la actualización del registro. 
        $sql = $conexion->prepare("UPDATE vehiculos SET marca=?, modelo=?, matricula=?, color=? WHERE id=?");
        $sql->bind_param("ssssi", $marca, $modelo, $matricula, $color, $id);

        if ($sql->execute()) {
            $_SESSION['success'] = "VEHÍCULO ACTUALIZADO";
        } else {
            $_SESSION['error'] = "Error: " . $sql->error;
        }

        $sql->close();
    }

    header("Location: ../index.php"); // Redirigir de vuelta a index.php
    exit();
}
?>
