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
                            <a class="nav-link" href="/plan">Setup Plan Monthly</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/plan2">Setup Plan Daily</a>
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
                                        <label>Pilih Bulan</label>
                                        <select class="form-control" name="tipe" id="tipe">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label>Tipe Produk</label>
                                        <input type="number" required class="form-control" id="frm2" name="tipe"
                                            placeholder="Masukan Tipe Produk">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label>Qty Planning </label>
                                        <div class="row">
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty1"
                                                    placeholder="1">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty2"
                                                    placeholder="2">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty3"
                                                    placeholder="3">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty4"
                                                    placeholder="4">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty5"
                                                    placeholder="5">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty6"
                                                    placeholder="6">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty7"
                                                    placeholder="7">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty8"
                                                    placeholder="8">
                                            </div>
                                        </div>
                                        <!-- row 2 --> <br>
                                        <div class="row">
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty9"
                                                    placeholder="9">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty10"
                                                    placeholder="10">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty11"
                                                    placeholder="11">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty12"
                                                    placeholder="12">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty13"
                                                    placeholder="13">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty14"
                                                    placeholder="14">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty15"
                                                    placeholder="15">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty16"
                                                    placeholder="16">
                                            </div>
                                        </div>
                                        <!-- row 3 --> <br>
                                        <div class="row">
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty17"
                                                    placeholder="17">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty18"
                                                    placeholder="18">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty19"
                                                    placeholder="19">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty20"
                                                    placeholder="20">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty21"
                                                    placeholder="21">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty22"
                                                    placeholder="22">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty23"
                                                    placeholder="23">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty24"
                                                    placeholder="24">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- row4 -->
                                    <div class="row">
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty25"
                                                    placeholder="25">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty26"
                                                    placeholder="26">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty27"
                                                    placeholder="27">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty28"
                                                    placeholder="28">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty29"
                                                    placeholder="29">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty30"
                                                    placeholder="30">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" required class="form-control" name="qty31"
                                                    placeholder="31">
                                            </div>
                                            <div class="col-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
<br>
                                <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>

</html>