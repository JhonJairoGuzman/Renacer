<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Factura - The Renacer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 15px;
        }
        form {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 8px 0;
            font-weight: bold;
            color: #34495e;
        }
        input {
            margin: 8px 0;
            padding: 10px;
            width: calc(100% - 22px);
            border: 2px solid #dfe6e9;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.3s;
        }
        input:focus {
            border-color: #3498db;
        }
        button {
            padding: 12px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #3498db;
            transform: scale(1.05);
        }
        .factura {
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .factura p {
            margin: 6px 0;
            font-size: 14px;
        }
        .factura-cliente, .factura-negocio {
            width: 100%;
            font-size: 12px;
            line-height: 1.4em;
        }
        .factura-negocio {
            margin-top: 10px;
        }
        .print-button {
            margin-top: 20px;
            background-color: #e67e22;
            color: #fff;
        }
        .print-button:hover {
            background-color: #d35400;
        }
        @media print {
            form, .print-button {
                display: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .factura {
                width: 80mm; /* Tamaño aproximado de una impresora de tickets */
                padding: 0;
                border: none;
                box-shadow: none;
                page-break-inside: avoid;
            }
            .factura p {
                font-size: 10px;
                line-height: 1.1em;
            }
        }
    </style>
    <script>
        function imprimirFactura() {
            window.print();
        }
    </script>
</head>
<body>
    <h2>Facturación The Renacer</h2>
    <form action="" method="POST">
        <label for="cliente">Nombre del Cliente:</label>
        <input type="text" id="cliente" name="cliente" required>

        <label for="producto">Producto:</label>
        <input type="text" id="producto" name="producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <label for="precio">Precio Unitario:</label>
        <input type="number" id="precio" name="precio" required>

        <button type="submit">Generar Factura</button>
    </form>

    <?php
    // Verificar si la solicitud es POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir y validar los datos del formulario
        $cliente = isset($_POST['cliente']) ? trim($_POST['cliente']) : null;
        $producto = isset($_POST['producto']) ? trim($_POST['producto']) : null;
        $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : null;
        $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : null;

        // Verificar que los campos no estén vacíos
        if ($cliente && $producto && $cantidad > 0 && $precio > 0) {
            // Calcular el total
            $total = $cantidad * $precio;

            // Mostrar la factura para el cliente
            echo "<div class='factura factura-cliente'>";
            echo "<h2> The Renacer Fast Food</h2>";
            echo "<p><strong>Cliente:</strong> $cliente</p>";
            echo "<p><strong>Producto:</strong> $producto</p>";
            echo "<p><strong>Cantidad:</strong> $cantidad</p>";
            echo "<p><strong>Precio Unitario:</strong> $$precio</p>";
            echo "<p><strong>Total a Pagar:</strong> $$total</p>";
            echo "</div>";

            // Mostrar la factura para el negocio
            echo "<div class='factura factura-negocio'>";
            echo "<h2>Factura  The Renacer</h2>";
            echo "<p><strong>Cliente:</strong> $cliente</p>";
            echo "<p><strong>Producto:</strong> $producto</p>";
            echo "<p><strong>Cantidad:</strong> $cantidad</p>";
            echo "<p><strong>Precio Unitario:</strong> $$precio</p>";
            echo "<p><strong>Total a Pagar:</strong> $$total</p>";
            echo "</div>";

            echo "<button class='print-button' onclick='imprimirFactura()'>Imprimir Factura</button>";
        } else {
            echo "<p>Por favor, completa todos los campos correctamente.</p>";
        }
    } else {
        // Mostrar mensaje si no se envió el formulario
        echo "<p>No se ha enviado el formulario.</p>";
    }
    ?>
</body>
</html>
