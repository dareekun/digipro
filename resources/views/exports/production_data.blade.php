<table>
    <thead>
        <tr>
            <th colspan="9">Production Data History</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Lot Number</th>
            <th>Shift</th>
            <th>Model Product</th>
            <th>FG</th>
            <th>NG</th>
            <th>PIC</th>
            <th>Judgement</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dt->id}}</td>
            <td>{{date('Ymd', $dt->lotno)}}</td>
            <td>{{$dt->shift}}</td>
            <td>{{$dt->model_no}}</td>
            <td>{{$dt->finish_goods}}</td>
            <td>{{$dt->not_goods}}</td>
            <td>{{$dt->pic}}</td>
            <td>
                @if ($dt->judgement == 1)
                OK
                @elseif ($dt->judgement == 2)
                NG
                @else
                HOLD
                @endif</td>
        </tr>
        @endforeach
    </tbody>
</table>