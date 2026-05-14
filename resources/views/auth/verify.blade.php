@extends('layouts.app')

@section('title', 'Verificar correo | SANAR+')

@section('content')
    <section class="auth-shell">
        <article class="auth-panel">
            <div>
                <span class="section-kicker">Validacion del correo</span>
                <h1 class="auth-title">Confirma tu email para mantener seguro el acceso al sistema de citas.</h1>
                <p class="auth-copy">
                    La verificacion asegura que cada usuario tenga un correo valido antes de operar en el panel.
                </p>
            </div>

            <div class="auth-highlights">
                <div class="auth-highlight">
                    <strong>Mas confianza</strong>
                    <span>Ayuda a reducir registros incorrectos o accesos no deseados.</span>
                </div>
                <div class="auth-highlight">
                    <strong>Soporte sencillo</strong>
                    <span>Si no llega el correo, puedes solicitar uno nuevo desde esta misma vista.</span>
                </div>
            </div>
        </article>

        <article class="auth-card">
            <div class="auth-card__header">
                <h2>Verificar correo</h2>
                <p>Revisa tu bandeja de entrada y usa el enlace de confirmacion para continuar.</p>
            </div>

            @if (session('resent'))
                <div class="flash flash--success">
                    Enviamos un nuevo enlace de verificacion a tu correo.
                </div>
            @endif

            <div class="stack-form">
                <p class="section-copy">
                    Si aun no lo ves, revisa spam o solicita un nuevo envio.
                </p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="button button--block" type="submit">Reenviar enlace de verificacion</button>
                </form>
            </div>
        </article>
    </section>
@endsection
