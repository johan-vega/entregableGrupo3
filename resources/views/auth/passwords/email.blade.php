@extends('layouts.app')

@section('title', 'Recuperar contrasena | SANAR+')

@section('content')
    <section class="auth-shell">
        <article class="auth-panel">
            <div>
                <span class="section-kicker">Recuperacion de acceso</span>
                <h1 class="auth-title">Te ayudamos a volver al sistema sin perder claridad en el proceso.</h1>
                <p class="auth-copy">
                    Enviaremos un enlace de recuperacion al correo registrado para que continúes con el trabajo del dia.
                </p>
            </div>

            <div class="auth-highlights">
                <div class="auth-highlight">
                    <strong>Proceso guiado</strong>
                    <span>Solo necesitas el correo con el que creaste tu acceso.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Sin vueltas</strong>
                    <span>Diseño limpio para que recepcion o equipo medico no se distraiga.</span>
                </div>
            </div>
        </article>

        <article class="auth-card">
            <div class="auth-card__header">
                <h2>Recuperar contrasena</h2>
                <p>Escribe tu correo y te enviaremos un enlace para restablecer el acceso.</p>
            </div>

            <form class="auth-form" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="field-group">
                    <label for="email">Correo electronico</label>
                    <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <button class="button button--block" type="submit">Enviar enlace de recuperacion</button>
            </form>
        </article>
    </section>
@endsection
