<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @stack('style')


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <header>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-4 col-md-2 py-2">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid w-75" alt="Logo" />
                        </a>
                    </div>
                    <div class="col-12 col-md-8">
                        <nav class="navbar navbar-expand-md">
                            <div class="container justify-content-center">    
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <!-- Left Side Of Navbar -->
                                    <ul class="navbar-nav me-auto">

                                    </ul>

                                    <!-- Right Side Of Navbar -->
                                    <ul class="navbar-nav ms-auto">
                                        <!-- Authentication Links -->
                                        @guest
                                            @if (Route::has('login'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>
                                            @endif

                                            {{--@if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif--}}
                                        @else
                                            @canany(['create-role', 'edit-role', 'delete-role'])
                                                <li><a class="nav-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
                                            @endcanany
                                            @canany(['create-user', 'edit-user', 'delete-user'])
                                                <li><a class="nav-link" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a></li>
                                            @endcanany
                                            @canany(['create-juguete', 'edit-juguete', 'delete-juguete'])
                                                <li><a class="nav-link" href="{{ route('juguetes.index') }}">{{ __('Juguetes') }}</a></li>
                                            @endcanany
                                            @canany(['create-categoria', 'edit-categoria', 'delete-categoria'])
                                                <li><a class="nav-link" href="{{ route('categorias.index') }}">{{ __('Categorías') }}</a></li>
                                            @endcanany
                                            @canany(['create-cliente', 'edit-cliente', 'delete-cliente'])
                                                <li><a class="nav-link" href="{{ route('clientes.index') }}">{{ __('Clientes') }}</a></li>
                                            @endcanany
                                            @canany(['create-proveedor', 'edit-proveedor', 'delete-proveedor'])
                                                <li><a class="nav-link" href="{{ route('proveedores.index') }}">{{ __('Proveedores') }}</a></li>
                                            @endcanany
                                            @canany(['create-compra', 'edit-compra', 'delete-compra'])
                                                <li><a class="nav-link" href="{{ route('compras.index') }}">{{ __('Compras') }}</a></li>
                                            @endcanany
                                            @canany(['create-venta', 'edit-venta', 'delete-venta'])
                                                <li><a class="nav-link" href="{{ route('ventas.index') }}">{{ __('Ventas') }}</a></li>
                                            @endcanany
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">
                        
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ $message }}
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </div>
        </main>

        <footer class="py-4">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-12">
                        <p class="m-0">Copyright © 2024</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
    @yield('javascript')
</body>
</html>
