<?php

// Datos de conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "servicio_web";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer caracteres UTF-8
$conn->set_charset("utf8");

?>