<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Permintaan Pemeriksaan Dan Penyerahan Finish Goods</title>
    <style>
    @page {
        margin: 0px;
    }

    html,
    body {
        background-size: cover;
        margin: 5px;
    }

    .center {
        margin: auto;
        align: center;
    }

    #table1 {
        width:100%;
        padding-left: 2pt;
        padding-right: 2pt;
    }

    #table2 {
        width:100%;
        border-collapse: collapse;
        border: 1px solid black;
    }
    #table2 tr {
        border: 1px solid black;
    }
    #table2 td {
        border: 1px solid black;
    }
    </style>

    <!-- Fonts -->
</head>

<body>
    
    @foreach ($data as $dt)
    <table id="table1">
        <tr>
            <td colspan="3" align="center">
                <h4>Lot Card Production</h4>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="width:100%">
                    <tr>
                        <td> Model No </td>
                        <td> : </td>
                        <td> {{$dt->model_no}}</td>
                    </tr>
                    <tr>
                        <td>Lot No </td>
                        <td> : </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Shift </td>
                        <td> : </td>
                        <td> Shift {{$dt->shift}}</td>
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
                        <td align="left">Part Name</td>
                        <td align="right" style="width:25%">No Lot</td>
                    </tr>
                    @foreach (json_decode($dt->parts) as $pts)
                    <tr>
                        <td align="left" style="font-size: 13px;">{{$pts->parts}}</td>
                        <td align="right" style="font-size: 13px;">{{date('d/m/Y', strtotime($pts->lot_parts))}}</td>
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
                <table id="table2">
                    <tr>
                        <td align="center">Input</td>
                        <td align="center">NG</td>
                        <td align="center">Date</td>
                        <td align="center">Name</td>
                    </tr>
                    <tr>
                        <td align="center">{{$dt->fg_1}}</td>
                        <td align="center">{{$dt->ng_1}}</td>
                        <td align="center">
                            {{date('d/m/Y', strtotime($dt->date_1))}}</td>
                        <td align="center">{{$dt->name_1}}</td>
                    </tr>
                    <tr>
                        <td align="center">{{$dt->fg_2}}</td>
                        <td align="center">{{$dt->ng_2}}</td>
                        <td align="center">
                            {{date('d/m/Y', strtotime($dt->date_2))}}</td>
                        <td align="center">{{$dt->name_2}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:40%">
                <center>
                    {!!DNS2D::getBarcodeHTML($dt->barcode, 'QRCODE',5,5)!!}
                </center>
            </td>
            <td colspan="2">
                <center>
                    <table style="width:100%" id="table2">
                        <tr>
                            <td align="center">Judgement</td>
                        </tr>
                        <tr>
                            <td><br><br><br></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>
    @endforeach
</body>

</html>