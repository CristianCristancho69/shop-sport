<?php

include("conexion.php");

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Buscar el usuario en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE usuario = ?";

    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows == 1) {

        $datos = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $datos["password"])) {

            echo "Inicio de sesión exitoso.";
            echo "<br><br>";
            echo "<a href='inicio.html'>Continuar</a>";

        } else {

            echo "Contraseña incorrecta.";
        }

    } else {

        echo "El usuario no existe.";
    }

    $stmt->close();
}

$conn->close();

?>