<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
    // Si no está logueado o no es administrador, redirigir a login
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí irían los procesos para agregar, eliminar o modificar libros
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == 'Añadir') {
            // Lógica para añadir un libro
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];

            $sql = "INSERT INTO libro_aluguer (titulo, descripcion, precio, cantidade) VALUES ('$titulo', '$descripcion', '$precio', '$cantidad')";
            if ($conn->query($sql) === TRUE) {
                echo "Libro añadido con éxito.";
            } else {
                echo "Error al añadir el libro: " . $conn->error;
            }
        }

        // Similarmente, podemos añadir la lógica para eliminar y modificar libros
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Admin - Biblioteca</title>
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
        <h1>Gestión de Administrador</h1>
        <p>Bienvenido, Administrador. Desde aquí puedes gestionar los libros de la biblioteca.</p>
    </header>

    <div class="container">
        <h2>Gestión de Libros</h2>
        <form action="administrador.php" method="post">
            <h3>Añadir Libro</h3>
            <label for="titulo">Título</label><br>
            <input type="text" name="titulo" required><br><br>
            <label for="descripcion">Descripción</label><br>
            <textarea name="descripcion" required></textarea><br><br>
            <label for="precio">Precio</label><br>
            <input type="text" name="precio" required><br><br>
            <label for="cantidad">Cantidad</label><br>
            <input type="number" name="cantidad" required><br><br>
            <button type="submit" name="accion" value="Añadir" class="btn">Añadir Libro</button>
        </form>
        <!-- Aquí puedes agregar formularios similares para eliminar o modificar libros -->
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
