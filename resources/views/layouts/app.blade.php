<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Produksi') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/axios.min.js') }}"></script>
    @livewireStyles
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/buttons.dataTables.min.css') }}">

    <!-- Silde Show -->
    <style>
    html,
    body {
        background-image: url("{{ asset('/img/bg.png') }}");
        background-size: cover;
        scroll-behavior: smooth;
    }

    * {
        box-sizing: border-box
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Slideshow container */
    .slideshow-container {
        position: relative;
        background: #f1f1f1f1;
    }

    /* Slides */
    .mySlides {
        display: none;
        padding: 80px;
        text-align: center;
    }

    /* Next & previous buttons */
    .prev,
    .nextt {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -30px;
        padding: 16px;
        color: #888;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .nextt {
        position: absolute;
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .nextt:hover {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
    }

    /* The dot/bullet/indicator container */
    .dot-container {
        text-align: center;
        padding: 20px;
        background: #ddd;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    /* Add a background color to the active dot/circle */
    .active,
    .dot:hover {
        background-color: #717171;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Manage
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Assy WD
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/tabel/Assy WD">Tabel</a>
                                <a class="dropdown-item" href="/graph/Assy WD">Graph</a>
                                <a class="dropdown-item" href="/data/Assy WD">Input</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Metal Part
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/tabel/Metal Part">Tabel</a>
                                <a class="dropdown-item" href="/graph/Metal Part">Graph</a>
                                <a class="dropdown-item" href="/data/Metal Part">Input</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Export
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/tabel/Export">Tabel</a>
                                <a class="dropdown-item" href="/graph/Export">Graph</a>
                                <a class="dropdown-item" href="/data/Export">Input</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Lotcard
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/lotstatus">Status Lotcard</a>
                                <a class="dropdown-item" href="/lotscaned">Lotcard Scanned</a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('isUser')
                                <a href="/home" class="dropdown-item">Dashboard</a>
                                <a href="/profile/{{ Auth::user()->name }}" class="dropdown-item">Profil</a>
                                <a href="/user/planning" class="dropdown-item">Planning</a>
                                @endcan
                                @can('isManager')
                                <a href="/manager/Informasi" class="dropdown-item">Informasi</a>
                                @endcan
                                @can('isAdmin')
                                <a href="/admin/pengaturan" class="dropdown-item">Pengaturan Pengguna</a>
                                <a href="/pengaturan/masalah" class="dropdown-item">Pengaturan Produksi</a>
                                <a href="/admin/akunoracle" class="dropdown-item">Akun Oracle</a>
                                <a href="/admin/tambahakun" class="dropdown-item">Tambah Akun</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    @livewireScripts
</body>

</html>
