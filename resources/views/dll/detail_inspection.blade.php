<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Inspection Card</title>
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
        width: 100%;
        padding-left: 2pt;
        padding-right: 2pt;
    }

    #table2 {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }

    #table2 tr {
        border: 1px solid black;
    }

    #table2 td {
        border: 1px solid black;
        text-align: center;
    }
    </style>

    <!-- Fonts -->
</head>

<body>
    @foreach ($data as $dt)
    <table id="table1">
        <tr>
            <td colspan="3" align="center">
                <h4>INSPECTION CARD</h4>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="width:100%" id="table2">
                    <tr>
                        <td> Product / Part Name </td>
                        <td> @ Box </td>
                        <td> Total Box</td>
                    </tr>
                    <tr>
                        <td>{{$dt->model_no}} </td>
                        <td>{{$dt->packing}}</td>
                        <td>{{$dt->fg_2}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <p>Status Product</p>
                <h1>{{strtoupper($dt->judgement == 1 ? "OK" : ($dt->judgement == 2 ? "NG" : ($dt->judgement == 3 ? "HOLD" : "STATUS")))}}
                </h1>
            </td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <table style="width:100%">
                    <tr>
                        <td>Inspection Date</td>
                        <td align="right">{{$dt->date}}</td>
                    </tr>
                    <tr>
                        <td>Lot Size</td>
                        <td align="right">{{$dt->fg_1}}</td>
                    </tr>
                    <tr>
                        <td>Lot Number</td>
                        <td align="right">{{$dt->lotno}}</td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td align="right">Shift {{$dt->shift}}</td>
                    </tr>
                    <tr>
                        <td>Section</td>
                        <td align="right">{{$dt->section}}</td>
                    </tr>
                    <tr>
                        <td>Line</td>
                        <td align="right">{{$dt->line}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"> Remark :
                            <p>{{$dt->remark}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>{{$dt->remark}}</p>
                        </td>
                    </tr>
                </table>
                <br>
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
                            <td align="center">Petugas QC</td>
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