@extends('layouts.app')

@section('title', 'Confirmar contrasena | SANAR+')

@section('content')
    <section class="auth-shell">
        <article class="auth-panel">
            <div>
                <span class="section-kicker">Confirmacion sensible</span>
                <h1 class="auth-title">Antes de continuar, confirma tu contrasena para proteger informacion clinica.</h1>
                <p class="auth-copy">
                    Este paso agrega una capa de seguridad cuando una accion requiere mayor validacion dentro del sistema.
                </p>
            </div>

            <div class="auth-highlights">
                <div class="auth-highlight">
                    <strong>Proteccion adicional</strong>
                    <span>Ideal para cambios delicados o acciones administrativas.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Flujo consistente</strong>
                    <span>Mismo lenguaje visual para no desorientar al usuario.</span>
                </div>
            </div>
        </article>

        <article class="auth-card">
            <div class="auth-card__header">
                <h2>Confirmar contrasena</h2>
                <p>Ingresa tu contrasena actual para continuar con esta accion.</p>
            </div>

            <form class="auth-form" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="field-group">
                    <label for="password">Contrasena actual</label>
                    <input id="password" class="input" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <button class="button button--block" type="submit">Confirmar acceso</button>
            </form>

            @if (Route::has('password.request'))
                <div class="inline-actions">
                    <a class="helper-link" href="{{ route('password.request') }}">¿Olvidaste tu contrasena?</a>
                </div>
            @endif
        </article>
    </section>
@endsection
