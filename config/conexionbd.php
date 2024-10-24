<?php
// Configuración de la base de datos
$host = "localhost";
$dbname = "renacer_db";
$username = "root";
$password = "";

try {
    // Crear una instancia de PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar error y detener ejecución si la conexión falla
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
?>
