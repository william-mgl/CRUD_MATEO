<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $color = $_POST['color'];

   
    if (!empty($marca) && !empty($modelo) && !empty($anio) && !empty($color)) {
        $stmt = $conn->prepare("INSERT INTO autos (marca, modelo, anio, color) VALUES (?, ?, ?, ?)");
        $stmt->execute([$marca, $modelo, $anio, $color]);

        echo "Auto agregado correctamente.";
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Auto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Agregar Auto</h1>
    <form action="create.php" method="POST">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="number" name="anio" placeholder="Año" required>
        <input type="text" name="color" placeholder="Color" required>
        <button type="submit">Agregar Auto</button>
    </form>
    <a href="index.php">Volver a la lista de autos</a>
</body>
</html>
