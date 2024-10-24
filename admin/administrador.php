<?php
session_start();
include_once(__DIR__ . "/../config/conexionbd.php");

// Verificar si el usuario es un administrador
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] !== 'admin') {
    // Redirigir a la página de login si no es un administrador
    header("Location: /The_Renacer/login.php");
    exit();
}

// Consultar los empleados y sus salarios en orden alfabético
$empleadosQuery = $conexion->prepare("SELECT nombre, salario, puesto FROM empleados ORDER BY nombre ASC");
$empleadosQuery->execute();
$empleados = $empleadosQuery->fetchAll(PDO::FETCH_ASSOC);

// Consultar los clientes incluyendo el campo 'id'
$clientesQuery = $conexion->prepare("SELECT id, nombre, telefono, direccion FROM clientes");
$clientesQuery->execute();
$clientes = $clientesQuery->fetchAll(PDO::FETCH_ASSOC);

// Consultar compras de los clientes
$comprasQuery = $conexion->prepare("SELECT cliente_id, COUNT(*) AS total_compras, MAX(fecha_compra) AS fecha_ultima_compra FROM compras GROUP BY cliente_id");
$comprasQuery->execute();
$compras = $comprasQuery->fetchAll(PDO::FETCH_ASSOC);

// Organizar las compras por cliente_id para acceder más fácilmente a la información
$comprasPorCliente = [];
foreach ($compras as $compra) {
    $comprasPorCliente[$compra['cliente_id']] = [
        'total_compras' => $compra['total_compras'],
        'fecha_ultima_compra' => $compra['fecha_ultima_compra']
    ];
}

// Consultar productos
$productosQuery = $conexion->prepare("SELECT nombre, precio FROM productos");
$productosQuery->execute();
$productos = $productosQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Incluye tus estilos CSS -->
    <link rel="icon" href="../img/Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f0f4f8, #d9e4f5);
            color: #333;
        }

        header {
            background-color: #4a90e2;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
            animation: fadeInDown 1s ease forwards;
        }

        nav {
            margin-top: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        nav a:hover {
            background: #007bb5;
            transform: scale(1.05);
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease forwards;
        }

        section h2 {
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-size: 1.8em;
            animation: fadeInLeft 0.8s ease forwards;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            animation: fadeIn 1.2s ease forwards;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #4a90e2;
            color: white;
            transition: background 0.3s;
        }

        table th:hover {
            background-color: #007bb5;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
            transition: background 0.3s;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido al Panel de Administrador</h1>
        
        <nav>
            <a href="/The_Renacer/productos/renacer.php">Productos</a>
            <a href="/The_Renacer/empleados/empleado.php">Empleados</a>
            <a href="/The_Renacer/raiz/bienvenida.php">Cerrar sesión</a>
            <a href="/The_Renacer/admin/generar_factura.php">Generar Factura </a>
            
        </nav>
    </header>

    <main>
        <!-- Sección de Productos -->
        <section>
            <h2>Productos de The Renacer</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Sección de Empleados -->
        <section>
            <h2>Hoja de Vida de Empleados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Salario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['puesto']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['salario']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Sección de Clientes -->
        <section>
            <h2>Clientes Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Número</th>
                        <th>Dirección</th>
                        <th>Compras Realizadas</th>
                        <th>Última Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <?php
                        // Obtener el ID del cliente
                        $clienteId = $cliente['id'];
                        
                        // Verificar si existen compras para este cliente
                        $totalCompras = isset($comprasPorCliente[$clienteId]) ? $comprasPorCliente[$clienteId]['total_compras'] : 0;
                        $ultimaCompra = isset($comprasPorCliente[$clienteId]) ? $comprasPorCliente[$clienteId]['fecha_ultima_compra'] : 'No hay compras';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                            <td><?php echo $totalCompras; ?></td>
                            <td><?php echo $ultimaCompra; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
