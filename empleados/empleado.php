<?php
// Definición de la clase Empleado
class Empleado {
    public $nombre;
    public $rol;
    public $salario;

    public function __construct($nombre, $rol, $salario) {
        $this->nombre = $nombre;
        $this->rol = $rol;
        $this->salario = $salario;
    }
}

// Creación de los empleados
$empleados = [
    new Empleado("Empleado 1", "Contable", 1000000), // Salario fijo
    new Empleado("Empleado 2", "Encargado de Inventario", 900000), // Salario fijo
    new Empleado("Empleado 3", "Mesera", 800000), // Salario fijo
    new Empleado("Empleado 4", "Planchero", 750000), // Salario fijo
    new Empleado("Empleado 5", "Domiciliario", 0) // Salario variable
];

// Manejo de la redirección según el rol seleccionado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleadoSeleccionado = $_POST['empleado'];
    switch ($empleadoSeleccionado) {
        case 'Contable':
            header('Location: contadora.php');
            exit;
        case 'Encargado de Inventario':
            header('Location: inventario.php');
            exit;
        case 'Mesera':
            header('Location: mesera.php');
            exit;
        case 'Planchero':
            header('Location: planchero.php');
            exit;
        case 'Domiciliario':
            header('Location: domiciliario.php');
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Empleado</title>
    <link rel="icon" href="Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #4a90e2;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        select:focus {
            border-color: #4a90e2;
            outline: none;
        }

        button {
            background-color: #4a90e2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #357ab7;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>Seleccione su Cargo</h1>
    <form method="post" action="">
        <label for="empleado">Selecciona tu empleado:</label>
        <select name="empleado" id="empleado" required>
            <?php
            foreach ($empleados as $empleado) {
                echo "<option value=\"{$empleado->rol}\">{$empleado->nombre} - {$empleado->rol}</option>";
            }
            ?>
        </select>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
