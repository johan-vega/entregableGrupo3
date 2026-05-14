@extends('layouts.app')

@section('title', 'Panel | SCC')

@section('content')
@if ($mode === 'admin')
<section class="dashboard-shell">
    <article class="dashboard-panel">
        <span class="section-kicker">Panel de administracion</span>
        <h1 class="dashboard-title">Vision global del centro de salud.</h1>
        <p class="dashboard-copy">
            Como administrador puedes revisar pacientes, citas y tratamientos de toda la plataforma desde un solo lugar.
        </p>

        <div class="dashboard-stats">
            <div class="summary-card">
                <strong>{{ $stats['pacients'] }}</strong>
                <span>Pacientes registrados</span>
            </div>
            <div class="summary-card">
                <strong>{{ $stats['cites'] }}</strong>
                <span>Citas registradas</span>
            </div>
            <div class="summary-card">
                <strong>{{ $stats['pending_cites'] }}</strong>
                <span>Citas pendientes</span>
            </div>
        </div>

        <div class="dashboard-list">
            <div class="dashboard-item">
                <strong>Tratamientos activos: {{ $stats['active_treatments'] }}</strong>
                <p>Controla rapidamente cuantas atenciones siguen en curso y donde puede haber mayor carga operativa.</p>
            </div>
            <div class="dashboard-item">
                <strong>Acceso total</strong>
                <p>Desde este panel puedes crear, editar y eliminar citas y tratamientos, ademas de registrar nuevos medicos.</p>
            </div>
        </div>
    </article>

    <aside class="preview-panel">
        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Sesion actual</strong>
                    <p class="section-copy">{{ Auth::user()->username }} con permisos de administrador.</p>
                </div>
                <span class="status-badge status-badge--ok">Admin</span>
            </div>
        </div>

        <div class="preview-card">
            <div class="list-row">
                <span>Correo</span>
                <strong>{{ Auth::user()->email }}</strong>
            </div>
            <div class="list-row">
                <span>Inicio de sesion</span>
                <strong>{{ Auth::user()->auth_provider ? ucfirst(Auth::user()->auth_provider) : 'Local' }}</strong>
            </div>
        </div>

        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Gestion habilitada</strong>
                    <p class="section-copy">Las acciones del panel ya permiten operar registros reales del sistema.</p>
                </div>
                <span class="status-badge status-badge--info">Activo</span>
            </div>
        </div>
    </aside>
</section>

<section class="module-section">
    <article class="module-panel">
        <h2 class="section-title">Crear paciente</h2>
        <p class="section-copy">
            El sistema generara automaticamente el usuario con el formato: inicial del nombre + primer apellido + inicial del segundo apellido.
        </p>
        <form method="POST" action="{{ route('dashboard.pacients.store') }}" class="stack-form">
            @csrf
            <div class="form-row">
                <div class="field-group">
                    <label for="pacient_nombre">Nombre</label>
                    <input id="pacient_nombre" class="input" type="text" name="nombre" value="{{ old('nombre') }}" required>
                </div>
                <div class="field-group">
                    <label for="pacient_apellido">Apellidos</label>
                    <input id="pacient_apellido" class="input" type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Ej. Vega Minaya" required>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label for="pacient_fecha_nacimiento">Fecha de nacimiento</label>
                    <input id="pacient_fecha_nacimiento" class="input" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                </div>
                <div class="field-group">
                    <label for="pacient_genero">Genero</label>
                    <input id="pacient_genero" class="input" type="text" name="genero" value="{{ old('genero') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label for="pacient_telefono">Telefono</label>
                    <input id="pacient_telefono" class="input" type="text" name="telefono" value="{{ old('telefono') }}" required>
                </div>
                <div class="field-group">
                    <label for="pacient_tipo_sangre">Tipo de sangre</label>
                    <input id="pacient_tipo_sangre" class="input" type="text" name="tipo_sangre" value="{{ old('tipo_sangre') }}" required>
                </div>
            </div>

            <div class="field-group">
                <label for="pacient_direccion">Direccion</label>
                <input id="pacient_direccion" class="input" type="text" name="direccion" value="{{ old('direccion') }}" required>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label for="pacient_password">Contrasena del paciente</label>
                    <input id="pacient_password" class="input" type="password" name="password" required>
                </div>
                <div class="field-group">
                    <label for="pacient_password_confirmation">Confirmar contrasena</label>
                    <input id="pacient_password_confirmation" class="input" type="password" name="password_confirmation" required>
                </div>
            </div>

            <div class="credential-hint">
                <strong>Ejemplo</strong>
                <span>`Andre Vega Minaya` genera el usuario `avegam`.</span>
            </div>

            <button type="submit" class="button">Registrar paciente y usuario</button>
        </form>
    </article>

    <div class="management-grid management-grid--triple">
        <article class="module-panel">
            <h2 class="section-title">Crear cita</h2>
            <p class="section-copy">Asigna una nueva cita a cualquier paciente del sistema.</p>
            <form method="POST" action="{{ route('dashboard.cites.store') }}" class="stack-form">
                @csrf
                <div class="form-row">
                    <div class="field-group">
                        <label for="admin_fecha">Fecha y hora</label>
                        <input id="admin_fecha" class="input" type="datetime-local" name="fecha" value="{{ old('fecha') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="admin_estado">Estado</label>
                        <select id="admin_estado" class="input" name="estado" required>
                            @foreach ($citeStatuses as $status)
                            <option value="{{ $status }}" @selected(old('estado', 'Pendiente') === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="admin_paciente">Paciente</label>
                        <select id="admin_paciente" class="input" name="id_pacient" required>
                            <option value="">Selecciona un paciente</option>
                            @foreach ($pacients as $item)
                            <option value="{{ $item->id_pacient }}" @selected((string) old('id_pacient') === (string) $item->id_pacient)>
                                {{ $item->nombre }} {{ $item->apellido }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="admin_medico">Medico</label>
                        <select id="admin_medico" class="input" name="id_medic" required>
                            <option value="">Selecciona un medico</option>
                            @foreach ($medics as $item)
                            <option value="{{ $item->id_medic }}" @selected((string) old('id_medic') === (string) $item->id_medic)>
                                Dr. {{ $item->nombre }} {{ $item->apellido }} | {{ $item->especialidad }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field-group">
                    <label for="admin_motivo">Motivo</label>
                    <input id="admin_motivo" class="input" type="text" name="motivo" value="{{ old('motivo') }}" required>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="admin_sala">Sala</label>
                        <input id="admin_sala" class="input" type="text" name="sala" value="{{ old('sala') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="admin_observaciones">Observaciones</label>
                        <textarea id="admin_observaciones" class="input" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="button button--block">Registrar cita</button>
            </form>
        </article>

        <article class="module-panel">
            <h2 class="section-title">Crear tratamiento</h2>
            <p class="section-copy">Relaciona el tratamiento con un diagnostico y el medico responsable.</p>
            <form method="POST" action="{{ route('dashboard.treatments.store') }}" class="stack-form">
                @csrf
                <div class="form-row">
                    <div class="field-group">
                        <label for="treatment_nombre">Nombre</label>
                        <input id="treatment_nombre" class="input" type="text" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="treatment_duracion">Duracion</label>
                        <input id="treatment_duracion" class="input" type="text" name="duracion" value="{{ old('duracion') }}" placeholder="Ej. 2 semanas" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="treatment_medico">Medico</label>
                        <select id="treatment_medico" class="input" name="id_medic" required>
                            <option value="">Selecciona un medico</option>
                            @foreach ($medics as $item)
                            <option value="{{ $item->id_medic }}" @selected((string) old('id_medic') === (string) $item->id_medic)>
                                Dr. {{ $item->nombre }} {{ $item->apellido }} | {{ $item->especialidad }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="treatment_diagnostic">Diagnostico</label>
                        <select id="treatment_diagnostic" class="input" name="id_diagnostic" required>
                            <option value="">Selecciona un diagnostico</option>
                            @foreach ($diagnostics as $item)
                            <option value="{{ $item->id_diagnostic }}" @selected((string) old('id_diagnostic') === (string) $item->id_diagnostic)>
                                #{{ $item->id_diagnostic }} - {{ optional($item->pacients)->nombre }} {{ optional($item->pacients)->apellido }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="treatment_estado">Estado</label>
                        <select id="treatment_estado" class="input" name="estado" required>
                            @foreach ($treatmentStatuses as $status)
                            <option value="{{ $status }}" @selected(old('estado', 'Activo') === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="treatment_frecuencia">Frecuencia</label>
                        <input id="treatment_frecuencia" class="input" type="text" name="frecuencia_administracion" value="{{ old('frecuencia_administracion') }}" placeholder="Ej. Cada 8 horas" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="treatment_descripcion">Descripcion</label>
                    <textarea id="treatment_descripcion" class="input" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                </div>

                @if ($diagnostics->isEmpty())
                <p class="section-copy">Aun no hay diagnosticos registrados. Necesitas al menos uno para crear tratamientos.</p>
                @endif

                <button type="submit" class="button button--block" @disabled($diagnostics->isEmpty())>Registrar tratamiento</button>
            </form>
        </article>

        <article class="module-panel">
            <h2 class="section-title">Crear medico</h2>
            <p class="section-copy">Amplia el equipo medico con nuevas especialidades y datos de contacto.</p>
            <form method="POST" action="{{ route('dashboard.medics.store') }}" class="stack-form">
                @csrf
                <div class="form-row">
                    <div class="field-group">
                        <label for="medic_nombre">Nombre</label>
                        <input id="medic_nombre" class="input" type="text" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="medic_apellido">Apellido</label>
                        <input id="medic_apellido" class="input" type="text" name="apellido" value="{{ old('apellido') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="medic_especialidad">Especialidad</label>
                        <input id="medic_especialidad" class="input" type="text" name="especialidad" value="{{ old('especialidad') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="medic_telefono">Telefono</label>
                        <input id="medic_telefono" class="input" type="text" name="telefono" value="{{ old('telefono') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="medic_email">Email</label>
                        <input id="medic_email" class="input" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="field-group">
                        <label for="medic_licencia">Licencia</label>
                        <input id="medic_licencia" class="input" type="text" name="licencia" value="{{ old('licencia') }}" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="medic_anios">Anios de experiencia</label>
                    <input id="medic_anios" class="input" type="number" name="anios_experiencia" min="0" value="{{ old('anios_experiencia') }}" required>
                </div>

                <button type="submit" class="button button--block">Registrar medico</button>
            </form>
        </article>
    </div>

    <article class="contenedor-tablas">
        <h2 class="section-title">Ultimos pacientes</h2>
        <div class="table-scroll">
            <table class="active">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Telefono</th>
                    <th>Tipo Sangre</th>
                </tr>
                @forelse ($recentPacients as $item)
                <tr>
                    <td>{{ $item->id_pacient }}</td>
                    <td>{{ $item->nombre }} {{ $item->apellido }}</td>
                    <td>{{ optional($item->user)->username ?? 'Sin usuario' }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->tipo_sangre }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Aun no hay pacientes registrados.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </article>

    <article class="module-panel">
        <h2 class="section-title">Gestionar citas</h2>
        <p class="section-copy">Edita o elimina citas existentes sin salir del panel.</p>

        <div class="management-grid">
            @forelse ($managedCites as $item)
            <div class="management-card">
                <div class="management-card__header">
                    <div>
                        <strong>
                            {{ optional($item->pacients)->nombre }} {{ optional($item->pacients)->apellido }}
                        </strong>
                        <p class="section-copy">
                            Dr. {{ optional($item->medics)->nombre }} {{ optional($item->medics)->apellido }} | {{ $item->estado }}
                        </p>
                    </div>
                    <span class="status-badge status-badge--info">#{{ $item->id_cita }}</span>
                </div>

                <form method="POST" action="{{ route('dashboard.cites.update', $item) }}" class="stack-form stack-form--compact">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="field-group">
                            <label>Fecha y hora</label>
                            <input class="input" type="datetime-local" name="fecha" value="{{ \Illuminate\Support\Carbon::parse($item->fecha)->format('Y-m-d\TH:i') }}" required>
                        </div>
                        <div class="field-group">
                            <label>Estado</label>
                            <select class="input" name="estado" required>
                                @foreach ($citeStatuses as $status)
                                <option value="{{ $status }}" @selected($item->estado === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Paciente</label>
                            <select class="input" name="id_pacient" required>
                                @foreach ($pacients as $pacientItem)
                                <option value="{{ $pacientItem->id_pacient }}" @selected($item->id_pacient === $pacientItem->id_pacient)>
                                    {{ $pacientItem->nombre }} {{ $pacientItem->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-group">
                            <label>Medico</label>
                            <select class="input" name="id_medic" required>
                                @foreach ($medics as $medicItem)
                                <option value="{{ $medicItem->id_medic }}" @selected($item->id_medic === $medicItem->id_medic)>
                                    Dr. {{ $medicItem->nombre }} {{ $medicItem->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field-group">
                        <label>Motivo</label>
                        <input class="input" type="text" name="motivo" value="{{ $item->motivo }}" required>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Sala</label>
                            <input class="input" type="text" name="sala" value="{{ $item->sala }}" required>
                        </div>
                        <div class="field-group">
                            <label>Observaciones</label>
                            <textarea class="input" name="observaciones" rows="3">{{ $item->observaciones }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="button button--soft">Guardar cambios</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('dashboard.cites.destroy', $item) }}" class="inline-danger-form" onsubmit="return confirm('¿Eliminar esta cita?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button--danger">Eliminar cita</button>
                </form>
            </div>
            @empty
            <div class="empty-state">
                <p class="empty-copy">Todavia no hay citas registradas para gestionar.</p>
            </div>
            @endforelse
        </div>
    </article>

    <article class="module-panel">
        <h2 class="section-title">Gestionar tratamientos</h2>
        <p class="section-copy">Actualiza el estado, medico responsable o diagnostico asociado de cada tratamiento.</p>

        <div class="management-grid">
            @forelse ($managedTreatments as $item)
            <div class="management-card">
                <div class="management-card__header">
                    <div>
                        <strong>{{ $item->nombre }}</strong>
                        <p class="section-copy">
                            Paciente: {{ optional(optional($item->diagnostics)->pacients)->nombre }}
                            {{ optional(optional($item->diagnostics)->pacients)->apellido }}
                        </p>
                    </div>
                    <span class="status-badge status-badge--warn">{{ $item->estado }}</span>
                </div>

                <form method="POST" action="{{ route('dashboard.treatments.update', $item) }}" class="stack-form stack-form--compact">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="field-group">
                            <label>Nombre</label>
                            <input class="input" type="text" name="nombre" value="{{ $item->nombre }}" required>
                        </div>
                        <div class="field-group">
                            <label>Duracion</label>
                            <input class="input" type="text" name="duracion" value="{{ $item->duracion }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Medico</label>
                            <select class="input" name="id_medic" required>
                                @foreach ($medics as $medicItem)
                                <option value="{{ $medicItem->id_medic }}" @selected($item->id_medic === $medicItem->id_medic)>
                                    Dr. {{ $medicItem->nombre }} {{ $medicItem->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-group">
                            <label>Diagnostico</label>
                            <select class="input" name="id_diagnostic" required>
                                @foreach ($diagnostics as $diagnosticItem)
                                <option value="{{ $diagnosticItem->id_diagnostic }}" @selected($item->id_diagnostic === $diagnosticItem->id_diagnostic)>
                                    #{{ $diagnosticItem->id_diagnostic }} - {{ optional($diagnosticItem->pacients)->nombre }} {{ optional($diagnosticItem->pacients)->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Estado</label>
                            <select class="input" name="estado" required>
                                @foreach ($treatmentStatuses as $status)
                                <option value="{{ $status }}" @selected($item->estado === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-group">
                            <label>Frecuencia</label>
                            <input class="input" type="text" name="frecuencia_administracion" value="{{ $item->frecuencia_administracion }}" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label>Descripcion</label>
                        <textarea class="input" name="descripcion" rows="4" required>{{ $item->descripcion }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="button button--soft">Guardar cambios</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('dashboard.treatments.destroy', $item) }}" class="inline-danger-form" onsubmit="return confirm('¿Eliminar este tratamiento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button--danger">Eliminar tratamiento</button>
                </form>
            </div>
            @empty
            <div class="empty-state">
                <p class="empty-copy">Todavia no hay tratamientos registrados para gestionar.</p>
            </div>
            @endforelse
        </div>
    </article>

    <article class="contenedor-tablas">
        <h2 class="section-title">Equipo medico registrado</h2>
        <div class="table-scroll">
            <table class="active">
                <tr>
                    <th>Medico</th>
                    <th>Especialidad</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Experiencia</th>
                </tr>
                @forelse ($medics as $item)
                <tr>
                    <td>Dr. {{ $item->nombre }} {{ $item->apellido }}</td>
                    <td>{{ $item->especialidad }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->anios_experiencia }} anios</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Aun no hay medicos registrados.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </article>
</section>
@else
<section class="dashboard-shell">
    <article class="dashboard-panel">
        <span class="section-kicker">Panel del paciente</span>
        <h1 class="dashboard-title">Hola, {{ Auth::user()->name }}.</h1>
        <p class="dashboard-copy">
            Aqui veras solo tu informacion vinculada: tus citas, tus diagnosticos y tus tratamientos activos.
        </p>

        <div class="dashboard-stats">
            <div class="summary-card">
                <strong>{{ $stats['cites'] }}</strong>
                <span>Mis citas</span>
            </div>
            <div class="summary-card">
                <strong>{{ $stats['pending_cites'] }}</strong>
                <span>Pendientes</span>
            </div>
            <div class="summary-card">
                <strong>{{ $stats['active_treatments'] }}</strong>
                <span>Tratamientos activos</span>
            </div>
        </div>

        <div class="dashboard-list">
            @if ($pacient)
            <div class="dashboard-item">
                <strong>Perfil vinculado</strong>
                <p>{{ $pacient->nombre }} {{ $pacient->apellido }} | {{ $pacient->telefono }} | {{ $pacient->tipo_sangre }}</p>
            </div>
            @else
            <div class="dashboard-item">
                <strong>Sin perfil clinico enlazado</strong>
                <p>
                    Tu usuario ya puede iniciar sesion, pero aun no esta vinculado a un paciente de la base de datos.
                    Un administrador debe completar o enlazar tu ficha para mostrar tus citas y tratamientos reales.
                </p>
            </div>
            @endif
        </div>
    </article>

    <aside class="preview-panel">
        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Acceso actual</strong>
                    <p class="section-copy">{{ Auth::user()->username ?? Auth::user()->email }}</p>
                </div>
                <span class="status-badge status-badge--info">Paciente</span>
            </div>
        </div>

        <div class="preview-card">
            <div class="list-row">
                <span>Diagnosticos</span>
                <strong>{{ $stats['diagnostics'] }}</strong>
            </div>
            <div class="list-row">
                <span>Metodo de acceso</span>
                <strong>{{ Auth::user()->auth_provider ? ucfirst(Auth::user()->auth_provider) : 'Local' }}</strong>
            </div>
        </div>

        <div class="preview-card">
            <div class="preview-card__row">
                <div>
                    <strong>Citas desde el panel</strong>
                    <p class="section-copy">Ahora tambien puedes solicitar nuevas citas directamente desde tu cuenta.</p>
                </div>
                <span class="status-badge status-badge--warn">Nuevo</span>
            </div>
        </div>
    </aside>
</section>

<section class="module-section">
    <article class="module-panel">
        <h2 class="section-title">Solicitar una cita</h2>
        @if ($pacient)
        <p class="section-copy">Tu solicitud quedara registrada con estado pendiente para seguimiento del equipo.</p>

        <form method="POST" action="{{ route('dashboard.cites.store') }}" class="stack-form">
            @csrf
            <div class="form-row">
                <div class="field-group">
                    <label for="patient_fecha">Fecha y hora</label>
                    <input id="patient_fecha" class="input" type="datetime-local" name="fecha" value="{{ old('fecha') }}" required>
                </div>
                <div class="field-group">
                    <label for="patient_medico">Medico</label>
                    <select id="patient_medico" class="input" name="id_medic" required>
                        <option value="">Selecciona un medico</option>
                        @foreach ($medics as $item)
                        <option value="{{ $item->id_medic }}" @selected((string) old('id_medic') === (string) $item->id_medic)>
                            Dr. {{ $item->nombre }} {{ $item->apellido }} | {{ $item->especialidad }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label for="patient_motivo">Motivo</label>
                    <input id="patient_motivo" class="input" type="text" name="motivo" value="{{ old('motivo') }}" required>
                </div>
                <div class="field-group">
                    <label for="patient_sala">Sala</label>
                    <input id="patient_sala" class="input" type="text" name="sala" value="{{ old('sala') }}" placeholder="Ej. Consultorio 2" required>
                </div>
            </div>

            <div class="field-group">
                <label for="patient_observaciones">Observaciones</label>
                <textarea id="patient_observaciones" class="input" name="observaciones" rows="4">{{ old('observaciones') }}</textarea>
            </div>

            <button type="submit" class="button">Registrar mi cita</button>
        </form>
        @else
        <p class="empty-copy">
            Necesitas que un administrador vincule tu usuario con un paciente para poder registrar citas desde esta vista.
        </p>
        @endif
    </article>

    <article class="contenedor-tablas">
        <h2 class="section-title">Mis citas programadas</h2>
        <div class="table-scroll">
            <table class="active">
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Medico</th>
                    <th>Estado</th>
                </tr>
                @forelse ($userCites as $item)
                <tr>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->motivo }}</td>
                    <td>{{ optional($item->medics)->nombre }} {{ optional($item->medics)->apellido }}</td>
                    <td>{{ $item->estado }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Todavia no tienes citas vinculadas.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </article>

    <article class="contenedor-tablas">
        <h2 class="section-title">Mis tratamientos</h2>
        <div class="table-scroll">
            <table class="active">
                <tr>
                    <th>Tratamiento</th>
                    <th>Estado</th>
                    <th>Frecuencia</th>
                    <th>Medico</th>
                </tr>
                @forelse ($userTreatments as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>{{ $item->frecuencia_administracion }}</td>
                    <td>{{ optional($item->medics)->nombre }} {{ optional($item->medics)->apellido }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Todavia no tienes tratamientos vinculados.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </article>

    <article class="contenedor-tablas">
        <h2 class="section-title">Mis diagnosticos</h2>
        <div class="table-scroll">
            <table class="active">
                <tr>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Gravedad</th>
                    <th>Medico</th>
                </tr>
                @forelse ($userDiagnostics as $item)
                <tr>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->gravedad }}</td>
                    <td>{{ optional($item->medics)->nombre }} {{ optional($item->medics)->apellido }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Todavia no tienes diagnosticos vinculados.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </article>
</section>
@endif
@endsection
