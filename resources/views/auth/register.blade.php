@extends('layouts.app')

@section('title', 'Registro | SANAR+')

@section('content')
    <section class="auth-shell">
        <article class="auth-panel">
            <div>
                <span class="section-kicker">Crear acceso al sistema</span>
                <h1 class="auth-title">Registra nuevos usuarios con una experiencia clara desde el primer formulario.</h1>
                <p class="auth-copy">
                    Ideal para equipos que recien empiezan a ordenar citas, historias y atencion. El diseño ayuda a
                    entender rapido que hacer y reduce errores al registrarse.
                </p>
            </div>

            <div class="auth-highlights">
                <div class="auth-highlight">
                    <strong>Alta tradicional</strong>
                    <span>Nombre, correo y contrasena validados con el flujo nativo de Laravel.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Accesos sociales</strong>
                    <span>Google y GitHub preparados para activarse con tus credenciales.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Escala contigo</strong>
                    <span>Listo para pasar de pruebas locales a un despliegue real.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Visual consistente</strong>
                    <span>Misma identidad de la pagina de inicio, login y panel.</span>
                </div>
            </div>
        </article>

        <article class="auth-card">
            <div class="auth-card__header">
                <h2>Crear cuenta</h2>
                <p>Registra un nuevo acceso para comenzar a gestionar citas, pacientes y seguimiento clinico.</p>
            </div>

            <div class="social-grid">
                <a class="social-button" href="{{ route('social.redirect', ['provider' => 'google']) }}">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M21.81 12.23c0-.72-.06-1.26-.2-1.82H12.2v3.44h5.52c-.11.86-.72 2.16-2.08 3.03l-.02.12 3.02 2.29.21.02c1.91-1.73 2.96-4.28 2.96-7.08Z" fill="#4285F4"/>
                        <path d="M12.2 21.9c2.7 0 4.96-.87 6.61-2.37l-3.21-2.43c-.86.59-2 .99-3.4.99-2.64 0-4.88-1.73-5.68-4.12l-.12.01-3.14 2.38-.04.11c1.64 3.19 5.02 5.43 8.98 5.43Z" fill="#34A853"/>
                        <path d="M6.52 13.97a5.97 5.97 0 0 1-.33-1.97c0-.69.12-1.36.32-1.97l-.01-.13-3.18-2.42-.1.05A9.74 9.74 0 0 0 2.16 12c0 1.57.38 3.06 1.06 4.47l3.3-2.5Z" fill="#FBBC05"/>
                        <path d="M12.2 5.91c1.77 0 2.96.75 3.63 1.37l2.65-2.54C17.15 3.5 14.9 2.1 12.2 2.1c-3.96 0-7.34 2.24-8.98 5.43l3.29 2.5c.81-2.39 3.05-4.12 5.69-4.12Z" fill="#EA4335"/>
                    </svg>
                    Registrarse con Google
                </a>

                <a class="social-button" href="{{ route('social.redirect', ['provider' => 'github']) }}">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.59 2 12.24c0 4.52 2.87 8.35 6.84 9.7.5.1.68-.22.68-.49 0-.24-.01-1.04-.01-1.88-2.78.62-3.37-1.2-3.37-1.2-.46-1.18-1.12-1.5-1.12-1.5-.91-.64.07-.63.07-.63 1 .07 1.53 1.06 1.53 1.06.9 1.56 2.35 1.11 2.92.85.09-.67.35-1.12.63-1.38-2.22-.26-4.55-1.14-4.55-5.09 0-1.13.39-2.05 1.03-2.78-.1-.26-.45-1.31.1-2.73 0 0 .84-.28 2.75 1.06a9.28 9.28 0 0 1 5 0c1.9-1.34 2.74-1.06 2.74-1.06.55 1.42.2 2.47.1 2.73.64.73 1.03 1.65 1.03 2.78 0 3.96-2.33 4.82-4.56 5.08.36.32.68.94.68 1.9 0 1.37-.01 2.48-.01 2.81 0 .27.18.6.69.49A10.27 10.27 0 0 0 22 12.24C22 6.59 17.52 2 12 2Z"/>
                    </svg>
                    Registrarse con GitHub
                </a>
            </div>

            <div class="divider">o creando una cuenta local</div>

            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field-group">
                    <label for="name">Nombre completo</label>
                    <input id="name" class="input" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="username">Nombre de usuario</label>
                    <input id="username" class="input" type="text" name="username" value="{{ old('username') }}" required autocomplete="username">
                    @error('username')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="email">Correo electronico</label>
                    <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="password">Contrasena</label>
                        <input id="password" class="input" type="password" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="password-confirm">Confirmar contrasena</label>
                        <input id="password-confirm" class="input" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <button class="button button--block" type="submit">Crear acceso ahora</button>
            </form>

            <div class="inline-actions">
                <span class="section-copy">¿Ya tienes una cuenta?</span>
                <a class="helper-link" href="{{ route('login') }}">Ir al inicio de sesion</a>
            </div>
        </article>
    </section>
@endsection
