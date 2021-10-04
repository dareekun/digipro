<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <title>Manage</title>
    <style>
    html,
    body {
        background-image: url("{{ asset('/img/bg.png') }}");
        background-size: cover;
    }
    .center {
        margin: auto;
    }
    </style>
</head>
<body>
    <br>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">Lot Card Production</div>
            <div class="card-body">
                <div class="row">
                    <div class="center">
                        <form action="/lotcard1" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <table>
                                <tr>
                                    <td colspan="3" align="center">Lot Card Production</td>
                                </tr>
                                <tr>
                                    <td>Model No </td>
                                    <td> : </td>
                                    <td> <select name="tipe" id="tipe" class="form-control selectpicker"
                                            data-live-search="true">
                                            <option value="{{$tipe}}">{{$tipe}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Lot No </td>
                                    <td> : </td>
                                    <td> <input type="date" class="form-control" name="tanggal"
                                            value="{{ date('Y-m-d') }}"></td>
                                </tr>
                                <tr>
                                    <td>Shift </td>
                                    <td> : </td>
                                    <td> <select class="form-control" name="shift" id="shift">
                                            <option value="{{$shift}}">{{$shift}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table style="width:100%" id="dynamic_field">
                                            <tr>
                                                <td>Part Name</td>
                                                <td>No Lot</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" required class="form-control" name="part[]"
                                                        value=""></td>
                                                <td><input type="date" required class="form-control" name="lotpart[]"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td align="center"><button name="tambah" id="tambah" type="button" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table>
                                            <tr>
                                                <td>Proccess</td>
                                                <td align="center">Input</td>
                                                <td align="center">NG</td>
                                                <td align="center">Date</td>
                                                <td align="center">Name</td>
                                            </tr>
                                            <tr>
                                                <td>Assembly</td>
                                                <td><input type="number" required class="form-control" name="input1"
                                                        value="{{$qty}}"></td>
                                                <td><input type="number" required class="form-control" name="ng1"
                                                        value="{{$ng}}"></td>
                                                <td><input type="date" required class="form-control" name="date1"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td><input type="text" required class="form-control" name="name1"
                                                        value="{{$name}}"></td>
                                            </tr>
                                            <tr>
                                                <td>Packing</td>
                                                <td><input type="number" required class="form-control" name="input2"
                                                        value="{{$qty2}}"></td>
                                                <td><input type="number" required class="form-control" name="ng2"
                                                        value="{{$ng}}"></td>
                                                <td><input type="date" required class="form-control" name="date2"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td><input type="text" required class="form-control" name="name2"
                                                        value="{{$name}}"></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td align="right"><button type="button" class="btn btn-danger"
                                                        data-dismiss="modal" data-toggle="modal"
                                                        data-target="kembali">Hapus</button>

                                                    <button type="submit" name="masuk"
                                                        class="btn btn-success">Submit</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Untuk Modal -->
                            <!-- Minggir Kalian Semua -->
                            <!-- Commentnya Tiga Baris -->
                            <!-- Empat Dong, Biar Enak Ngeliatnya -->

                            <div class="modal fade" id="kembali" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="modalText">
                                            Apakah Anda Yakin Ingin Kembali?
                                            Data Akan Dihapus
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tidak</button>
                                            <button type="submit" name="hapus"
                                                class="btn btn-danger">Konfirmasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Untuk Batas Modal -->
                            <!-- Minggir Kalian Semua -->
                            <!-- Commentnya Tiga Baris -->
                            <!-- Nambah Satu lah, Biar Enak Ngeliatnya -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        var i = 1;
        $('#tambah').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input required type="text" name="part[]" class="form-control"></td><td><input type="date" required class="form-control" name="lotpart[]" value="{{ date('Y-m-d') }}"></td><td align="center"><button type="button" name="remove" id="' +
                i +
                '" class="btn btn-danger btn_remove"><i class="fa fa-times-circle" aria-hidden="true"></i></button></td></tr>'
                );
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
    </script>
</body>

</html>