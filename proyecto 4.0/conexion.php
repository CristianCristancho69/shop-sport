<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "shopsports";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>