<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    // Si no hay una sesión activa, redirigir al login
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario']; // Obtener el usuario actual desde la sesión

if (isset($_GET['titulo'])) {
    $titulo = $_GET['titulo'];

    // Preparar la consulta para obtener los detalles del libro
    $sql = "SELECT * FROM libro_aluguer WHERE titulo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $titulo); // "s" es para string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Verificar si hay stock disponible
        if ($row['cantidade'] > 0) {
            // Reducir la cantidad del libro
            $nueva_cantidad = $row['cantidade'] - 1;

            // Preparar consulta para actualizar la cantidad
            $sql_update = "UPDATE libro_aluguer SET cantidade=? WHERE titulo=?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("is", $nueva_cantidad, $titulo); // "i" es para integer, "s" para string

            // Insertar en la tabla de libros alquilados
            $sql_insert = "INSERT INTO libro_alugado (titulo, descripcion, precio, usuario)
                           VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssss", $row['titulo'], $row['descripcion'], $row['prezo'], $usuario);

            // Ejecutar ambas consultas
            if ($stmt_update->execute() && $stmt_insert->execute()) {
                echo "Libro alquilado con éxito.";
            } else {
                echo "Error al alquilar el libro. Intenta nuevamente.";
            }
        } else {
            echo "No hay stock disponible para alquilar este libro.";
        }
    } else {
        echo "El libro no existe o ha sido eliminado.";
    }
} else {
    echo "No se ha proporcionado un título válido.";
}

$stmt->close();
$stmt_update->close();
$stmt_insert->close();
$conn->close();
?>

