<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "mi_portafolio";
$user = "root"; // cambia esto si usas otro usuario
$pass = "";     // cambia esto si tu usuario tiene contraseña

$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y sanitizar datos
$nombre = htmlspecialchars($_POST['nombre']);
$email = htmlspecialchars($_POST['email']);
$mensaje = htmlspecialchars($_POST['mensaje']);

// Insertar en la base de datos
$sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $mensaje);

if ($stmt->execute()) {
    echo "Gracias por contactarnos, $nombre.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
