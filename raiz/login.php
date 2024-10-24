<?php
// Incluir archivo de conexión
include_once(__DIR__ . "/../config/conexionbd.php");

// Iniciar sesión
session_start();

$error = ''; // Inicializar la variable de error

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $puestoIngresado = isset($_POST['puesto']) ? trim($_POST['puesto']) : '';  // Puesto seleccionado por el usuario

    // Validar que no haya campos vacíos
    if (empty($nombre) || empty($correo) || empty($password) || empty($puestoIngresado)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Definir las tablas según el puesto
        switch ($puestoIngresado) {
            case 'cliente':
                $tabla = 'clientes';
                break;
            case 'empleado':
                $tabla = 'empleados';
                break;
            case 'admin':
                $tabla = 'administradores';  // Tabla de administradores
                break;
            default:
                $error = "Puesto desconocido.";
                break;
        }

        if (empty($error)) {
            // Consultar el usuario en la tabla correspondiente
            $stmt = $conexion->prepare("SELECT id, password FROM $tabla WHERE nombre = :nombre AND correo = :correo");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Obtener los datos del usuario
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $row['password'];

                // Verificar la contraseña ingresada
                if (password_verify($password, $hashed_password)) {
                    // Autenticación exitosa
                    $_SESSION['usuario_id'] = $row['id'];  // Guardar información del usuario en la sesión
                    $_SESSION['puesto'] = $puestoIngresado;  // Guardar el puesto del usuario en la sesión
                    $_SESSION['nombre'] = $nombre;  // Guardar el nombre del usuario en la sesión

                    // Redirigir según el puesto del usuario
                    switch ($puestoIngresado) {
                        case 'cliente':
                            header("Location: /The_Renacer/productos/renacer.php");
                            break;
                        case 'empleado':
                            header("Location: /The_Renacer/empleados/empleado.php");
                            break;
                        case 'admin':
                            header("Location: /The_Renacer/admin/administrador.php");
                            break;
                        default:
                            $error = "Puesto desconocido.";
                    }
                    exit();
                } else {
                    $error = "Usuario o contraseña incorrectos.";
                }
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Renacer Fast Food</title>
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../img/Login.jpg'); /* Ruta corregida */
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: rgba(0, 0, 0, 0.9);
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            color: rgba(0, 0, 0, 0.9);
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #00aaff;
        }

        .button {
            background-color: #00aaff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #0077cc;
            transform: translateY(-2px);
        }

        .error {
            color: #d9534f;
            margin-top: 10px;
        }

        .link {
            margin-top: 20px;
            font-size: 14px;
        }

        .link a {
            color: #00aaff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="puesto">Puesto</label>
                <select id="puesto" name="puesto" required>
                    <option value="">Seleccione su puesto</option>
                    <option value="cliente">Cliente</option>
                    <option value="empleado">Empleado</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button type="submit" class="button">Ingresar</button>
        </form>
        <div class="link">
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
