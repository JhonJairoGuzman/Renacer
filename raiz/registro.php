<?php
// Incluir archivo de conexión
include_once(__DIR__ . "/../config/conexionbd.php");

// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'] ?? NULL; // Asigna NULL si no se proporciona
    $direccion = $_POST['direccion'] ?? NULL; // Asigna NULL si no se proporciona
    $rol = $_POST['rol'] ?? 'cliente'; // Asigna 'cliente' como valor por defecto

    // Validar el correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "El formato de correo no es válido.";
        exit();
    }

    // Encriptar la contraseña antes de almacenarla
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    try {
        if ($rol == 'empleado') {
            // Si el rol es empleado, se debe especificar el tipo de empleado y salario
            $salario = $_POST['salario'] ?? NULL;
            $puesto = $_POST['puesto'] ?? NULL;

            if (!$salario || !$puesto) {
                throw new Exception("Debe especificar el salario y el puesto del empleado.");
            }

            // Insertar en la tabla empleado
            $stmt = $conexion->prepare("INSERT INTO empleados (nombre, correo, password, salario, puesto, telefono, direccion) VALUES (:nombre, :correo, :password, :salario, :puesto, :telefono, :direccion)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':salario', $salario);
            $stmt->bindParam(':puesto', $puesto);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();

        } elseif ($rol == 'cliente') {
            // Inicializar compras en 0 y establecer la fecha de última compra a NULL
            $compras = 0;
            $fecha_ultima_compra = NULL;

            // Insertar en la tabla cliente
            $stmt = $conexion->prepare("INSERT INTO clientes (nombre, correo, password, telefono, direccion, compras, fecha_ultima_compra) VALUES (:nombre, :correo, :password, :telefono, :direccion, :compras, :fecha_ultima_compra)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':compras', $compras);
            $stmt->bindParam(':fecha_ultima_compra', $fecha_ultima_compra);
            $stmt->execute();

        } elseif ($rol == 'administrador') {
            // Insertar en la tabla administrador
            $stmt = $conexion->prepare("INSERT INTO administradores (nombre, correo, password, telefono, direccion) VALUES (:nombre, :correo, :password, :telefono, :direccion)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();
        }

        // Redirigir a login.php después del registro exitoso
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Renacer fast food</title>
    <link rel="icon" href="LOGO_Workplace.png" type="image/x-icon">
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../img/Login.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .link {
            text-align: center;
            margin-top: 10px;
        }
        .form-group#salario_group, .form-group#puesto_group {
            display: none; /* Ocultar inicialmente */
        }
    </style>

    <script>
        function mostrarCamposEmpleado() {
            var rol = document.getElementById('rol').value;
            var salarioGroup = document.getElementById('salario_group');
            var puestoGroup = document.getElementById('puesto_group');
            if (rol === 'empleado') {
                salarioGroup.style.display = 'block';
                puestoGroup.style.display = 'block';
            } else {
                salarioGroup.style.display = 'none';
                puestoGroup.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <form method="post" action="registro.php">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" onchange="mostrarCamposEmpleado()">
                    <option value="cliente">Cliente</option>
                    <option value="empleado">Empleado</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <!-- Campos adicionales para empleado -->
            <div class="form-group" id="salario_group">
                <label for="salario">Salario</label>
                <input type="number" id="salario" name="salario" step="0.01">
            </div>
            <div class="form-group" id="puesto_group">
                <label for="puesto">Puesto</label>
                <select id="puesto" name="puesto">
                    <option value="">Seleccione un puesto</option>
                    <option value="planchero">Planchero</option>
                    <option value="contadora">Contadora</option>
                    <option value="inventario">Inventario</option>
                    <option value="domicilio">Domicilio</option>
                    <option value="mesera">Mesera</option>
                </select>
            </div>
            <button type="submit" class="button">Registrarse</button>
        </form>
        <div class="link">
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
