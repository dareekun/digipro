<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Produksi</title>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/chartjs-plugin-datalabels.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
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
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>{{$tipe}}</h4>
                        </div>
                        <div class="col-md-9" align="right">
                        {{ date('d F Y') }}
                        </div>
                    </div>    
                    </div>
                    <div class="card-body">
                        <div style="height:70vh">
                        <canvas id="Chart1"></canvas>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <!-- chart 4 -->
                            <div class="col-sm">
                                <table class="table" hidden id="data" style="width:100%" bordered>
                                <tr>
                                <td>Lini</td>
                                @foreach ($lini as $l)
                                <td><a href="/graphbulan/{{$l->tempat}}" style="color:black"><div class="namalini">{{$l->tempat}}</div></a></td>
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
