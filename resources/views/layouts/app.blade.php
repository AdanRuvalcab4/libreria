<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Librería')</title>

    <!-- Archivos de estilo -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"> <!-- Iconos -->

    <style>
        /* Estilos personalizados */
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            position: relative;
            background: url('{{ asset('images/book4.jpg') }}') no-repeat center center;
            background-size: cover;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 3rem 0;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Color negro con opacidad para superposición */
            z-index: 1;
        }

        header h1, header p {
            position: relative;
            z-index: 2;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 600; /* Grosor moderado */
            color: #fff; /* Texto blanco */
        }

        header p {
            font-size: 1.5rem;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: #C5A992 !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Consistencia en la tipografía */
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
            color: #495057;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: #C5A992;
            color: #fff;
            border-radius: 5px;
        }

        main {
            min-height: calc(100vh - 280px);
            padding-top: 2rem;
        }

        footer {
            background: #212529;
            color: #adb5bd;
            padding: 1rem 0;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        .footer-icon {
            color: #adb5bd;
            transition: color 0.3s ease;
        }

        .footer-icon:hover {
            color: #C5A992;
        }
    </style>
</head>

<body>
    <!-- Encabezado (Header) -->
    <header class="text-center">
        <div class="container">
            <h1><i class="bi bi-book"></i> Librería</h1>
            <p class="lead">La mejor plataforma para comprar tus libros</p>
        </div>
    </header>

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-bookmarks"></i> Libros, Órdenes y Reseñas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index-libros') }}"><i class="bi bi-book"></i> Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index-orders') }}"><i class="bi bi-journal"></i> Órdenes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index-reviews') }}"><i class="bi bi-chat-left-text"></i> Reseñas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="container py-4">
        @auth
            <!-- Contenido para usuarios autenticados -->
            <div class="shrink-0 me-3">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </div>
            <div>
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <!-- Contenido para usuarios no autenticados -->
            
        @endauth

        @yield('content') <!-- Aquí se inserta el contenido de cada vista -->
    </main>

    <!-- Pie de página (Footer) -->
    <footer class="text-center py-3">
        <div class="container">
            <p>
                &copy; Librería. Todos los derechos reservados.
                <a href="#" class="footer-icon ms-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="footer-icon ms-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="footer-icon ms-2"><i class="bi bi-instagram"></i></a>
            </p>
        </div>
    </footer>

    <!-- Archivos JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
