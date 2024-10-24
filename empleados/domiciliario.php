<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Atención del Domiciliario</title>
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

    <h1>Registro de Atención del Domiciliario</h1>

    <div class="container">
        <form id="formulario-domiciliario">
            <label for="domiciliario-nombre">Nombre del Domiciliario:</label>
            <input type="text" id="domiciliario-nombre" placeholder="Nombre del domiciliario" required>

            <label for="cantidad-domicilios">Cantidad de Domicilios Realizados:</label>
            <input type="number" id="cantidad-domicilios" placeholder="Cantidad de domicilios" required>

            <label for="tiempo-demora">Tiempo de Demora en la Entrega (minutos):</label>
            <input type="number" id="tiempo-demora" placeholder="Minutos" required>

            <label for="calificacion">Calificación del Domicilio:</label>
            <select id="calificacion" required>
                <option value="">--Seleccionar--</option>
                <option value="Excelente">Excelente</option>
                <option value="Bueno">Bueno</option>
                <option value="Regular">Regular</option>
                <option value="Malo">Malo</option>
            </select>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" rows="3" placeholder="Escribe observaciones aquí..."></textarea>

            <button type="submit">Registrar Atención</button>
        </form>

        <table id="tabla-domiciliarios">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Cantidad de Domicilios</th>
                    <th>Tiempo de Demora</th>
                    <th>Calificación</th>
                    <th>Valor Total (COP)</th>
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
        const formularioDomiciliario = document.getElementById('formulario-domiciliario');
        const tablaDomiciliarios = document.getElementById('tabla-domiciliarios').getElementsByTagName('tbody')[0];

        // Valor del domicilio
        const valorDomicilio = 2000;

        // Función para agregar atención del domiciliario
        formularioDomiciliario.addEventListener('submit', function(event) {
            event.preventDefault();

            const nombre = document.getElementById('domiciliario-nombre').value;
            const cantidadDomicilios = document.getElementById('cantidad-domicilios').value;
            const tiempoDemora = document.getElementById('tiempo-demora').value;
            const calificacion = document.getElementById('calificacion').value;
            const observaciones = document.getElementById('observaciones').value;

            // Obtener la fecha actual
            const fechaActual = new Date().toLocaleDateString();

            // Calcular el valor total
            const valorTotal = cantidadDomicilios * valorDomicilio;

            // Crear una nueva fila en la tabla
            const nuevaFila = tablaDomiciliarios.insertRow();
            nuevaFila.insertCell(0).textContent = fechaActual;
            nuevaFila.insertCell(1).textContent = nombre;
            nuevaFila.insertCell(2).textContent = cantidadDomicilios;
            nuevaFila.insertCell(3).textContent = tiempoDemora;
            nuevaFila.insertCell(4).textContent = calificacion;
            nuevaFila.insertCell(5).textContent = valorTotal.toLocaleString(); // Formatear el valor en formato local
            nuevaFila.insertCell(6).textContent = observaciones;

            // Limpiar el formulario
            formularioDomiciliario.reset();
        });
    </script>

</body>
</html>
