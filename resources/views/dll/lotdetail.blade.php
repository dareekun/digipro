<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <title>Cetak Lot Card</title>
    <style>
    @page { margin: 0px; }
    html,
    body {
        background-size: cover;
        margin: 0px;
    }

    .center {
        margin: auto;
        align: center;
    }

    table,
    th,
    td {
        padding-left: 2pt;
        padding-right: 2pt;
    }
    </style>

    <!-- Fonts -->
</head>

<body>
    @foreach ($data as $dt)
    <table style="border:1px solid black">
        <tr>
            <td colspan="3" align="center">
                <h5>Lot Card Production Assembly</h5>
            </td>
        </tr>
        <tr>
        <td colspan="3" >
        <table style="width:100%">
        <tr>
            <td> Model No </td>
            <td> : </td>
            <td> {{$dt->modelno}}</td>
        </tr>
        <tr>
            <td>Lot No </td>
            <td> : </td>
            <td> {{date('Ymd', strtotime($dt->lotno))}}</td>
        </tr>
        <tr>
            <td>Shift </td>
            <td> : </td>
            <td> {{$dt->shift}}</td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        </table>
        </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="width:100%">
                    <tr>
                        <td align="center">Part Name</td>
                        <td align="center">No Lot</td>
                    </tr>
                    @foreach ($data1 as $dt1)
                    <tr>
                        <td align="center">{{$dt1->partname}}</td>
                        <td align="center">{{date('d m Y', strtotime($dt1->nolot))}}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <table style="border:1px">
                    <tr style="border:1px">
                        <td style="border:1px solid black">Proccess</td>
                        <td style="border:1px solid black" align="center">Input</td>
                        <td style="border:1px solid black" align="center">NG</td>
                        <td style="border:1px solid black" align="center">Date</td>
                        <td style="border:1px solid black" align="center">Name</td>
                    </tr>
                    <tr style="border:1px">
                        <td style="border:1px solid black">Assembly</td>
                        <td style="border:1px solid black" align="center">{{$dt->input1}}</td>
                        <td style="border:1px solid black" align="center">{{$dt->ng1}}</td>
                        <td style="border:1px solid black" align="center">{{date('d m Y', strtotime($dt->date1))}}</td>
                        <td style="border:1px solid black" align="center">{{$dt->name1}}</td>
                    </tr>
                    <tr style="border:1px">
                        <td style="border:1px solid black">Packing</td>
                        <td style="border:1px solid black" align="center">{{$dt->input2}}</td>
                        <td style="border:1px solid black" align="center">{{$dt->ng2}}</td>
                        <td style="border:1px solid black" align="center">{{date('d m Y', strtotime($dt->date2))}}</td>
                        <td style="border:1px solid black" align="center">{{$dt->name2}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        <td style="width:30%">
        </td>
        <td style="width:30%">
        <center>
            <br>
            {!!DNS2D::getBarcodeHTML($dt->barcode, 'QRCODE',5,5)!!}
            <br>
        </center>
        </td>
        <td style="width:30%">
        </td>
        </tr>
    </table>
    @endforeach
</body>

</html>