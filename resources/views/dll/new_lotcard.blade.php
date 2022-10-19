<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/axios.min.js') }}"></script>
    <title>Digipro</title>
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
    <div class="container mt-5">
        <div class="card">
            <div class="card-header" align="center">Lot Card Production Assembly</div>
            <div class="card-body">
                <div class="row">
                    <div class="center">
                        <form action="{{route('add_lotcard')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <table>
                                <tr>
                                    <td>Model No </td>
                                    <td> : </td>
                                    <td> <select name="tipe" id="tipe" class="form-control">
                                            @foreach ($option as $opt)
                                            <option value="{{$opt->id}}">{{$opt->model_no}}</option>
                                            @endforeach
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
                                            <option value="1">Shift 1</option>
                                            <option value="2">Shift 2</option>
                                            <option value="3">Shift 3</option>
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
                                                <td align="right" colspan="2"><button onclick="add()"
                                                        type="button" class="btn btn-outline-success"> Tambah</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">Part Name</td>
                                                <td align="center">No Lot</td>
                                                <td></td>
                                            </tr>
                                            @foreach ($parts as $dt)
                                            <tr id="old_{{$dt->id}}">
                                                <td><input type="text" required class="form-control" name="parts[]"
                                                        value="{{$dt->part_name}}"></td>
                                                <td><input type="date" required class="form-control" name="lot_parts[]"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td>
                                                    <button type="button" name="remove" onclick="remove({{$dt->id}})"
                                                        class="btn btn-danger btn_remove"><i class="fa fa-times-circle"
                                                            aria-hidden="true"></i></button>
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
                                                <td><input type="number" class="form-control" name="input1" value="">
                                                </td>
                                                <td><input type="number" class="form-control" name="ng1" value=""></td>
                                                <td><input type="date" required class="form-control" name="date1"
                                                        value="{{ date('Y-m-d') }}"></td>
                                                <td><input type="text" required class="form-control" name="name1"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td>Packing</td>
                                                <td><input type="number" class="form-control" name="input2" value="">
                                                </td>
                                                <td><input type="number" class="form-control" name="ng2" value=""></td>
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
                                                <td align="right" colspan="2"><a type="button" class="btn btn-outline-danger"
                                                        href="{{route('lotcard_status')}}">Hapus</a>

                                                    <button type="submit" name="masuk"
                                                        class="btn btn-outline-success">Submit</button>
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
    <script>
    var i = 0;
    function add() {
        i++;
        var id = 'new_' + i;
        var table = document.getElementById("dynamic_field");
        var row = table.insertRow()
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = '<input required type="text" name="parts[]" class="form-control">';
        cell2.innerHTML = '<input type="date" required class="form-control" name="lot_parts[]" value="{{ date('Y-m-d') }}">';
        cell3.innerHTML = '<button type="button" onclick="alter('+i+')" class="btn btn-danger btn_remove"><i class="fa fa-times-circle" aria-hidden="true"></i></button>';
        row.setAttribute('id', id);
    }

    function alter(x) {
        var nw = "new_" + x
        document.getElementById("dynamic_field").deleteRow(document.getElementById(nw).rowIndex);
    }

    function remove(uid) {
        // axios.post("{{route('delete_parts')}}", {
        //     id: uid
        // })
        ol = "old_" + uid;
        document.getElementById("dynamic_field").deleteRow(document.getElementById(ol).rowIndex);
    }
    </script>
</body>

</html>