<?php
// Definir las constantes para la conexión
define('DB_SERVER', 'localhost');  // o 127.0.0.1
define('DB_USERNAME', 'root');     // Usuario de MySQL
define('DB_PASSWORD', '');         // Contraseña, si la tienes
define('DB_NAME', 'catalogo');     // Nombre de la base de datos

// Crear conexión
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    // Si ocurre un error, muestra el mensaje de error
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres adecuado para la conexión
if (!$conn->set_charset("utf8")) {
    // Si falla al establecer el charset, muestra el mensaje
    die("Error al establecer el conjunto de caracteres: " . $conn->error);
}
?>

