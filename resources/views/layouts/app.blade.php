<?php   use \App\Http\Controllers\UserController; ?>
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
    @livewireStyles
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap4.min.css') }}">

    <!-- Silde Show -->
    <style>
    html,
    body {
        background-image: url("{{ asset('/img/bg.png') }}");
        background-size: cover;
        scroll-behavior: smooth;
    }

    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    DigiPro
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @guest 
                    @else
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if ( Auth::user()->department == 1)
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Production
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('lotcard_status')}}">Lotcard Status</a>
                                <a class="dropdown-item" href="{{route('production_data')}}">Production Data</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quality Control
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('in_production')}}">In Production</a>
                                <a class="dropdown-item" href="{{route('finish_data')}}">Finish Data</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Warehouse
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('transaction_data')}}">Transaction Data</a>
                                <a class="dropdown-item" href="{{route('transfers_records')}}">Transfers Records</a>
                            </div>
                        </li>
                        @elseif (Auth::user()->department == 3)
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('lotcard_status')}}">Lotcard Status</a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('production_data')}}">Production Data</a>
                        </li>
                        @elseif (Auth::user()->department == 4)
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('in_production')}}">In Production</a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('finish_data')}}">Finish Data</a>
                        </li>
                        @elseif (Auth::user()->department == 5)
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('transaction_data')}}">Transaction Data</a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="{{route('transfers_records')}}">Transfers Records</a>
                        </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{route('change_password')}}" class="dropdown-item">Change Password</a>
                                @can('isDeveloper')
                                <a href="{{route('route_list')}}" class="dropdown-item">Route List</a>
                                <a href="{{route('department_control')}}" class="dropdown-item">Department Control</a>
                                @endcan
                                @can('isAdmin')
                                <a href="{{route('users_control')}}" class="dropdown-item">Users Control</a>
                                <a href="{{route('product_control')}}" class="dropdown-item">Product Control</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                @endguest
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/axios.min.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>