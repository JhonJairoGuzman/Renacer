<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Atención del Planchero</title>
    <link rel="icon" href="Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4a90e2;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #4a90e2;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #357ab7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #4a90e2;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Registro de Atención del Planchero</h1>

    <div class="container">
        <form id="formulario-planchero">
            <label for="planchero-nombre">Nombre del Planchero:</label>
            <input type="text" id="planchero-nombre" placeholder="Nombre del planchero" required>

            <label for="vestimenta">Vestimenta Acordada:</label>
            <select id="vestimenta" required>
                <option value="">--Seleccionar--</option>
                <option value="Cumple">Cumple</option>
                <option value="No Cumple">No Cumple</option>
            </select>

            <label for="tiempo-preparacion">Tiempo de Preparación (minutos):</label>
            <input type="number" id="tiempo-preparacion" placeholder="Minutos" required>

            <label for="gustos-clientes">¿Gusta a los Clientes?</label>
            <select id="gustos-clientes" required>
                <option value="">--Seleccionar--</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>

            <label for="observaciones">Observaciones sobre la Comida:</label>
            <textarea id="observaciones" rows="3" placeholder="Escribe observaciones aquí..."></textarea>

            <button type="submit">Registrar Atención</button>
        </form>

        <table id="tabla-plancheros">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Vestimenta</th>
                    <th>Tiempo de Preparación</th>
                    <th>Gusto de Clientes</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los registros de atención aparecerán aquí -->
            </tbody>
        </table>
    </div>

    <script>
        // Variables para manejar el formulario y la tabla
        const formularioPlanchero = document.getElementById('formulario-planchero');
        const tablaPlancheros = document.getElementById('tabla-plancheros').getElementsByTagName('tbody')[0];

        // Función para agregar atención del planchero
        formularioPlanchero.addEventListener('submit', function(event) {
            event.preventDefault();

            const nombre = document.getElementById('planchero-nombre').value;
            const vestimenta = document.getElementById('vestimenta').value;
            const tiempoPreparacion = document.getElementById('tiempo-preparacion').value;
            const gustosClientes = document.getElementById('gustos-clientes').value;
            const observaciones = document.getElementById('observaciones').value;

            // Obtener la fecha actual
            const fechaActual = new Date().toLocaleDateString();

            // Crear una nueva fila en la tabla
            const nuevaFila = tablaPlancheros.insertRow();
            nuevaFila.insertCell(0).textContent = fechaActual;
            nuevaFila.insertCell(1).textContent = nombre;
            nuevaFila.insertCell(2).textContent = vestimenta;
            nuevaFila.insertCell(3).textContent = tiempoPreparacion;
            nuevaFila.insertCell(4).textContent = gustosClientes;
            nuevaFila.insertCell(5).textContent = observaciones;

            // Limpiar el formulario
            formularioPlanchero.reset();
        });
    </script>

</body>
</html>
