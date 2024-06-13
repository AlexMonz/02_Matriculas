<?php
// controlador/registro_persona.php

if (isset($_POST['btnregistrar'])) {
    // Incluir la conexión a la base de datos
    include "../modelo/conexion.php";

    // Recuperar datos del formulario y validarlos
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $matricula = trim($_POST['matricula']);
    $color = trim($_POST['color']);

    // Validaciones
    $errors = [];

    if (empty($marca)) {
        $errors[] = "La marca es obligatoria.";
    }

    if (empty($modelo)) {
        $errors[] = "El modelo es obligatorio.";
    }

    if (empty($matricula)) {
        $errors[] = "La matrícula es obligatoria.";
    }

    if (empty($color)) {
        $errors[] = "El color es obligatorio.";
    }

    // Si no hay errores, insertar en la base de datos
    if (count($errors) == 0) {
        $sql = $conexion->prepare("INSERT INTO vehiculos (marca, modelo, matricula, color) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $marca, $modelo, $matricula, $color);

        if ($sql->execute()) {
            $success = "Vehículo registrado con éxito.";
        } else {
            $errors[] = "Error: " . $sql->error;
        }

        $sql->close();
    }

    $conexion->close();
}
?>
