<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión SANAR+</title>

    

    <style>
        :root {
            /* COLORES PRINCIPALES */
            --color-principal: #0074B7;
            --color-secundario: #4aa79c;
            --color-fondo: #f4f4f4;
            --color-blanco: #ffffff;
            --color-texto: #333;

            /* TABLAS */
            --color-header-tabla: var(--color-principal);
            --color-hover-tabla: #f1f1f1;

            /* SOMBRAS */
            --sombra: 0 4px 10px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: var(--color-fondo);
        }

        /* HEADER */
        header {
            background: var(--color-principal);
            color: var(--color-blanco);
            text-align: center;
            padding: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        /* MENU */
        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px;
        }

        /* TARJETAS */
        .card {
            width: 140px;
            height: 120px;
            background: var(--color-blanco);
            border-radius: 15px;
            box-shadow: var(--sombra);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
            color: var(--color-principal);
        }

        .card:hover {
            transform: translateY(-8px);
            background: var(--color-principal);
            color: var(--color-blanco);
        }

        /* CONTENEDOR TABLAS */
        .contenedor-tablas {
            width: 90%;
            margin: auto;
            background: var(--color-blanco);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--sombra);
            margin-bottom: 40px;
        }

        h2 {
            margin-bottom: 20px;
            color: var(--color-texto);
        }

        /* TABLAS */
        table {
            width: 100%;
            border-collapse: collapse;
            display: none;
        }

        table.active {
            display: table;
        }

        th {
            background: var(--color-header-tabla);
            color: var(--color-blanco);
            padding: 12px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: var(--color-hover-tabla);
        }
    </style>
</head>
<body>

    <header>SISTEMA DE GESTIÓN SANAR +</header>

    <div class="menu">
        <div class="card" onclick="mostrarTabla('pacientes')">Pacientes</div>
        <div class="card" onclick="mostrarTabla('medicos')">Médicos</div>
        <div class="card" onclick="mostrarTabla('citas')">Citas</div>
        <div class="card" onclick="mostrarTabla('diagnosticos')">Diagnósticos</div>
        <div class="card" onclick="mostrarTabla('tratamientos')">Tratamientos</div>
        <div class="card" onclick="mostrarTabla('medicamentos')">Medicamentos</div>
    </div>

    <div class="contenedor-tablas">
        <h2>Información</h2>

        <!-- PACIENTES -->
        <table id="pacientes" class="active">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Tipo Sangre</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Juan</td>
                <td>Pérez</td>
                <td>987654321</td>
                <td>O+</td>
            </tr>
            <tr>
                <td>2</td>
                <td>María</td>
                <td>Torres</td>
                <td>912345678</td>
                <td>A-</td>
            </tr>
        </table>

        <!-- MEDICOS -->
        <table id="medicos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Carlos Ruiz</td>
                <td>Cardiología</td>
                <td>999888777</td>
            </tr>
        </table>

        <!-- CITAS -->
        <table id="citas">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2026-05-12</td>
                <td>Control general</td>
                <td>Pendiente</td>
            </tr>
        </table>

        <!-- DIAGNOSTICOS -->
        <table id="diagnosticos">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Gravedad</th>
                <th>Tipo</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Hipertensión leve</td>
                <td>Media</td>
                <td>Cardiaco</td>
            </tr>
        </table>

        <!-- TRATAMIENTOS -->
        <table id="tratamientos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Duración</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Terapia física</td>
                <td>3 meses</td>
                <td>Activo</td>
            </tr>
        </table>

        <!-- MEDICAMENTOS -->
        <table id="medicamentos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dosis</th>
                <th>Frecuencia</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Paracetamol</td>
                <td>500mg</td>
                <td>Cada 8h</td>
            </tr>
        </table>
    </div>

    <script>
        function mostrarTabla(idTabla) {
            let tablas = document.querySelectorAll("table");

            tablas.forEach(tabla => {
                tabla.classList.remove("active");
            });

            document.getElementById(idTabla).classList.add("active");
        }
    </script>

</body>
</html>
