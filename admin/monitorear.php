<?php
// Iniciar sesión
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit();
}

// Inicializar variable para el mensaje de estado del pedido
$pedidoDetalles = '';

// Comprobar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo_rastreo'])) {
    $codigoRastreo = $_POST['codigo_rastreo'];

    // Aquí deberías incluir la lógica para buscar en la base de datos
    // y obtener los detalles del pedido según el código de rastreo
    // Ejemplo de búsqueda ficticia
    $pedidoDetalles = obtenerDetallesPedido($codigoRastreo);
}

// Función ficticia para simular la búsqueda en la base de datos
function obtenerDetallesPedido($codigo) {
    // Aquí reemplazas esta lógica con una consulta real a tu base de datos
    // Ejemplo de lógica ficticia
    if ($codigo == "12345") {
        return "Tu pedido está en camino y se entregará en 30 minutos.";
    } else {
        return "Código de rastreo no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitorear Pedido</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Cambia esto por la ruta correcta de tu CSS -->
    <link rel="icon" href="Logo_renacer.jpeg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h1>Monitorear Pedido</h1>
        <form method="post" action="">
            <label for="codigo_rastreo">Ingresa tu código de rastreo:</label>
            <input type="text" id="codigo_rastreo" name="codigo_rastreo" required>
            <button type="submit" class="button">Rastrear</button>
        </form>

        <?php if ($pedidoDetalles): ?>
            <div class="resultado">
                <h2>Estado de tu Pedido:</h2>
                <p><?php echo $pedidoDetalles; ?></p>
            </div>
        <?php endif; ?>

        <div class="logout">
            <form method="post" action="">
                <button type="submit" name="logout" class="button">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <?php
    // Lógica para cerrar sesión
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: bienvenida.php");
        exit();
    }
    ?>
</body>
</html>
