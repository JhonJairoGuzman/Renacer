<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pedido = Pedido::obtenerPedido($id);
    
    if ($pedido) {
        // Mostrar detalles del pedido
        echo "<h1>Pedido #{$pedido['id']}</h1>";
        echo "<p><strong>Cliente:</strong> {$pedido['cliente']}</p>";
        echo "<p><strong>Producto:</strong> {$pedido['producto']}</p>";
        echo "<p><strong>Cantidad:</strong> {$pedido['cantidad']}</p>";
        echo "<p><strong>Dirección:</strong> {$pedido['direccion']}</p>";
        echo "<p><strong>Estado:</strong> {$pedido['estado']}</p>";
        echo "<a href='ver_detalles.php?id={$pedido['id']}' class='btn btn-elegante'>Ver Detalles</a>";
    } else {
        echo "<p>No se encontró el pedido con el ID especificado.</p>";
    }
} else {
    echo "<p>No se proporcionó ningún ID de pedido.</p>";
}
?>
