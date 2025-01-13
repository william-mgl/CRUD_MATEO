<?php
$host = 'localhost';
$dbname = 'crud_autos';  // Nombre de tu base de datos
$username = 'root';     // Usuario de MySQL
$password = '';         // Contraseña (por defecto en XAMPP es vacía)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
