<?php
session_start();

// Verificar si se ha solicitado cerrar sesión
if (isset($_POST['logout'])) {
    // Destruir la sesión
    session_destroy();
    // Redirigir a bienvenida.php
    header("Location: /The_Renacer/raiz/bienvenida.php");
    exit();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';





// Productos con comas en los precios
$productos = [
    "Hamburguesas" => [
        "sencilla" => "9,000",
        "mini especial" => "11,000",
        "especial" => "15,000",
        "doble carne" => "18,000",
        "ranchera" => "16,000",
        "suiza" => "19,000",
        "bañada en queso" => "13,000",
        "doble bañada en queso" => "20,000",
        "renacer" => "25,000"
    ],
    "Perros Calientes" => [
        "sencillo" => "6,000",
        "mini especial" => "7,000",
        "especial" => "8,000",
        "choriperro" => "10,000",
        "ranchero" => "11,000",
        "suizo" => "13,000",
        "renacer" => "15,000"
    ],
   "Salchipapas" => [
    "sencilla" => "10,000",
    "mini especial" => "13,000",
    "especial" => "16,000",
    "renacer" => "25,000",
    "choripapa sencilla" => "11,000", // Agregada la coma
    "choripapa mini especial" => "14,000", // Agregada la coma
    "choripapa especial" => "18,000", // Agregada la coma
    "choripapa renacer" => "27,000" // Aquí no es necesario agregar coma ya que es el último elemento
],


    "Suizos" => [
        "sencilla" => "14,000",
        "mini especial" => "17,000",
        "especial" => "22,000",
        "renacer" => "28,000",
       
    ],

    "Picadas" => [
        "picada sencilla" => "22,000",
        "especial" => "28,000",
        "3 personas" => "40,000",
        "4 personas" => "55,000",
        "5 personas" => "70,000",
        "6 personas" => "85,000"
    ],
    "Adiciones" => [
        "adicion de papa" => "4,000",
        "queso" => "3,000",
        "pollo" => "5,000",
        "carne de costillitas" => "8,000",
        "chicharrón" => "7,000"
    ]
];


// Procesar el pedido cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pedido'])) {
    $detalles = [];
    $total = 0;

    foreach ($productos as $categoria => $items) {
        foreach ($items as $producto => $precio) {
            $cantidad = (isset($_POST["cantidad_$producto"]) && is_numeric($_POST["cantidad_$producto"])) ? intval($_POST["cantidad_$producto"]) : 0;
            if ($cantidad > 0) {
                $detalles[] = "$producto x $cantidad";
                $total += $cantidad * str_replace(',', '', $precio);
            }
        }
    }

        // Verifica que el total sea mayor a 0 antes de continuar
    if ($total <= 0) {
        echo "<script>alert('Por favor, selecciona al menos un producto.');</script>";
    } else {
        if (!empty($detalles)) {
            $detalle_pedido = implode(", ", $detalles);

         
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renacer - Clientes</title>
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon"> <!-- Ruta corregida para el favicon -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
       body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background: #FFC107; /* Color mostaza */
    color: #333;
}

.header {
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    padding: 15px 30px; 
    background-color: #c62828; 
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px; 
}

.header a, .header button {
    text-decoration: none;
    color: #fff;
    font-weight: 700;
    transition: transform 0.3s;
}

.header a:hover, .header button:hover {
    transform: scale(1.05);
}

.welcome-message {
    text-align: center; 
    font-size: 24px; 
    color: #c62828; 
    font-weight: 700;
    padding: 10px 0;
}

.button {
    background-color: #2196F3; 
    color: #fff;
    padding: 12px 25px; 
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 18px; 
    transition: background-color 0.4s, transform 0.4s;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    font-weight: 700;
    display: inline-block;
}

.button:hover {
    background-color: #1976D2; 
    transform: translateY(-3px);
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff; /* Fondo blanco para el contenido */
    border-radius: 15px; /* Opcional: bordes redondeados */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Opcional: sombra para el contenedor */
}

h2 {
    text-align: center;
    color: #c62828;
    margin-bottom: 15px;
    font-weight: 700;
    text-transform: uppercase;
}

.product-section {
    margin-bottom: 40px;
    padding: 15px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.product {
    margin: 20px 0;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 10px;
    background-color: #fff;
}

.product label {
    display: block;
    margin: 5px 0;
    font-weight: 700;
    color: #333;
}

.product input[type="number"] {
    width: 60px;
    padding: 5px;
    margin-left: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    text-align: center;
}

.cart {
    margin-top: 30px;
    text-align: center;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.cart h2 {
    margin-bottom: 15px;
    color: #c62828;
}

.payment-info {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    background-color: #c62828;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

.action-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-around;
}

.action-buttons form {
    display: inline-block;
}

    </style>
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css"> <!-- Asegúrate de tener el archivo de estilos -->
    <title>Tu Pedido</title>
    <style>
        /* Estilo para la alerta */
        .alert {
            display: none; /* Oculto por defecto */
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336; /* Color de fondo rojo */
            color: white; /* Color del texto */
            padding: 15px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            z-index: 1000; /* Apilar sobre otros elementos */
            animation: fadeIn 0.5s, fadeOut 0.5s 2.5s; /* Animaciones */
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeOut {
            from {opacity: 1;}
            to {opacity: 0;}
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css"> <!-- Asegúrate de tener el archivo de estilos -->
    <title>Tu Pedido</title>
    <style>
        /* Estilo para la alerta */
        .alert {
            display: none; /* Oculto por defecto */
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336; /* Color de fondo rojo */
            color: white; /* Color del texto */
            padding: 15px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            z-index: 1000; /* Apilar sobre otros elementos */
            animation: fadeIn 0.5s, fadeOut 0.5s 3s; /* Animaciones */
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeOut {
            from {opacity: 1;}
            to {opacity: 0;}
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="/The_Renacer/productos/ver_productos.php" class="button">Ver Productos</a>
        <form method="post" action="">
            <button type="submit" name="logout" class="button">Cerrar Sesión</button>
        </form>
        <a href="/The_Renacer/honor/mencionhonor.php" class="button">Mención de Honor del Mes</a>
    </div>

    <div class="welcome-message">
        ¡Bienvenido, <?php echo $nombre_usuario; ?>!
    </div>

    <div class="container">
        <?php foreach ($productos as $categoria => $items): ?>
            <div class="product-section">
                <h2><?php echo $categoria; ?></h2>
                <?php foreach ($items as $producto => $precio): ?>
                    <div class="product">
                        <label>
                            <?php echo ucfirst($producto) . " - $" . $precio; ?>
                            <input type="number" name="cantidad_<?php echo $producto; ?>" min="0" placeholder="0" data-precio="<?php echo str_replace(',', '.', $precio); ?>">
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div class="cart">
            <h2>Tu Pedido</h2>
            <div id="carrito"></div>
            <div class="payment-info">
                Total: $<span id="total">0.00</span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="#" id="enviar-whatsapp" class="button">Enviar Pedido</a>
            <form action="Seguimiento_pedido.php" method="get">
                <button type="submit" class="button">Rastrear Pedido</button>
            </form>
        </div>
    </div>

    <!-- Alerta de confirmación -->
    <div id="alert" class="alert">Pedido realizado. Se está enviando a WhatsApp...</div>

    <script>
        const productos = document.querySelectorAll('input[type="number"]');
        const carritoDiv = document.getElementById('carrito');
        const totalSpan = document.getElementById('total');
        const alertDiv = document.getElementById('alert');
        let total = 0;
        let pedido = "";

        productos.forEach(producto => {
            producto.addEventListener('input', () => {
                const cantidad = parseInt(producto.value) || 0;
                const precio = parseFloat(producto.dataset.precio);

                const previo = document.getElementById('item-' + producto.name);
                if (previo) {
                    const cantidadPrevia = parseInt(previo.dataset.cantidad);
                    total -= cantidadPrevia * precio;
                    previo.remove();
                }

                if (cantidad > 0) {
                    total += cantidad * precio;
                    carritoDiv.innerHTML += `<p id="item-${producto.name}" data-cantidad="${cantidad}">${producto.name.replace('cantidad_', '')} x${cantidad} - $${(cantidad * precio).toFixed(2)}</p>`;
                }

                totalSpan.textContent = total.toFixed(2);
            });
        });

        document.getElementById('enviar-whatsapp').addEventListener('click', function() {
            let mensaje = "Pedido de " + "<?php echo $nombre_usuario; ?>: %0A";
            productos.forEach(producto => {
                const cantidad = parseInt(producto.value) || 0;
                if (cantidad > 0) {
                    const nombreProducto = producto.name.replace('cantidad_', '');
                    const precio = parseFloat(producto.dataset.precio);
                    mensaje += `${nombreProducto}: ${cantidad} x $${(precio * cantidad).toFixed(2)} %0A`;
                }
            });
            mensaje += "Total: $" + total.toFixed(2);
            
            // Mostrar alerta de confirmación
            alertDiv.style.display = 'block'; // Mostrar la alerta
            setTimeout(() => {
                alertDiv.style.display = 'none'; // Ocultar tras 3 segundos
            }, 3000); // Mantener la alerta visible durante 3 segundos

            // Enviar a WhatsApp después de la alerta
            setTimeout(function() {
                window.open(`https://wa.me/573226155457?text=${mensaje}`);
            }, 3500); // Esperar 3.5 segundos para enviar a WhatsApp
        });
    </script>

</body>
</html>
