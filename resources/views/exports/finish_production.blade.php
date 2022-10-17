<table>
    <thead>
        <tr>
            <th colspan="8">Data Finish Production</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Line</th>
            <th>Model Product</th>
            <th>Lot Number</th>
            <th>Shift</th>
            <th>Lot Size</th>
            <th>Checker</th>
            <th>Judgement</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dt->id}}</td>
            <td>{{$dt->line}}</td>
            <td>{{$dt->model_no}}</td>
            <td>{{date($dt->lotno)}}</td>
            <td>{{$dt->shift}}</td>
            <td>{{$dt->finish_goods}}</td>
            <td>{{$dt->checker}}</td>
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