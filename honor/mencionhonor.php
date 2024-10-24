<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';

// Datos ficticios para los mejores clientes y trabajador (esto podría provenir de una base de datos)
$mejores_clientes = [
    ['nombre' => 'Isabel Guzman', 'imagen' => 'http://localhost/The_Renacer/img/cliente1.jpeg', 'suma_compras' => 375000],
    ['nombre' => 'Valentina', 'imagen' => 'http://localhost/The_Renacer/img/cliente2.jpeg', 'suma_compras' => 289000],
    ['nombre' => 'Jhon Guzman', 'imagen' => 'http://localhost/The_Renacer/img/cliente3.jpeg', 'suma_compras' => 255000],
];

$mejor_trabajador = [
    'nombre' => 'Adaluz Macea',
    'imagen' => 'http://localhost/The_Renacer/img/trabajador.jpeg',
];


// Función para formatear el valor con comas
function formatearValor($valor) {
    return number_format($valor, 0, ',', '.'); // Formatear con comas
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mención de Honor del Mes</title>
    <link rel="icon" href="Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fffbf0; /* Color de fondo suave */
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center; /* Centramos todo el texto */
        }

        h1, h2 {
            color: #d9534f; /* Rojo vibrante */
            margin-bottom: 20px;
        }

        .top-clientes {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cliente {
            background: #ffecdb; /* Color de fondo claro */
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 90%; /* Ancho de la carta */
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Estilos específicos para cada cliente */
        .cliente.top1 {
            background: #ffdbac; /* Fondo más brillante para el primer lugar */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Sombra más intensa */
        }

        .cliente.top2 {
            background: #ffd3b6; /* Segundo lugar */
        }

        .cliente.top3 {
            background: #ffab91; /* Tercer lugar */
        }

        .cliente img {
            width: 100px; /* Ancho de la imagen */
            height: 100px; /* Alto de la imagen */
            border-radius: 10px; /* Bordes redondeados */
            object-fit: cover; /* Ajustar imagen */
            margin-right: 20px; /* Espacio a la derecha de la imagen */
        }

        .info {
            flex-grow: 1; /* Hacer que la información ocupe el resto del espacio */
        }

        .info h3 {
            margin: 0;
            color: #333;
            font-size: 24px; /* Tamaño de fuente para el nombre */
        }

        .info p {
            margin: 5px 0 0;
            color: #555; /* Color de la suma de compras */
            font-size: 18px; /* Tamaño de fuente para la suma */
        }

        .cliente:hover {
            transform: translateY(-5px); /* Efecto de elevación al pasar el mouse */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .top-trabajador {
            margin-top: 30px;
            text-align: center;
        }

        .trabajador {
            background: #ffe6cc; /* Color de fondo claro */
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 90%; /* Ancho de la carta */
            height: 200px; /* Altura fija para la carta */
            display: flex;
            align-items: center;
            justify-content: center; /* Centrar horizontalmente */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .trabajador img {
            width: 100px; /* Ancho de la imagen */
            height: 100px; /* Alto de la imagen */
            border-radius: 10px; /* Bordes redondeados */
            object-fit: cover; /* Ajustar imagen */
            margin-right: 20px; /* Espacio a la derecha de la imagen */
        }

        .mensaje {
            margin-top: 30px;
            font-size: 18px;
            color: #5a5a5a;
            background: #ffe6cc; /* Fondo suave para el mensaje */
            padding: 15px;
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra del mensaje */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mención de Honor del Mes</h1>

        <div class="top-clientes">
            <h2>Top 3 Mejores Clientes</h2>
            <?php foreach ($mejores_clientes as $index => $cliente): ?>
                <div class="cliente top<?php echo ($index + 1); ?>">
                    <img src="<?php echo htmlspecialchars($cliente['imagen']); ?>" alt="<?php echo htmlspecialchars($cliente['nombre']); ?>">
                    <div class="info">
                        <h3>Top <?php echo ($index + 1); ?>: <?php echo htmlspecialchars($cliente['nombre']); ?></h3>
                        <p>Compras del Mes: $<?php echo formatearValor(htmlspecialchars($cliente['suma_compras'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="top-trabajador">
            <h2>Mejor Trabajador del Mes</h2>
            <div class="trabajador">
                <img src="<?php echo htmlspecialchars($mejor_trabajador['imagen']); ?>" alt="<?php echo htmlspecialchars($mejor_trabajador['nombre']); ?>">
                <div class="info">
                    <h3><?php echo htmlspecialchars($mejor_trabajador['nombre']); ?></h3>
                    <p>¡Felicidades por tu dedicación!</p>
                </div>
            </div>
        </div>

        <div class="mensaje">
            <h2>¡Felicidades a todos!</h2>
            <p>Gracias por su esfuerzo y dedicación. ¡Sigan mejorando para mantenerse en el puesto!</p>
        </div>
    </div>
</body>
</html>
