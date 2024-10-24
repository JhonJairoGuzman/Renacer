<?php
require_once 'Pedido.php'; // Asegúrate de que la ruta es correcta

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pedido = Pedido::obtenerPedido($id);
    
    if ($pedido) {
        // Mostrar detalles del pedido
        echo "<h1>Detalles del Pedido #{$pedido['id']}</h1>";
        echo "<p><strong>Cliente:</strong> {$pedido['cliente']}</p>";
        echo "<p><strong>Producto:</strong> {$pedido['producto']}</p>";
        echo "<p><strong>Cantidad:</strong> {$pedido['cantidad']}</p>";
        echo "<p><strong>Dirección:</strong> {$pedido['direccion']}</p>";
        echo "<p><strong>Estado:</strong> {$pedido['estado']}</p>";
    } else {
        echo "<p>No se encontró el pedido.</p>";
    }
} else {
    echo "<p>ID de pedido no proporcionado.</p>";
}
?>
