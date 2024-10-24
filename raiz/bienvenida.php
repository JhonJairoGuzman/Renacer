<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Renacer Fast Food</title>
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon"> <!-- Ruta corregida para el favicon -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Fuentes elegantes -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Roboto', sans-serif; /* Fuente moderna */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Imagen de fondo */
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../img/bienvenida.jpg'); /* Ruta corregida */
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        /* Contenedor principal */
        .container {
            background-color: rgba(255, 235, 59, 0.5); /* Fondo mostaza semitransparente */
            border-radius: 15px;
            padding: 30px;
            box-sizing: border-box;
            text-align: center;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Sombra para resaltar el contenedor */
            z-index: 1;
            opacity: 0; /* Estado inicial para animación */
            transform: translateY(20px); /* Posición inicial para animación */
            animation: fadeInUp 1.5s ease forwards;
        }

        /* Animación del contenedor */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 30px;
            margin-bottom: 20px;
            color: #d32f2f; /* Rojo vibrante */
            font-weight: bold;
            text-transform: uppercase;
        }

        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 30px;
            font-style: italic;
        }

        /* Grupo de botones */
        .button-group {
            display: flex;
            justify-content: space-between;
        }

        /* Estilo de botones */
        .button {
            padding: 12px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #000000;
            border: 2px solid #d32f2f;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            width: 48%;
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #d32f2f;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .button-registrarse {
            background-color: #ffeb3b;
            border-color: #ffeb3b;
            color: #333;
        }

        .button-registrarse:hover {
            background-color: #d32f2f;
            color: #ffffff;
        }

        @media (max-width: 600px) {
            .button-group {
                flex-direction: column;
            }

            .button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Imagen de fondo -->
    <div class="background-image"></div>
    
    <!-- Contenedor principal -->
    <div class="container">
        <h1>Renacer Fast Food</h1>
        <p>"Es tu destino ideal para disfrutar de la mejor comida rápida en Colombia. 
        Ofrecemos un menú variado y delicioso que incluye hamburguesas jugosas,
        salchipapas crujientes, perros calientes con todo el sabor, y nuestras famosas
        picadas, perfectas para compartir."</p>
        <div class="button-group">
            <a href="login.php" class="button">Iniciar Sesión</a>
            <a href="registro.php" class="button button-registrarse">Registrarse</a>
        </div>
    </div>
</body>
</html>
