<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>@yield('title', 'Sistema de Reservas')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%230d6efd'/><text x='50' y='68' font-size='60' text-anchor='middle' fill='white' font-family='Arial' font-weight='bold'>C</text></svg>">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
            padding-top: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            z-index: 1000;
        }

        .sidebar .brand {
            font-size: 1.25rem;
            font-weight: bold;
            padding: 0.5rem 1rem 1rem 1rem;
            border-bottom: 1px solid #343a40;
            margin-bottom: 1rem;
        }

        .sidebar .brand i {
            color: #0d6efd;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.6rem 1rem;
            border-radius: 0;
        }

        .sidebar .nav-link:hover {
            background-color: #343a40;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        .sidebar .section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6c757d;
            padding: 1rem 1rem 0.5rem 1rem;
            letter-spacing: 0.05em;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        /* Responsive: en pantallas pequeñas el sidebar se oculta */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-hospital"></i> Consultorio
        </div>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Inicio
                </a>
            </li>

            @if(auth()->user()->esAdmin())
                <div class="section-title">Administración</div>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('especialidades.*') ? 'active' : '' }}"
                       href="{{ route('especialidades.index') }}">
                        <i class="bi bi-clipboard2-pulse"></i> Especialidades
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('medicos.*') ? 'active' : '' }}"
                       href="{{ route('medicos.index') }}">
                        <i class="bi bi-person-badge"></i> Médicos
                    </a>
                </li>
            @endif

            <div class="section-title">Agenda</div>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}"
                   href="{{ route('citas.index') }}">
                    <i class="bi bi-calendar-check"></i> Citas
                </a>
            </li>

            <div class="section-title">Cuenta</div>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                   href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle"></i> Perfil
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>

    {{-- CONTENIDO --}}
    <div class="main-content">

        {{-- Topbar con nombre de usuario --}}
        @auth
        <div class="topbar">
            <span class="text-muted me-3">
                {{ auth()->user()->name }}
                @if(auth()->user()->esAdmin())
                    <span class="badge bg-danger ms-1">Admin</span>
                @endif
            </span>
        </div>
        @endauth

        {{-- Contenido de cada vista --}}
        @yield('contenido')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous">
    </script>
</body>
</html>