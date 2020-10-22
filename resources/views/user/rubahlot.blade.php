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
    <div class="container w-50">
        <div class="card">
            <div class="card-header" align="center">Lot Card Production Assembly</div>
            <div class="card-body">
                <div class="row">
                    <div class="center">
                    @foreach ($master as $m)
                        <form action="/rubahlots" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <input type="text" hidden value="{{$m->barcode}}" name="keyid" id="keyid">
                            <table>
                                <tr>
                                    <td>Model No </td>
                                    <td> : </td>
                                    <td> <select name="tipe" id="tipe" class="form-control selectpicker"
                                            data-live-search="true">
                                            <option value="{{$m->modelno}}">{{$m->modelno}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Lot No </td>
                                    <td> : </td>
                                    <td> <input type="date" disabled class="form-control" name="tanggal"
                                            value="{{$m->lotno}}"></td>
                                </tr>
                                <tr>
                                    <td>Shift </td>
                                    <td> : </td>
                                    <td> <select class="form-control" name="shift" id="shift">
                                            <option value="{{$m->shift}}">{{$m->shift}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table style="width:100%" id="dynamic_field">
                                            <tr>
                                                <td align="center">Part Name</td>
                                                <td align="center">No Lot</td>
                                            </tr>
                                            @foreach ($data as $dt)
                                            <tr id="rowa{{$i}}">
                                                <td><input type="text" disabled required class="form-control" name="part[]"
                                                        value="{{$dt->partname}}"></td>
                                                <td><input type="date" disabled required class="form-control" name="lotpart[]"
                                                        value="{{$dt->nolot}}"></td>
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
                                                <td><input type="number" required class="form-control" name="input1"
                                                        value="{{$m->input1}}"></td>
                                                <td><input type="number" required class="form-control" name="ng1"
                                                        value="{{$m->ng1}}"></td>
                                                <td><input type="date" required class="form-control" name="date1"
                                                        value="{{$m->date1}}"></td>
                                                <td><input type="text" required class="form-control" name="name1"
                                                        value="{{$m->name1}}"></td>
                                            </tr>
                                            <tr>
                                                <td>Packing</td>
                                                <td><input type="number" required class="form-control" name="input2"
                                                        value="{{$m->input2}}"></td>
                                                <td><input type="number" required class="form-control" name="ng2"
                                                        value="{{$m->ng2}}"></td>
                                                <td><input type="date" required class="form-control" name="date2"
                                                        value="{{$m->date2}}"></td>
                                                <td><input type="text" required class="form-control" name="name2"
                                                        value="{{$m->name2}}"></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td align="right" colspan="2">
                                                    <button type="submit" name="masuk"
                                                        class="btn btn-success">Simpan Perubahan</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        @endforeach
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