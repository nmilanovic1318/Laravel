<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        .align-content-md-center {
            text-align: center;

        }
        #submit {
            background-color: #107896;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 6px;
            margin-bottom: 5px;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        #submit:hover {
            border: none;
            background: red;
            box-shadow: 0px 0px 1px #777;
        }

        .thumbnails img {
            float: left;
            width: 40%;
            height: 70%;
            margin-top: 12px;
            display: block;
        }

        #app {
            background-color: #3D9970;
        }

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('PWA Projekat', 'PWA Projekat') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{--    FontAwesome--}}
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div id="app" class="overflow-hidden">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('home') }}">
                {{ config('PWA PROJEKAT', 'PWA') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('home')}}">Naslovna strana</a>
                                <a class="dropdown-item" href="{{route('editProfile', ['user'=>Auth::id()])}}">Podešavanja
                                    profila</a>
                                <a class="dropdown-item" href="{{route('showFanPages')}}">Fan stranice
                                </a>
                                <a class="dropdown-item"
                                   href="{{route('profilePage', Auth::id())}}">{{ __('Moj profil') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
