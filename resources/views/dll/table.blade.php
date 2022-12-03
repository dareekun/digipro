<html>

<head>
    <title>Data PWK</title>
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
    @foreach ($data as $dt)
    <tr>
        <td>{{$dt->model_no}}</td>
        @foreach ($dt->detail_data as $detail)
        <td>
            {{$detail->finish_goods}}
        </td>
        @endforeach
    </tr>
    @endforeach
</table>
</body>