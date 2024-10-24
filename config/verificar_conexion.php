<?php
// Incluimos el archivo de conexión con la ruta correcta
include_once(__DIR__ . "/conexionbd.php");

// Verificamos si la conexión es exitosa realizando una consulta simple
try {
    if (isset($conexion)) {
        $stmt = $conexion->query("SELECT 1");
        echo "Conexión exitosa a la base de datos.";
    } else {
        echo "Error: la variable \$conexion no está definida.";
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
