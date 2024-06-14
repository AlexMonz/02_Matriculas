<?php
session_start(); // Iniciar sesión para usar variables de sesión
include "../modelo/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el ID no está vacío
    if (!empty($id)) {
        $sql = $conexion->prepare("DELETE FROM vehiculos WHERE id = ?");
        $sql->bind_param("i", $id);

        if ($sql->execute()) {
            $_SESSION['success'] = "VEHÍCULO ELIMINADO";
        } else {
            $_SESSION['error'] = "Error: " . $sql->error;
        }

        $sql->close();
    } else {
        $_SESSION['error'] = "ID DE VEHÍCULO NO VÁLIDO";
    }

    header("Location: ../index.php"); // Redirigir de vuelta a index.php
    exit();
}
?>
