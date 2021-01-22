<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <title>Setup Data</title>
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
                <a class="nav-item nav-link active" href="/{{$tipe}}">Rekap Data</a>
                <a class="nav-item nav-link" href="{{$tipe}}/total">Total Data</a>
                <a class="nav-item nav-link" href="{{$tipe}}/harian">Input Harian</a>
                <a class="nav-item nav-link" href="{{$tipe}}/bulanan">Data Bulanan</a>
                <a class="nav-item nav-link" href="{{$tipe}}/setup">Setup</a>
            </div>
        </div>
    </nav>
    <br>
    <div class="row">
        <!-- menu -->
        <div class="col-md-2">
            <!-- 1 -->
            <div class="row">
                <div class="col-md">
                    <div class="card mb-3" style="max-width: 13rem;">
                        <div class="card-header">Setup Line</div>
                        <div class="card-body" style="height:450px">
                            <p class="card-text"> <a href="setup" style="width: 150px;" class="btn btn-primary">Line
                                    List</a> </p>
                            <p class="card-text"> <a href="line" style="width: 150px;" class="btn btn-primary">Line
                                    Setup</a> </p>
                            <p class="card-text"> <a href="plan" style="width: 150px;" class="btn btn-success">Planning
                                    Setup</a> </p>
                            <p class="card-text"> <a href="404" style="width: 150px;" class="btn btn-primary">Data
                                    Kosong</a> </p>
                            <p class="card-text"> <a href="404" style="width: 150px;" class="btn btn-primary">Data
                                    Kosong</a> </p>
                            <p class="card-text"> <a href="/" style="width: 150px;" class="btn btn-danger">Back</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- isi dan setup -->
        <div class="col-md-10">
            <div class="card mb-3" style="max-width: 70rem;">
                <!-- Header -->
                    <div class="card-header" style="height:50px">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="/plan">Setup Plan Monthly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/plan2">Setup Plan Daily</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tutup header -->
                    <div class="card-body" style="height:450px">
                        <form action="submit" name="check" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="month" required id="frm1" class="form-control" name="tanggal" placeholder="Masukan Nama Lokasi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label>Tipe Produk</label>
                                            <input type="number" required class="form-control" id="frm2" name="tipe"
                                                placeholder="Masukan Tipe Produk">
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" required class="form-control" id="frm3" name="qty"
                                                placeholder="Masukan Qty Planning">
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Pastikan data yang di input sudah benar, sebelum di
                                    submit</small>
                                <br>
                                <button type="submit" id="subdsb" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>

</html>