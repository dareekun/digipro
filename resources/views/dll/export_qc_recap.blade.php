<html>
<head>
    <title>Rekap Produksi</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        white-space: nowrap;
    }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>OutGoing Inspection and Result {{$tanggal}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Type</td>
            <td>Product</td>
            <td>Total</td>
            <td>Rejected</td>
            <td>Ratio</td>
            <td>Qty</td>
            <td>Qty</td>
            <td>Qty Parts Prod (NG)</td>
            <td></td>
            <td>Total</td>
            <td>Qty</td>
            <td>Ration</td>
            <td>Problem</td>
            <td>Treatment</td>
        </tr>
        <tr>
            <td>Product</td>
            <td>Name</td>
            <td>Lot</td>
            <td>of Lot</td>
            <td>Rejected</td>
            <td>Prod</td>
            <td>Prod (NG)</td>
            <td>Material</td>
            <td>Process</td>
            <td>Parts</td>
            <td>Rejected</td>
            <td>Rejected</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        @foreach ($data as $dt)
        <tr>
            <td>{{$dt->line}}</td>
            <td>{{$dt->model_no}}</td>
            <td>{{$dt->total_lot}}</td>
            <td></td>
            <td></td>
            <td>{{$dt->total_qty}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>GRAND TOTAL</td>
            <td></td>
            <td>{{$grand_total_lot}}</td>
            <td></td>
            <td></td>
            <td>{{$grand_total_qty}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Product</td>
            <td>Lot Number</td>
            <td>Product Line</td>
            <td></td>
            <td></td>
            <td>Qty</td>
            <td>Trouble Content</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Improvement</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>No Model</td>
            <td></td>
            <td></td>
            <td></td>
            <td>(Product)</td>
        </tr>
    </table>
</body>
</html>