<?php
include('../config/db.php');

// Obtener todos los autos desde la base de datos
$stmt = $conn->prepare("SELECT * FROM autos");
$stmt->execute();
$autos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Lista de Autos</h1>
    <a href="create.php">Agregar Nuevo Auto</a>
    <table>
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autos as $auto): ?>
            <tr>
                <td><?= $auto['marca'] ?></td>
                <td><?= $auto['modelo'] ?></td>
                <td><?= $auto['anio'] ?></td>
                <td><?= $auto['color'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $auto['id'] ?>">Editar</a> |
                    <a href="delete.php?id=<?= $auto['id'] ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
