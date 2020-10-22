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
@if($errors->any())
<script>
$(document).ready(function() {
    $("#modallot1").modal('show');
});
</script>
@endif
<body>
    <br>
    <br>
    <div class="container w-50">
        <div class="card">
            <div class="card-header" align="center">Lot Card Production Assembly</div>
            <div class="card-body">
                <div class="row">
                    <div class="center">
                        <form action="/plusalpha" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <table>
                                <tr>
                                    <td>Model No </td>
                                    <td> : </td>
                                    <td> <select name="tipe" id="tipe" class="form-control selectpicker"
                                            data-live-search="true">
                                            <option value="{{$option}}">{{$option}}</option>
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
                                    @foreach ($shift as $sh)
                                            <option value="{{$sh->shift}}">{{$sh->shift}}</option>
                                    @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table style="width:100%" id="dynamic_field">
                                        <tr>
                                        <td></td>
                                        <td align="right" colspan="2"><button name="tambah" id="tambah" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah</button></td>
                                        </tr>
                                            <tr>
                                                <td align="center">Part Name</td>
                                                <td align="center">No Lot</td>
                                                <td></td>
                                            </tr>
                                            @foreach ($data as $dt)
                                            <tr id="rowa{{$i}}">
                                                <td><input type="text" required class="form-control" name="part[]"
                                                        value="{{$dt["c_item_code"]}}"></td>
                                                <td><input type="date" required class="form-control" name="lotpart[]"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                        <td align="center">
                                                        <button type="button" name="remove" id="a{{$i++}}" class="btn btn-danger btn_remove"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </td>
                                            </tr>
                                            @endforeach
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
                                                <td><input type="number" class="form-control" name="input1"
                                                        value=""></td>
                                                <td><input type="number" class="form-control" name="ng1"
                                                        value=""></td>
                                                <td><input type="date" required class="form-control" name="date1"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td><input type="text" required class="form-control" name="name1"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td>Packing</td>
                                                <td><input type="number" class="form-control" name="input2"
                                                        value=""></td>
                                                <td><input type="number" class="form-control" name="ng2"
                                                        value=""></td>
                                                <td><input type="date" required class="form-control" name="date2"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td><input type="text" required class="form-control" name="name2"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td align="right" colspan="2"><button type="button" class="btn btn-danger"
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modallot1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Lotcard Tidak Memiliki Part
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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