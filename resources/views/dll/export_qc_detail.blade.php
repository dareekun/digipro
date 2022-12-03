<html>
<head>
    <title>{{$section}} - {{$line}}</title>
</head>
<body>
<table>
    <tr>
        <td>{{$line}}</td>
        <td>Produksi Bulan Sebelumnya</td>
        <td>Tanggal</td>
    </tr>
    @foreach ($data as $dt)
    <tr>
        <td style="font-weight: bold;">{{$dt->model_no}}</td>
        <td>{{$dt->last_month}}</td>
        @for ($i = 1; $i < 32 ; $i++) 
        <td style="background-color: #00ffff;border: 3px solid black;">{{$i}}</td>
        @endfor
    </tr> 
    <tr>
        <td></td>
        <td style="color: red;">Finish Goods</td>
        @foreach ($dt->detail_data as $detail) 
        <td style="border: 1px solid black;">{{$detail->finish_goods}}</td>
        @endforeach
    </tr> 
    <tr>
        <td></td>
        <td style="color: #008000;">Total Lot</td>
        @foreach ($dt->detail_data as $detail) 
        <td style="border: 1px solid black;">{{$detail->lots_ize}}</td>
        @endforeach
    </tr> 
    <tr>
        <td></td>
        <td>Total</td>
        @foreach ($dt->detail_data as $detail) 
        <td style="border: 1px solid black;">{{$detail->total_size}}</td>
        @endforeach
    </tr> 
    @endforeach
</table>
</body>
</html>