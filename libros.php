<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM libro_aluguer";
$result = $conn->query($sql);

echo "<h2>Libros Disponibles</h2>";

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['titulo']) . "</td>
                <td>" . htmlspecialchars($row['descripcion']) . "</td>
                <td>" . htmlspecialchars($row['prezo']) . " €</td>
                <td><a href='alquilar.php?titulo=" . urlencode($row['titulo']) . "'>Alquilar</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay libros disponibles en este momento.</p>";
}

$conn->close();
?>
