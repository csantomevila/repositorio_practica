<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasinal = $_POST['contrasinal'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $nifdni = $_POST['nifdni'];

    // Verificar si el usuario ya existe en la base de datos
    $sql = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está registrado. Intenta con otro.";
    } else {
        // Encriptar la contraseña antes de almacenarla
        $contrasinal_hash = password_hash($contrasinal, PASSWORD_DEFAULT);

        // Insertar los datos del nuevo usuario en la base de datos
        $sql_insert = "INSERT INTO usuario (usuario, contrasinal, nombre, direccion, telefono, nifdni)
                       VALUES ('$usuario', '$contrasinal_hash', '$nombre', '$direccion', '$telefono', '$nifdni')";

        if ($conn->query($sql_insert) === TRUE) {
            // Redirigir al login después de un registro exitoso
            header("Location: login.php");
            exit;
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Biblioteca</title>
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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h1>Registro en la Biblioteca</h1>
        <p>Completa los datos para registrarte</p>
    </header>

    <div class="container">
        <!-- Formulario de Registro -->
        <form action="registro.php" method="post">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contrasinal" placeholder="Contraseña" required>
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="tel" name="telefono" placeholder="Teléfono" required>
            <input type="text" name="nifdni" placeholder="NIF/DNI" required>
            <button type="submit" class="btn">Registrar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
