<?php
include('../config/db.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM autos WHERE id = ?");
    $stmt->execute([$id]);
    $auto = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $anio = $_POST['anio'];
        $color = $_POST['color'];

        $stmt = $conn->prepare("UPDATE autos SET marca = ?, modelo = ?, anio = ?, color = ? WHERE id = ?");
        $stmt->execute([$marca, $modelo, $anio, $color, $id]);

        echo "Auto actualizado correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Editar Auto</h1>
    <form action="edit.php?id=<?= $auto['id'] ?>" method="POST">
        <input type="text" name="marca" value="<?= $auto['marca'] ?>" required>
        <input type="text" name="modelo" value="<?= $auto['modelo'] ?>" required>
        <input type="number" name="anio" value="<?= $auto['anio'] ?>" required>
        <input type="text" name="color" value="<?= $auto['color'] ?>" required>
        <button type="submit">Actualizar Auto</button>
    </form>
    <a href="index.php">Volver a la lista de autos</a>
</body>
</html>
