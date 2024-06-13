<?php
// modelo/conexion.php

$servername = "";
$username = "root";
$password = "";
$dbname = "registro_vehiculos";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
