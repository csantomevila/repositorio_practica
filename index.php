<?php
session_start(); // Iniciar sesión para verificar el acceso

// Comprobar si el usuario ya ha iniciado sesión y redirigir a la página correspondiente
if (isset($_SESSION['usuario'])) {
    // Si es usuario normal, redirigir a la página de usuarios
    if ($_SESSION['tipo_usuario'] == 'u') {
        header("Location: usuarios.php");
        exit();
    }
    // Si es administrador, redirigir a la página de administradores
    if ($_SESSION['tipo_usuario'] == 'a') {
        header("Location: administradores.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Inicio</title>
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
        header h1 {
            margin: 0;
        }
        .container {
            max-width: 600px;
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
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h1>Bienvenido a la Biblioteca</h1>
        <p>Accede o regístrate para gestionar tus libros</p>
    </header>

    <div class="container">
        <!-- Formulario de Acceso -->
        <h2>Acceso</h2>
        <form action="login_procesar.php" method="post">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contrasinal" placeholder="Contraseña" required>
            <button type="submit" class="btn">Acceder</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php" class="btn">Regístrate aquí</a></p>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

