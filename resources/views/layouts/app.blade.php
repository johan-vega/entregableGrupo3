<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SCC')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body_class', 'theme-body')">
    <div id="app" class="site-root">
        <div class="site-orb site-orb--one"></div>
        <div class="site-orb site-orb--two"></div>

        <header class="site-header">
            <a class="brand" href="{{ route('welcome') }}">
                <span class="brand-mark">S+</span>
                <span class="brand-copy">
                    <strong>SCC</strong>
                    <small>Control inteligente de citas y atencion</small>
                </span>
            </a>

            <nav class="site-nav" aria-label="Principal">
                <a class="site-nav__link {{ request()->routeIs('welcome') ? 'is-active' : '' }}" href="{{ route('welcome') }}">Inicio</a>

                @guest
                <a class="site-nav__link {{ request()->routeIs('login') ? 'is-active' : '' }}" href="{{ route('login') }}">Ingresar</a>
                <a class="site-nav__link {{ request()->routeIs('register') ? 'is-active' : '' }}" href="{{ route('register') }}">Crear cuenta</a>
                <a class="site-nav__button" href="{{ route('login') }}">Acceder al sistema</a>
                @else
                <a class="site-nav__link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Panel</a>

                <div class="user-pill">
                    <span class="user-pill__avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="user-pill__meta">
                        <strong>{{ Auth::user()->name }}</strong>
                        <small>{{ Auth::user()->email }}</small>
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="site-nav__button site-nav__button--ghost">Cerrar sesion</button>
                </form>
                @endguest
            </nav>
        </header>

        <main class="site-main @yield('main_class')">
            @if (session('status'))
            <div class="flash flash--success">
                {{ session('status') }}
            </div>
            @endif

            @if ($errors->has('social'))
            <div class="flash flash--danger">
                {{ $errors->first('social') }}
            </div>
            @endif

            @if ($errors->any() && ! $errors->has('social'))
            <div class="flash flash--danger">
                <strong>Revisa los datos ingresados.</strong>
                <ul class="flash-list">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
