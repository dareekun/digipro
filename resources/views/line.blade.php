<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/chart.js') }}"></script>
    <title>Input Produksi</title>
</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/{{$tipe}}">{{$tipe}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="/{{$tipe}}">Rekap Data <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="{{$tipe}}/total">Total Data</a>
                <a class="nav-item nav-link" href="{{$tipe}}/harian">Input Harian</a>
                <a class="nav-item nav-link" href="{{$tipe}}/bulanan">Data Bulanan</a>
                <a class="nav-item nav-link" href="{{$tipe}}/setup">Setup</a>
            </div>
        </div>
    </nav>
    <div class="container-md">
        <!-- row chart 1 -->
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
                <table style="margin:auto;">
                <tr>
                <td align="center"><h5>Data Plan </h5></td>
                </tr>
                <tr>
                <td align="center"> VS </td>
                </tr>
                <tr>
                <td align="center"><h5> Data Actual</h5></td>
                </tr>
                </table>
            </div>
        </div>
        <!-- row chart 2 -->
        <div class="row">
            <!-- chart 4 -->
            <div class="col-sm">
                <h5>Keterangan</h5>
                <table class="table table-bordered" style="width:100%">
                    <tbody>
                        <tr>
                            <td>Tanggal </td>
                            <td>: {{ date('d-m-Y') }} </td>
                            <td rowspan="2" align="center"><br><h4>Data Tipe</h4></td>
                        </tr>
                        <tr>
                            <td>Hari </td>
                            <td>: {{ date('l') }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/chart2.js') }}"></script>
</body>

</html>