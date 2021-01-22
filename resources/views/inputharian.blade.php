<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bundle.js') }}"></script>
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
                <a class="nav-item nav-link active" href="/{{$tipe}}">Rekap Data <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="{{$tipe}}/total">Total Data</a>
                <a class="nav-item nav-link" href="{{$tipe}}/harian">Input Harian</a>
                <a class="nav-item nav-link" href="{{$tipe}}/bulanan">Data Bulanan</a>
                <a class="nav-item nav-link" href="{{$tipe}}/setup">Setup</a>
            </div>
        </div>
    </nav>
    <br>
    <h2 style="text-align:center">Input Data Line 1</h2>
    <br>
    <form action="submit" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input type="date" id="tanggal" value="{{ date('Y-m-d') }}" class="form-control" name="tanggal">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleInputEmail1">PIC</label>
                        <input type="text" required class="form-control" id="pic" name="pic"
                            placeholder="Masukan Nama PIC">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shift</label>
                        <select class="form-control" id="shift" name="shift">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipe Produk</label>
                        <select class="form-control" name="tipe" id="tipe">
                            <option>1</option>
                            <option>2</option>
                            <option>1</option>
                            <option>2</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Produksi</label>
                        <input type="number" id="hasil" name="hasil" required class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div id="pic"></div>
            <small class="form-text text-muted">Pastikan data yang di input sudah benar, sebelum di submit</small>
            <br>
            <button type="button" onclick="oper()" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModalCenter">
                Submit
            </button>
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
                                    <td>PIC </td>
                                    <td>: </td>
                                    <td id="rsltpic"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shift </td>
                                    <td>: </td>
                                    <td id="rsltshift"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal </td>
                                    <td>: </td>
                                    <td id="rslttanggal"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tipe Produk </td>
                                    <td>: </td>
                                    <td id="rslttipe"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hasil Produksi </td>
                                    <td>: </td>
                                    <td id="rslthasil"></td>
                                    </td>
                                </tr>
                            </Table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-success">Ya</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>