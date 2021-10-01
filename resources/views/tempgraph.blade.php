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
        <main class="py-1">
        <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Graph Bulanan</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>{{$tipe}}</h3>
                            </div>
                            <!-- <div class="col-md-9" align="right">
                                <a href="/tabel/{{$tipe}}" class="btn-sm btn-secondary" role="button"
                                    aria-pressed="true"><i class="fa fa-table" aria-hidden="true"></i> Tabel</a>
                                <a href="/graph/{{$tipe}}" class="btn-sm btn-success" role="button"
                                    aria-pressed="true"><i class="fa fa-pie-chart" aria-hidden="true"></i> Graph</a>
                            </div> -->
                        </div>
                        <div class="row">
                            <!-- chart 1 -->
                            <div class="col-sm-8">
                                <h5>Total Produksi</h5>
                                <canvas id="chart2"></canvas>
                            </div>
                            <!-- chart 2 -->
                            <div class="col-sm-4">
                                <h5>Bisnis Plan</h5>
                                <canvas id="chart1"></canvas>
                                <br>
                                <table style="margin:auto;" class="w-75">
                                    <tr>
                                        <td align="left"  style="width:105px">
                                            <h5>Data Plan </h5>
                                        </td>
                                        <td> <h5> : </h5></td>
                                        <td align="right"><h5 class="totala">{{array_sum($planning)}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> VS </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <h5> Data Actual </h5>
                                        </td>
                                        <td> <h5> : </h5></td>
                                        <td align="right"><h5 class="totalp">{{array_sum($actual)}}</h5></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <!-- chart 4 -->
                            <div class="col-sm">
                                <table style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal </td>
                                            <td>: {{ date('d F Y') }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table class="table" id="data" style="width:100%" bordered>
                                <tr>
                                <td>Lini</td>
                                @foreach ($lini as $l)
                                <td><a href="/graphbulan/{{$l->tempat}}" style="color:black"><div class="namalini">{{$l->tempat}}</div></a></td>
                                @endforeach
                                </tr>
                                <tr>
                                <td>Planning</td>
                                @foreach ($planning as $p)
                                <td class="dataplan">{{$p}}</td>
                                @endforeach
                                </tr>
                                <tr>
                                <td>Actual</td>
                                @foreach ($actual as $a)
                                <td class="dataactual">{{$a}}</td>
                                @endforeach
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
</div>
    <script type="text/javascript" src="{{ asset('/js/chart2.js') }}"></script>
</body>

</html>
