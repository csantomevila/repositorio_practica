<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir al login
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario']; // Obtener el usuario desde la sesión

// Consultar los libros disponibles
$sql = "SELECT * FROM libro_aluguer";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros - Biblioteca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Gestión de Libros</h1>
        <p>Bienvenido a la gestión de libros de la biblioteca. Aquí puedes ver, alquilar o devolver libros.</p>
    </header>

    <div class="container">
        <h2>Libros Disponibles</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo $row['titulo'] . " - " . $row['descripcion'] . " - €" . $row['prezo'];
                echo " <a href='alquilar.php?titulo=" . $row['titulo'] . "' class='btn'>Alquilar</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No hay libros disponibles.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
