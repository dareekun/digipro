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
                            <p class="card-text"> <a href="line" style="width: 150px;" class="btn btn-success">Line
                                    Setup</a> </p>
                            <p class="card-text"> <a href="plan" style="width: 150px;" class="btn btn-primary">Planning
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
                <div class="card-header">Line Setup</div>
                <div class="card-body" style="height:450px">
                <form action="submit" name="check" method="post">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" required id="lokasi" class="form-control" name="lokasi"
                                        placeholder="Masukan Nama Lokasi">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipe</label>
                                    <input type="text" required class="form-control" id="tipe" name="tipe"
                                        placeholder="Masukan Nama Tipe">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Qty Inner</label>
                                    <input type="number" required class="form-control" id="qtyinner" name="qtyinner"
                                        placeholder="Masukan Qty Inner">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Qty Outer</label>
                                    <input type="number" required class="form-control" id="qtyouter" name="qtyouter"
                                        placeholder="Masukan Qty Outer">
                                </div>
                            </div>
                        </div>
                        <div id="pic"></div>
                        <small class="form-text text-muted">Pastikan data yang di input sudah benar, sebelum di
                            submit</small>
                        <br>
                        <button type="button" onclick="pass()" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Submit
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah data yang anda masukan sudah benar?</h5>
                                    <Table>
                                        <tr>
                                            <td id="clrtipe">Tipe </td>
                                            <td>: </td>
                                            <td id="rsltpic"></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="clrlokasi">Lokasi </td>
                                            <td>: </td>
                                            <td id="rslttanggal"></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="clrinn">Qty Inner</td>
                                            <td>: </td>
                                            <td id="rsltshift"></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="clrout">Qty Outer </td>
                                            <td>: </td>
                                            <td id="rslttipe"></td>
                                            </td>
                                        </tr>
                                    </Table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="linesubmit" class="btn btn-success">Ya</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>

</html>