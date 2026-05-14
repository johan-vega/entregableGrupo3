@extends('layouts.app')

@section('title', 'Nueva contrasena | SANAR+')

@section('content')
    <section class="auth-shell">
        <article class="auth-panel">
            <div>
                <span class="section-kicker">Ultimo paso</span>
                <h1 class="auth-title">Define una nueva contrasena y vuelve a tu flujo clinico sin frenar la operacion.</h1>
                <p class="auth-copy">
                    Esta pantalla mantiene la misma logica visual del sistema para que el proceso de recuperacion sea familiar.
                </p>
            </div>

            <div class="auth-highlights">
                <div class="auth-highlight">
                    <strong>Seguridad</strong>
                    <span>Se valida el token de recuperacion antes de actualizar la cuenta.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Continuidad</strong>
                    <span>Una vez cambiada la contrasena podras volver al sistema con normalidad.</span>
                </div>
            </div>
        </article>

        <article class="auth-card">
            <div class="auth-card__header">
                <h2>Restablecer acceso</h2>
                <p>Completa los campos para guardar tu nueva contrasena.</p>
            </div>

            <form class="auth-form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field-group">
                    <label for="email">Correo electronico</label>
                    <input id="email" class="input" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="field-group">
                        <label for="password">Nueva contrasena</label>
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

                <button class="button button--block" type="submit">Guardar nueva contrasena</button>
            </form>
        </article>
    </section>
@endsection
