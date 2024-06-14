<?php
// modelo/conexion.php

$servername = "localhost";
$port = 3307;
$username = "root";
$password = "admin";
$dbname = "matriculas";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $dbname, $port);

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
