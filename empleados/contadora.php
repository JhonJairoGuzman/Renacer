<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Contabilidad</title>
    <link rel="icon" href="Logo_renacer.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 50px;
        }

        h1 {
            margin-bottom: 20px;
            color: #4a90e2;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4a90e2;
            color: white;
        }

        form {
            margin: 20px 0;
            width: 80%;
        }

        input, button, select {
            padding: 10px;
            margin: 5px 0;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4a90e2;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #357ab7;
            transform: scale(1.05);
        }

        .margen {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Área de Contabilidad</h1>

    <form id="formulario-ventas">
        <h2>Registrar Venta</h2>
        <label for="fecha">Fecha de Venta:</label>
        <input type="date" id="fecha" required>

        <label for="producto">Producto Vendido:</label>
        <input type="text" id="producto" placeholder="Nombre del producto" required>
        
        <label for="precio">Precio de Venta:</label>
        <input type="number" id="precio" placeholder="Precio del producto" required>

        <label for="costo">Costo del Producto:</label>
        <input type="number" id="costo" placeholder="Costo del producto" required>

        <label for="caja">Dinero en Caja:</label>
        <input type="number" id="caja" placeholder="Dinero en caja" required>

        <button type="submit">Registrar Venta</button>
    </form>

    <h2>Historial de Ventas</h2>
    <table id="historial-ventas">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Margen de Ganancia</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se llenarán las ventas -->
        </tbody>
    </table>

    <div class="margen">
        <h2>Calcular Margen por Fecha</h2>
        <label for="fecha-calculo">Selecciona Fecha:</label>
        <input type="date" id="fecha-calculo">
        <button id="calcular-margen">Calcular Margen</button>
        <p id="resultado-margen"></p>
    </div>

    <div class="margen">
        <h2>Ver Récord por Mes y Año</h2>
        <label for="mes">Selecciona Mes:</label>
        <select id="mes">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>

        <label for="anio">Selecciona Año:</label>
        <input type="number" id="anio" placeholder="Año" required>

        <button id="ver-record">Ver Récord</button>
        <p id="resultado-record"></p>
    </div>

    <script>
        const formularioVentas = document.getElementById('formulario-ventas');
        const historialVentas = document.getElementById('historial-ventas').getElementsByTagName('tbody')[0];
        const calcularMargenBtn = document.getElementById('calcular-margen');
        const resultadoMargen = document.getElementById('resultado-margen');
        const verRecordBtn = document.getElementById('ver-record');
        const resultadoRecord = document.getElementById('resultado-record');
        const ventas = [];

        formularioVentas.addEventListener('submit', function(event) {
            event.preventDefault();

            const fecha = document.getElementById('fecha').value;
            const producto = document.getElementById('producto').value;
            const precio = parseFloat(document.getElementById('precio').value);
            const costo = parseFloat(document.getElementById('costo').value);
            const caja = parseFloat(document.getElementById('caja').value);

            const margenGanancia = precio - costo;

            const nuevaFila = historialVentas.insertRow();
            nuevaFila.insertCell(0).innerText = fecha;
            nuevaFila.insertCell(1).innerText = producto;
            nuevaFila.insertCell(2).innerText = `$${precio.toFixed(2)}`;
            nuevaFila.insertCell(3).innerText = `$${costo.toFixed(2)}`;
            nuevaFila.insertCell(4).innerText = `$${margenGanancia.toFixed(2)}`;

            // Actualiza el dinero en caja
            const totalCaja = caja + precio;
            document.getElementById('caja').value = totalCaja.toFixed(2);

            // Almacena la venta
            ventas.push({ fecha, producto, precio, costo, margenGanancia });

            // Reinicia el formulario
            formularioVentas.reset();
        });

        calcularMargenBtn.addEventListener('click', function() {
            const fechaCalculo = document.getElementById('fecha-calculo').value;
            let totalMargen = 0;

            ventas.forEach(venta => {
                if (venta.fecha === fechaCalculo) {
                    totalMargen += venta.margenGanancia;
                }
            });

            if (totalMargen > 0) {
                resultadoMargen.innerText = `Margen de Ganancia Total para ${fechaCalculo}: $${totalMargen.toFixed(2)}`;
            } else {
                resultadoMargen.innerText = `No hay ventas registradas para ${fechaCalculo}.`;
            }
        });

        verRecordBtn.addEventListener('click', function() {
            const mesSeleccionado = document.getElementById('mes').value;
            const anioSeleccionado = document.getElementById('anio').value;
            let totalMargenMes = 0;
            let totalVentasMes = 0;

            ventas.forEach(venta => {
                const [anio, mes] = venta.fecha.split('-');
                if (mes === mesSeleccionado && anio === anioSeleccionado) {
                    totalMargenMes += venta.margenGanancia;
                    totalVentasMes++;
                }
            });

            if (totalVentasMes > 0) {
                resultadoRecord.innerText = `Total de Ventas en ${mesSeleccionado}/${anioSeleccionado}: ${totalVentasMes}, Margen de Ganancia Total: $${totalMargenMes.toFixed(2)}`;
            } else {
                resultadoRecord.innerText = `No hay ventas registradas para ${mesSeleccionado}/${anioSeleccionado}.`;
            }
        });
    </script>
</body>
</html>
