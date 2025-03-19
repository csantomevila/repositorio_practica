<?php
session_start(); // Iniciar sesión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapar los datos para evitar inyecciones SQL
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $contrasinal = $_POST['contrasinal'];

    // Preparar la consulta para evitar inyecciones SQL
    $sql = "SELECT * FROM usuario WHERE usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario); // Vincular el parámetro de la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña usando password_verify
        if (password_verify($contrasinal, $row['contrasinal'])) {
            // Si las credenciales son correctas, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id'] = $row['id']; // Puedes guardar más información si es necesario
            $_SESSION['rol'] = $row['rol']; // Si tienes un campo de rol, puedes usarlo para verificar permisos

            // Redirigir al usuario a la página de gestión de libros
            header("Location: gestion_libros.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <style>
        /* Aquí puedes agregar tu CSS o enlaces a un archivo de estilo externo */
    </style>
</head>
<body>

    <header>
        <h1>Iniciar sesión</h1>
        <p>Introduce tus credenciales para acceder a tu cuenta.</p>
    </header>

    <div class="container">
        <!-- Formulario de inicio de sesión -->
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contrasinal" placeholder="Contraseña" required>
            <button type="submit">Acceder</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.html">Regístrate aquí</a></p>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos los derechos reservados.</p>
    </footer>

</body>
</html>



