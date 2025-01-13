<?php
include('../config/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el auto de la base de datos
    $stmt = $conn->prepare("DELETE FROM autos WHERE id = ?");
    $stmt->execute([$id]);

    echo "Auto eliminado correctamente.";
}
?>

<a href="index.php">Volver a la lista de autos</a>
<link rel="stylesheet" href="../css/style.css">