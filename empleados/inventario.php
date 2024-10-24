<?php
// Conexión a la base de datos
include_once(__DIR__ . "/../config/conexionbd.php");

// Verificar que la conexión se haya realizado correctamente
if (!$conexion) {
    die("Conexión fallida: No se pudo establecer conexión a la base de datos.");
}

// Manejo de formularios
$mensaje = ''; // Variable para mensajes
$tipo_mensaje = ''; // Variable para el tipo de mensaje (success o error)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Agregar producto al inventario
        $nombre_producto = $_POST['nombre_producto'];
        $valor = $_POST['valor'];
        $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0; // Asegurarse de que 'cantidad' esté definido

        try {
            // Verificar si el producto ya existe
            $stmt = $conexion->prepare("SELECT * FROM inventario WHERE nombre_producto = ?");
            $stmt->execute([$nombre_producto]);
            $producto_existente = $stmt->fetch();

            if ($producto_existente) {
                // Si el producto ya existe, actualizar la cantidad
                $nueva_cantidad = $producto_existente['cantidad'] + $cantidad;
                $stmt = $conexion->prepare("UPDATE inventario SET cantidad = ?, valor = ? WHERE id = ?");
                if ($stmt->execute([$nueva_cantidad, $valor, $producto_existente['id']])) {
                    $mensaje = "Cantidad actualizada exitosamente.";
                    $tipo_mensaje = "success";
                } else {
                    $mensaje = "Error al actualizar la cantidad.";
                    $tipo_mensaje = "error";
                }
            } else {
                // Si no existe, añadir el nuevo producto
                $stmt = $conexion->prepare("INSERT INTO inventario (nombre_producto, valor, cantidad, fecha) VALUES (?, ?, ?, NOW())");
                if ($stmt->execute([$nombre_producto, $valor, $cantidad])) {
                    $mensaje = "Producto añadido exitosamente.";
                    $tipo_mensaje = "success";
                } else {
                    $mensaje = "Error al añadir el producto.";
                    $tipo_mensaje = "error";
                }
            }
        } catch (PDOException $e) {
            $mensaje = "Error: " . $e->getMessage();
            $tipo_mensaje = "error";
        }

        // Redirigir para evitar la duplicación de productos
        header("Location: inventario.php");
        exit();
    } elseif (isset($_POST['delete'])) {
        // Eliminar producto del inventario
        $id = $_POST['id'];

        try {
            // Preparar la consulta para eliminar el producto usando PDO
            $stmt = $conexion->prepare("DELETE FROM inventario WHERE id = ?");
            if ($stmt->execute([$id])) {
                $mensaje = "Producto eliminado exitosamente.";
                $tipo_mensaje = "success";
            } else {
                $mensaje = "Error al eliminar el producto.";
                $tipo_mensaje = "error";
            }
        } catch (PDOException $e) {
            $mensaje = "Error: " . $e->getMessage();
            $tipo_mensaje = "error";
        }

        // Redirigir para evitar la duplicación de productos
        header("Location: inventario.php");
        exit();
    }
}

// Obtener productos del inventario
try {
    $stmt = $conexion->prepare("SELECT * FROM inventario");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensaje = "Error: " . $e->getMessage();
    $tipo_mensaje = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - The Renacer</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon"> <!-- Ruta corregida para el favicon -->
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Fuente moderna */
            background-color: #f4f7f6; /* Fondo suave y claro */
            color: #333;
            margin: 0;
            padding: 20px;
            transition: background-color 0.3s ease; /* Animación de fondo */
        }
        
        h1 {
            text-align: center;
            color: #ff5733; /* Color llamativo */
            margin-bottom: 30px;
            font-size: 2.5em; /* Tamaño de fuente grande */
            font-weight: bold;
            text-transform: uppercase; /* Letras en mayúsculas para impacto */
        }
        
        form {
            background: #fff;
            padding: 30px;
            border-radius: 12px; /* Esquinas redondeadas */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 600; /* Negrita para etiquetas */
            color: #444; /* Color más suave */
        }
        
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: border 0.3s, box-shadow 0.3s; /* Transición suave */
        }
        
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #ff5733; /* Borde color al enfocar */
            outline: none;
            box-shadow: 0 0 5px rgba(255, 87, 51, 0.5); /* Sombra al enfocar */
        }
        
        button {
            background-color: #ff5733; /* Botón llamativo */
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s; /* Transición */
            font-weight: bold;
        }
        
        button:hover {
            background-color: #e14d28; /* Color más oscuro al pasar el ratón */
            transform: scale(1.05);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background: #fff;
            border-radius: 12px; /* Esquinas redondeadas */
            overflow: hidden; /* Esquinas redondeadas */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            transition: background-color 0.3s;
        }
        
        th {
            background-color: #ff5733; /* Encabezados de color */
            color: white;
            font-weight: 600;
        }
        
        tr:hover td {
            background-color: #f1f1f1; /* Fondo suave al pasar el ratón */
        }
        
        .mensaje {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
            animation: fadeIn 0.5s;
            font-weight: 500;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
    </style>
    <script>
        // Script para el manejo de mensajes de éxito/error
        document.addEventListener('DOMContentLoaded', function() {
            const mensajeDiv = document.getElementById('mensaje');
            if (mensajeDiv) {
                setTimeout(() => {
                    mensajeDiv.style.display = 'none';
                }, 3000); // Oculta el mensaje después de 3 segundos
            }
        });
    </script>
</head>
<body>

    <h1>Inventario de productos</h1>

    <!-- Mensaje de estado -->
    <?php if ($mensaje): ?>
        <div id="mensaje" class="mensaje <?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="nombre_producto">Nombre del producto:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" required>
        
        <label for="valor">Valor del producto:</label>
        <input type="number" id="valor" name="valor" min="0" required>
        
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="0" required>
        
        <button type="submit" name="add">Agregar Producto</button>
    </form>

    <!-- Tabla de inventario -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del producto</th>
                <th>Valor</th>
                <th>Cantidad</th>
                <th>Fecha de ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre_producto']; ?></td>
                    <td><?php echo $producto['valor']; ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($producto['fecha'])); ?></td>
                    <td>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <button type="submit" name="delete" onclick="return confirm('¿Está seguro de eliminar este producto?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        &copy; <?php echo date('Y'); ?> The Renacer. Todos los derechos reservados.
    </footer>
</body>
</html>
