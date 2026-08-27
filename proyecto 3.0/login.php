<?php

session_start();

include("conexion.php");

// Verificar que el formulario envió los datos
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar el usuario
$sql = "SELECT * FROM usuarios WHERE usuario = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la consulta: " . $conn->error);
}

$stmt->bind_param("s", $usuario);
$stmt->execute();

$resultado = $stmt->get_result();

// Verificar si existe
if ($resultado->num_rows === 1) {

    $fila = $resultado->fetch_assoc();

    // Verificar contraseña
if (password_verify($password, $fila['password'])) {

    $_SESSION['id'] = $fila['id'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];

    // Ir automáticamente al inicio
    header("Location: index.php");
    exit();



    } else {

        echo "<h2>Contraseña incorrecta.</h2>";
        echo '<a href="index.php">Volver</a>';

    }

} else {

    echo "<h2>El usuario no existe.</h2>";
    echo '<a href="index.php">Volver</a>';

}

$stmt->close();
$conn->close();

?>