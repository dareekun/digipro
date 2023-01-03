<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Permintaan Pemeriksaan Dan Penyerahan Finish Goods</title>
    <style>
    @page {
        margin: 2px;
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
    }
    </style>

    <!-- Fonts -->
</head>

<body>
    <table style="width:100%; border: 1px solid black;">
        <tr>
            <td colspan="2" align="center">
                <h3>FORM PERMINTAAN PEMERIKSAAN DAN PENYERAHAN FINISH GOOD</h3>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Tanggal Produksi: {{date('Y - m - d', strtotime($tanggal))}}</h4>
            </td>
            <td>
                <table id="table2">
                    <tr>
                        <td align="center" colspan="2" style="width:50%">Petugas PC</td>
                        <td align="center" colspan="2" style="width:50%">Petugas Produksi</td>
                    </tr>
                    <tr>
                        <td><br><br><br></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><br></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table id="table2">
                    <tr>
                        <td align="center" style="width:10px">No</td>
                        <td align="center" style="width:200px">Tipe Produk</td>
                        <td align="center">No Lot</td>
                        <td align="center">Shift</td>
                        <td align="center">Packing</td>
                        <td align="center">Total Box</td>
                        <td align="center">Total Qty</td>
                        <td align="center">Keterangan</td>
                    </tr>
                    @foreach ($domestic as $dom)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$dom->model_no}}</td>
                        <td align="center">{{date('Ymd', strtotime($dom->lotno))}}</td>
                        <td align="center">{{$dom->shift}}</td>
                        <td align="center">{{$dom->packing}}</td>
                        <td align="center">{{$dom->total_box}}</td>
                        <td align="center">{{$dom->total_qty}}</td>
                        <td>{{$dom->remark}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Export</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($export as $exp)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$exp->model_no}}</td>
                        <td align="center">{{date('Ymd', strtotime($exp->lotno))}}</td>
                        <td align="center">{{$exp->shift}}</td>
                        <td align="center">{{$exp->packing}}</td>
                        <td align="center">{{$exp->total_box}}</td>
                        <td align="center">{{$exp->total_qty}}</td>
                        <td>{{$exp->remark}}</td>
                    </tr>
                    @endforeach
                    @for($n = $i ; $n < 32; $n++)
                    <tr>
                        <td>{{$n}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width:100%">
                    <tr>
                        <td>
                            <b>Catatan : </b><br>
                            <span style="font-size: 12px">1. Pengecekan hasil transfers produksi shift 1 dilakukan oleh
                                Group Leader Shift 1</span><br>
                            <span style="font-size: 12px">2. Pengecekan hasil transfers produksi shift 2 dilakukan oleh
                                Line Leader Shift 3</span><br>
                            <span style="font-size: 12px">3. Pengecekan hasil transfers produksi shift 3 dilakukan oleh
                                Group Leader Shift 1</span><br>
                            <span style="font-size: 12px">4. Setelah petugas produksi selesai input hasil produksi, form
                                diserahkan kepada PC</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <center>PT. Panasonic Gobel Life Solutions Manufacturing Indonesia</center>
</body>

</html>