<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Productos con imágenes e ingredientes
$productos = [
    "Hamburguesas" => [
        ["nombre" => "sencilla", "precio" => 9000, "imagen" => "/The_Renacer/img/hamburguesaSencilla.png", "ingredientes" => "Pan hamburguesa, Carne artesanal, Queso mozarrella, Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "mini especial", "precio" => 11000, "imagen" => "/The_Renacer/img/mini_especial.jpg", "ingredientes" => "Pan hamburguesa, Carne artesanal, Queso mozarrella, Jamon, Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "especial", "precio" => 15000, "imagen" => "/The_Renacer/img/hamburguesaEspecial.jpg", "ingredientes" => "Pan hamburguesa, Carne artesanal, Queso mozarrella, Papas, Jamon, Tocineta Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "doble carne", "precio" => 18000, "imagen" => "/The_Renacer/img/doble_carne.jpg", "ingredientes" => "Pan hamburguesa,  2 Carne artesanal, Queso mozarrella, Jamon, Tocineta, Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "ranchera", "precio" => 16000, "imagen" => "/The_Renacer/img/ranchera.jpg", "ingredientes" => "Pan hamburguesa, Ranchera, Queso mozarrella, Jamon, Tocineta Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "suiza", "precio" => 19000, "imagen" => "/The_Renacer/img/suiza.jpg", "ingredientes" => "Pan hamburguesa, Suiza, Queso mozarrella, Jamon, Tocineta Lechuga, Tomate, cebolla ,Salsas"],
        ["nombre" => "bañada en queso", "precio" => 13000, "imagen" => "/The_Renacer/img/banada_queso.jpg", "ingredientes" => "Pan hamburguesa, carne artesanal, Queso mozarrella, queso derretido + jamon en cuadros, Jamon, Tocineta Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "doble bañada en queso", "precio" => 20000, "imagen" => "/The_Renacer/img/doble_banada_queso.jpg", "ingredientes" => "Pan hamburguesa, 2 carne artesanal, Queso mozarrella, queso derretido + jamon en cuadros, Jamon, Tocineta Lechuga, Tomate, cebolla, Salsas"],
        ["nombre" => "renacer", "precio" => 25000, "imagen" => "/The_Renacer/img/renacer.jpg", "ingredientes" => "Pan hamburguesa, 3 carne artesanal, Queso mozarrella, queso derretido + jamon en cuadros, Jamon, Tocineta Lechuga, Tomate, cebolla, Salsas"]
    ],
    
    "Perros Calientes" => [
        ["nombre" => "sencillo", "precio" => 6000, "imagen" => "/The_Renacer/img/perro_sencillo.jpg", "ingredientes" => "Pan perro, Salchicha, ripio, lechuga, Queso, Salsas"],
        ["nombre" => "mini especial", "precio" => 7000, "imagen" => "/The_Renacer/img/perro_mini_especial.jpg", "ingredientes" => "Pan perro, Salchicha, ripio, lechuga, cebolla, jamon, Queso, Salsas"],
        ["nombre" => "especial", "precio" => 8000, "imagen" => "/The_Renacer/img/perro_especial.jpg", "ingredientes" => "Pan perro, Salchicha, ripio, lechuga, cebolla, jamon, tocineta Queso, Salsas"],
        ["nombre" => "choriperro", "precio" => 10000, "imagen" => "/The_Renacer/img/choriperro.jpg", "ingredientes" => "Pan perro, Chorizo, ripio, lechuga, cebolla, jamon, tocineta Queso, Salsas"],
        ["nombre" => "ranchero", "precio" => 11000, "imagen" => "/The_Renacer/img/perro_ranchero.jpg", "ingredientes" => "Pan perro, Ranchera, ripio, lechuga, cebolla, jamon, tocineta Queso, Salsas"],
        ["nombre" => "suizo", "precio" => 13000, "imagen" => "/The_Renacer/img/perro_suizo.jpg", "ingredientes" => "Pan perro, Suiza, ripio, lechuga, cebolla, jamon, tocineta Queso, Salsas"],
        ["nombre" => "renacer", "precio" => 15000, "imagen" => "/The_Renacer/img/perro_renacer.jpg", "ingredientes" => "Pan perro, salchicha, pollo, maiz, ripio, lechuga, cebolla, jamon, tocineta Queso, Salsas"]
    ],
    
    "Salchipapas" => [
        ["nombre" => "sencilla", "precio" => 10000, "imagen" => "/The_Renacer/img/salchipapa_sencilla.jpg", "ingredientes" => "Papas Fritas, Salchicha, Ripio, queso costeño, lechuga, Salsas"],
        ["nombre" => "mini especial", "precio" => 13000, "imagen" => "/The_Renacer/img/salchipapa_mini_especial.jpg", "ingredientes" => "Papas Fritas, Salchicha, Ripio, lomo de cerdo, queso costeño, lechuga, Salsas"],
        ["nombre" => "especial", "precio" => 16000, "imagen" => "/The_Renacer/img/salchipapa_especial.jpg", "ingredientes" => "Papas Fritas, Salchicha, Ripio, lomo de cerdo, lechuga, queso costeño, Salsas"],
        ["nombre" => "renacer", "precio" => 25000, "imagen" => "/The_Renacer/img/salchipapa_renacer.jpg", "ingredientes" => "Papas Fritas, Salchicha, Ripio, lomo de cerdo, queso mozarrella, tocineta lechuga, Salsas"],
        ["nombre" => "choripapa sencilla", "precio" => 11000, "imagen" => "/The_Renacer/img/choripapa.jpg", "ingredientes" => "Papas Fritas, Salchicha, Ripio, lomo de cerdo, pollo, queso mozarella, lechuga, Salsas"],
        ["nombre" => "choripapa-mini especial", "precio" => 14000, "imagen" => "/The_Renacer/img/choripapa.jpg", "ingredientes" => "Papas Fritas, Chorizo, Queso costeño, cebolla, lechuga, Salsas"],
        ["nombre" => "choripapa-especial", "precio" => 18000, "imagen" => "/The_Renacer/img/choripapa.jpg", "ingredientes" => "Papas Fritas, Chorizo, Queso, lomo de cerdo, Tocineta, Salsas"],
        ["nombre" => "choripapa-renacer", "precio" => 27000, "imagen" => "/The_Renacer/img/choripapa.jpg", "ingredientes" => "Papas Fritas, Chorizo, lomo de cerdo, Queso mozarella, pollo, maiz, Tocineta, Salsas"]
    ],
 
    "Suizos" => [
        ["nombre" => "suizo sencillo", "precio" => 14000, "imagen" => "/The_Renacer/img/suizo_sencillo.jpg", "ingredientes" => "Pan, Queso costeño, Suiza, cebolla, lechuga, Salsas"],
        ["nombre" => "suizo mini especial", "precio" => 17000, "imagen" => "/The_Renacer/img/suizo_mini_especial.jpg", "ingredientes" => "Pan, Queso costeño, lomo de cerdo, Suiza, lechuga, cebolla, Salsas"],
        ["nombre" => "suizo especial", "precio" => 22000, "imagen" => "/The_Renacer/img/suizo_especial.jpg", "ingredientes" => "Pan, Queso mozarella, lomo de cerdo, Suiza, cebolla, lechuga, Salsas"],
        ["nombre" => "suizo renacer", "precio" => 28000, "imagen" => "/The_Renacer/img/suizo_renacer.jpeg", "ingredientes" => "Pan, Queso mozarrella,lomo de cerdo, patacon, Suiza, lechuga, cebolla, Salsas"]
    ],
  
    "Picadas" => [
        ["nombre" => "picada sencilla", "precio" => 22000, "imagen" => "/The_Renacer/img/picada_sencilla.jpg", "ingredientes" => "papas, lomo cerdo, lechuga, cebolla, ripio, queso costeño, salsas"],
        ["nombre" => "picada Especial", "precio" => 28000, "imagen" => "/The_Renacer/img/picada_especial.jpg", "ingredientes" => "papas, lomo cerdo, pechuga, butufarra, lechuga, cebolla, ripio, queso costeño, salsas"],
        ["nombre" => "picada 3 personas", "precio" => 40000, "imagen" => "/The_Renacer/img/picada_3_personas.jpg", "ingredientes" => "papas, lomo cerdo, pechuga, butufarra, chorizo, ranchera, lechuga, cebolla, ripio, queso costeño, salsas"],
        ["nombre" => "picada 4 personas", "precio" => 55000, "imagen" => "/The_Renacer/img/picada_4_personas.jpg", "ingredientes" => "papas, lomo cerdo, pechuga, carne de res, butufarra, chorizo, ranchera,suiza, lechuga, cebolla, ripio, queso costeño, salsas"],
        ["nombre" => "picada 5 personas", "precio" => 70000, "imagen" => "/The_Renacer/img/picada_5_personas.jpg", "ingredientes" => "papas, lomo cerdo, pechuga, carne de res, costillitas,  butufarra, chorizo, ranchera,suiza, lechuga, cebolla, ripio, queso mozarrella, salsas"],
        ["nombre" => "picada 6 personas", "precio" => 85000, "imagen" => "/The_Renacer/img/picada_6_personas.jpg", "ingredientes" => "papas, lomo cerdo, pechuga, carne de res, chicharron, butufarra, chorizo, ranchera,suiza, lechuga, cebolla, ripio, queso mozarrella, salsas"]

    ]
];
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Renacer - Menú</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4; /* Color de fondo suave */
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Evitar el desplazamiento horizontal */
        }
        
        h1 {
            text-align: center;
            color: #2c3e50; /* Color oscuro para el encabezado */
            margin: 20px 0;
            font-size: 3em; /* Tamaño de fuente más grande */
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: fadeIn 1s; /* Animación de entrada */
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            max-width: 1200px; /* Ancho máximo para el menú */
            margin: auto; /* Centrar el menú */
        }
        
        .categoria {
            margin: 30px 0;
            width: 100%;
            border-bottom: 4px solid #e74c3c; /* Línea de separación colorida */
            padding-bottom: 10px;
            position: relative; /* Posicionamiento relativo para el efecto */
        }

        .categoria h2 {
            color: #e74c3c;
            font-size: 2.5em; /* Tamaño más grande para categorías */
            margin-bottom: 10px;
            text-transform: capitalize;
            position: relative;
            animation: slideIn 0.5s forwards; /* Animación de entrada */
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .producto {
            display: flex;
            align-items: center;
            background-color: #ffffff; /* Fondo blanco para productos */
            border-radius: 12px;
            padding: 15px;
            margin: 15px 0;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil */
        }
        
        .producto:hover {
            transform: translateY(-5px); /* Sutil movimiento al hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Sombra más fuerte al hover */
        }

        .producto img {
            width: 120px; /* Ancho de imagen */
            height: auto; /* Altura automática */
            border-radius: 8px; /* Bordes redondeados para imágenes */
            margin-right: 20px; /* Espacio entre imagen y texto */
            transition: transform 0.3s; /* Animación de imagen */
        }

        .producto:hover img {
            transform: scale(1.05); /* Escalar imagen al hover */
        }

        .detalles {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .nombre {
            font-weight: 500; /* Negrita para el nombre del producto */
            font-size: 1.5em; /* Tamaño de fuente del nombre */
            color: #34495e; /* Color para el nombre del producto */
        }

        .precio {
            font-size: 1.2em; /* Tamaño de fuente del precio */
            color: #e74c3c; /* Color para el precio */
            margin: 5px 0;
        }

        .ingredientes {
            font-size: 0.9em; /* Tamaño de fuente para ingredientes */
            color: #7f8c8d; /* Color para ingredientes */
        }
    </style>
</head>
<body>

    <h1>Menú de The Renacer</h1>

    <div class="menu">
        <?php foreach ($productos as $categoria => $items): ?>
            <div class="categoria">
                <h2><?php echo $categoria; ?></h2>
            </div>
            <?php foreach ($items as $producto): ?>
                <div class="producto">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <div class="detalles">
                        <div class="nombre"><?php echo ucfirst($producto['nombre']); ?></div>
                        <div class="precio">$<?php echo number_format($producto['precio']); ?></div>
                        <div class="ingredientes"><?php echo $producto['ingredientes']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>

</body>
</html>
