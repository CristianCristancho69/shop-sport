<?php

include("conexion.php");

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $confirmar_password = $_POST["confirmar_password"];

    // Verificar que las contraseñas coincidan
    if ($password != $confirmar_password) {
        die("Las contraseñas no coinciden.");
    }

    // Verificar si el usuario ya existe
    $consulta = "SELECT id FROM usuarios WHERE usuario = ?";

    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        echo "El usuario ya existe.";

    } else {

        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Registrar el usuario
        $consulta = "INSERT INTO usuarios (nombre, usuario, password) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($consulta);
        $stmt->bind_param("sss", $nombre, $usuario, $password_hash);

        if ($stmt->execute()) {

            echo "Registro exitoso.";
            echo "<br><br>";
            echo "<a href='index.html'>Iniciar sesión</a>";

        } else {

            echo "Error al registrar el usuario: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();

?>