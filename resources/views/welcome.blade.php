@extends('layouts.app')

@section('title', 'SCC | Sistemas de Control de Citas')

@section('content')
<section class="landing-hero">
    <article class="hero-panel">
        <span class="section-kicker">Gestion de citas pensada para personas</span>
        <h1 class="hero-title">Una entrada clara y amable para pacientes, recepcion y personal medico.</h1>
        <p class="hero-copy">
            SANAR+ organiza el flujo de atencion desde el primer ingreso al sistema. Agenda, confirma y consulta
            citas con una interfaz limpia, rapida y lista para crecer con tu clinica, centro de salud u hospital.
        </p>

        <div class="hero-actions">
            <a class="button" href="{{ route('login') }}">Iniciar sesion</a>
            <a class="button button--ghost" href="{{ route('register') }}">Crear cuenta</a>
        </div>

        <div class="hero-stats">
            <div class="mini-stat">
                <strong>24/7</strong>
                <span>Acceso a la agenda y al historial operativo.</span>
            </div>
            <div class="mini-stat">
                <strong>3 perfiles</strong>
                <span>Util para recepcion, equipo clinico y administracion.</span>
            </div>
            <div class="mini-stat">
                <strong>2 clics</strong>
                <span>Para entrar al sistema con email o acceso social.</span>
            </div>
        </div>
    </article>

    <aside class="preview-panel">
        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Agenda activa</strong>
                    <p class="section-copy">Resumen rapido del dia para tomar decisiones sin perder tiempo.</p>
                </div>
                <span class="status-badge status-badge--ok">Operativa</span>
            </div>
        </div>

        <div class="preview-card">
            <div class="list-row">
                <span>Consultas confirmadas</span>
                <strong>18</strong>
            </div>
            <div class="list-row">
                <span>Pacientes por validar</span>
                <strong>05</strong>
            </div>
            <div class="list-row">
                <span>Especialidades activas</span>
                <strong>07</strong>
            </div>
        </div>

        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Accesos listos</strong>
                    <p class="section-copy">Email, Google y GitHub quedan preparados para tus pruebas de servidor.</p>
                </div>
                <span class="status-badge status-badge--info">Conectable</span>
            </div>
        </div>
    </aside>
</section>

<section class="module-section">
    <article class="module-panel">
        <h2 class="section-title">Modulos esenciales del sistema</h2>
        <p class="section-copy">
            La portada anticipa lo que mas importa en una plataforma de citas: pacientes, medicos, agenda y seguimiento.
        </p>

        <div class="module-grid">
            <div class="module-card">
                <h3>Pacientes</h3>
                <p>Registro ordenado con datos clave para una atencion mas rapida y precisa.</p>
            </div>
            <div class="module-card">
                <h3>Medicos</h3>
                <p>Especialidades, disponibilidad y trazabilidad del equipo profesional.</p>
            </div>
            <div class="module-card">
                <h3>Citas</h3>
                <p>Control de estados, horarios y motivos de consulta en un mismo flujo.</p>
            </div>
            <div class="module-card">
                <h3>Tratamientos</h3>
                <p>Seguimiento de planes clinicos y continuidad del cuidado del paciente.</p>
            </div>
        </div>
    </article>

    <article class="contenedor-tablas">
        <h2 class="section-title">Vista previa operacional</h2>
        <p class="section-copy">
            Cada tarjeta cambia la tabla activa para simular el recorrido natural dentro del sistema.
        </p>

        <div class="menu">
            <div class="card" onclick="mostrarTabla('pacientes')">
                <strong>Pacientes</strong>
                <span>Historias y datos de contacto.</span>
            </div>
            <div class="card" onclick="mostrarTabla('medicos')">
                <strong>Medicos</strong>
                <span>Especialidades y disponibilidad.</span>
            </div>
            <div class="card" onclick="mostrarTabla('citas')">
                <strong>Citas</strong>
                <span>Reservas y control diario.</span>
            </div>
            <div class="card" onclick="mostrarTabla('diagnosticos')">
                <strong>Diagnosticos</strong>
                <span>Hallazgos y observaciones.</span>
            </div>
            <div class="card" onclick="mostrarTabla('tratamientos')">
                <strong>Tratamientos</strong>
                <span>Seguimiento clinico.</span>
            </div>
            <div class="card" onclick="mostrarTabla('medicamentos')">
                <strong>Medicamentos</strong>
                <span>Dosis y frecuencia de apoyo.</span>
            </div>
        </div>

        <table id="pacientes" class="active">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Tipo Sangre</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Juan</td>
                <td>Perez</td>
                <td>987654321</td>
                <td>O+</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria</td>
                <td>Torres</td>
                <td>912345678</td>
                <td>A-</td>
            </tr>
        </table>

        <table id="medicos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Telefono</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Carlos Ruiz</td>
                <td>Cardiologia</td>
                <td>999888777</td>
            </tr>
        </table>

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

        <table id="diagnosticos">
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Gravedad</th>
                <th>Tipo</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Hipertension leve</td>
                <td>Media</td>
                <td>Cardiaco</td>
            </tr>
        </table>

        <table id="tratamientos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Duracion</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Terapia fisica</td>
                <td>3 meses</td>
                <td>Activo</td>
            </tr>
        </table>

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
    </article>
</section>
@endsection

@push('scripts')
<script>
    function mostrarTabla(idTabla) {
        document.querySelectorAll('table').forEach((tabla) => {
            tabla.classList.remove('active');
        });

        document.getElementById(idTabla).classList.add('active');
    }
</script>
@endpush