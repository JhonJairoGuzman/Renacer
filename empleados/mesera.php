<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Atención de Meseras</title>
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

    <h1>Registro de Atención de Meseras</h1>

    <div class="container">
        <form id="formulario-mesera">
            <label for="mesera-nombre">Nombre de la Mesera:</label>
            <input type="text" id="mesera-nombre" placeholder="Nombre de la mesera" required>

            <label for="mesas-atendidas">Mesas Atendidas:</label>
            <input type="number" id="mesas-atendidas" placeholder="Número de mesas" required>

            <label for="calificacion">Calificación:</label>
            <select id="calificacion" required>
                <option value="">--Seleccionar--</option>
                <option value="Excelente">Excelente</option>
                <option value="Bien">Bien</option>
                <option value="Regular">Regular</option>
                <option value="Malo">Malo</option>
            </select>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" rows="3" placeholder="Escribe observaciones aquí..."></textarea>

            <label for="llamado-atencion">Llamados de Atención:</label>
            <textarea id="llamado-atencion" rows="3" placeholder="Escribe los llamados de atención aquí..."></textarea>

            <button type="submit">Registrar Atención</button>
        </form>

        <table id="tabla-meseras">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Mesas Atendidas</th>
                    <th>Calificación</th>
                    <th>Observaciones</th>
                    <th>Llamados de Atención</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los registros de atención aparecerán aquí -->
            </tbody>
        </table>
    </div>

    <script>
        // Variables para manejar el formulario y la tabla
        const formularioMesera = document.getElementById('formulario-mesera');
        const tablaMeseras = document.getElementById('tabla-meseras').getElementsByTagName('tbody')[0];

        // Función para agregar atención de la mesera
        formularioMesera.addEventListener('submit', function(event) {
            event.preventDefault();

            const nombre = document.getElementById('mesera-nombre').value;
            const mesasAtendidas = document.getElementById('mesas-atendidas').value;
            const calificacion = document.getElementById('calificacion').value;
            const observaciones = document.getElementById('observaciones').value;
            const llamadoAtencion = document.getElementById('llamado-atencion').value;

            // Obtener la fecha actual
            const fechaActual = new Date().toLocaleDateString();

            // Crear una nueva fila en la tabla
            const nuevaFila = tablaMeseras.insertRow();
            nuevaFila.insertCell(0).textContent = fechaActual;
            nuevaFila.insertCell(1).textContent = nombre;
            nuevaFila.insertCell(2).textContent = mesasAtendidas;
            nuevaFila.insertCell(3).textContent = calificacion;
            nuevaFila.insertCell(4).textContent = observaciones;
            nuevaFila.insertCell(5).textContent = llamadoAtencion;

            // Limpiar el formulario
            formularioMesera.reset();
        });
    </script>

</body>
</html>
