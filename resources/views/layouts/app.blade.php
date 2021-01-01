<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="wrapper flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-dark bg-gradient-dark shadow-sm fixed-top" style="z-index: 1">
            <div class="container">
                <a class="navbar-brand" href="{{ route('articles.index') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                    @if (Auth::user()->roles->count() > 0)
                                        @if (Auth::user()->hasRole('owner'))
                                            <p class="dropdown-item text-muted text-center m-0">owner</p>
                                        @endif

                                        @if (Auth::user()->hasRole('admin'))
                                            <p class="dropdown-item text-muted text-center m-0">admin</p>
                                        @endif

                                        @if (Auth::user()->hasRole('moderator'))
                                            <p class="dropdown-item text-muted text-center m-0">moderator</p>
                                        @endif
                                        <hr class="mt-0">
                                    @endif


                                    @can('create', App\Models\Article::class)
                                        <a class="dropdown-item" href="{{ route('home.index') }}">
                                            My articles
                                        </a>

                                        <a class="dropdown-item" href="{{ route('articles.create') }}">
                                            New article
                                        </a>
                                    @endcan

                                    @can('user-control')
                                        <a href="{{ route('users.index') }}" class="dropdown-item">
                                            Users
                                        </a>
                                    @endcan
                                    <hr>
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

        <main class="py-4 for_fixed_header">
            @yield('content')
        </main>
    </div>

    {{-- <footer class="text-center text-light bg-gradient-dark py-2 for_fixed_header">
        <div class="container">
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="/docs/4.4/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer> --}}
</body>
</html>
