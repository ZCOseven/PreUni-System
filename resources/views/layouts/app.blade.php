<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1/dist/css/iziToast.min.css">


    <!-- Material Symbols (Outlined, Rounded, Sharp) Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Material+Symbols+Rounded&family=Material+Symbols+Sharp" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @yield('styles')
</head>

<body class="body-layout">
    <aside class="sidebar-layout">
        <img class="sidebar-logo" src="{{ asset('img/logo-v2.svg') }}" alt="Logo">

        <nav class="sidebar-nav">
            <ul class="sidebar-list">

                {{-- Dashboard --}}
                <li class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">dashboard</span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                {{-- Alumnos --}}
                <li class="sidebar-item">
                    <a href="{{ route('alumnos.index') }}"
                        class="sidebar-link {{ request()->routeIs('alumnos.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">school</span>
                        <span class="sidebar-text">Alumnos</span>
                    </a>
                </li>

                {{-- Docentes --}}
                <li class="sidebar-item">
                    <a href="{{ route('docentes.index') }}"
                        class="sidebar-link {{ request()->routeIs('docentes.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">co_present</span>
                        <span class="sidebar-text">Docentes</span>
                    </a>
                </li>

                {{-- Cursos --}}
                <li class="sidebar-item">
                    <a href="{{ route('cursos.index') }}"
                        class="sidebar-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">book_2</span>
                        <span class="sidebar-text">Cursos</span>
                    </a>
                </li>

                {{-- Asignaturas --}}
                <li class="sidebar-item">
                    <a href="{{ route('asignaturas.index') }}"
                        class="sidebar-link {{ request()->routeIs('asignaturas.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">book_3</span>
                        <span class="sidebar-text">Asignaturas</span>
                    </a>
                </li>

                {{-- Matrículas --}}
                <li class="sidebar-item">
                    <a href="{{ route('matriculas.index') }}"
                        class="sidebar-link {{ request()->routeIs('matriculas.*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">app_registration</span>
                        <span class="sidebar-text">Matriculas</span>
                    </a>
                </li>

                {{-- Reportes --}}
                <li class="sidebar-item">
                    <a href="#"
                        class="sidebar-link {{ request()->is('reportes*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">bar_chart</span>
                        <span class="sidebar-text">Reportes</span>
                    </a>
                </li>

                {{-- Usuarios --}}
                <li class="sidebar-item">
                    <a href="#"
                        class="sidebar-link {{ request()->is('usuarios*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">group</span>
                        <span class="sidebar-text">Usuarios</span>
                    </a>
                </li>

            </ul>

            <ul class="sidebar-list">
                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="sidebar-link sidebar-logout">
                            <span class="material-symbols-outlined sidebar-icon">logout</span>
                            <span class="sidebar-text">Cerrar sesión</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>

    </aside>

    <main class="main-layout">
        <header class="page-header">
            <h1 class="page-header__title">
                @yield('title', 'Dashboard')
            </h1>

            <div class="page-header__actions">
                <div class="page-header__icons">
                    <span class="page-header__icon material-symbols-outlined" title="Buscar">search</span>
                    <span class="page-header__icon material-symbols-outlined" title="Mensajes">mail</span>
                    <span class="page-header__icon material-symbols-outlined" title="Notificaciones">notifications</span>
                </div>

                <div class="page-header__user">
                    <span class="page-header__username">{{ auth()->user()->name }}</span>
                    <img class="page-header__avatar" src="{{ asset('img/avatar.svg') }}" alt="Perfil">
                </div>
            </div>
        </header>


        <section class="page-content">
            @yield('content')
        </section>

    </main>


    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1/dist/js/iziToast.min.js"></script>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
    <script>
        iziToast.success({
            title: 'Éxito',
            message: '{{ session("success") }}',
            position: 'bottomRight',
            class: 'toast-custom-pos'
        });
    </script>
    @endif

    {{-- Mensaje de error --}}
    @if(session('error'))
    <script>
        iziToast.error({
            title: 'Error',
            message: '{{ session("error") }}',
            position: 'bottomRight',
            class: 'toast-custom-pos'
        });
    </script>
    @endif

    {{-- Errores de validación --}}
    @if ($errors->any())
    <script>
        iziToast.error({
            title: 'Error',
            message: '{{ implode(", ", $errors->all()) }}',
            position: 'bottomRight',
            class: 'toast-custom-pos'
        });
    </script>
    @endif
</body>

</html>