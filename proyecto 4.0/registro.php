<?php

include("conexion.php");


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$tipo_usuario = $_POST['tipo_usuario'];


// Guardaremos la contraseña cifrada
$password_segura = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO usuarios (nombre, apellido, correo, usuario, password, tipo_usuario)
VALUES ('$nombre','$apellido','$correo','$usuario','$password_segura','$tipo_usuario')";


if($conn->query($sql) === TRUE){

    echo "¡Usuario registrado correctamente!";

}else{

    echo "Error al registrar el usuario: " . $conn->error;

}


$conn->close();

?>