<table>
    <thead>
        <tr>
            <th colspan="8">Data Transfers Records</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Reference Number</th>
            <th>Barcode Number</th>
            <th>Model Number</th>
            <th>Lot Number</th>
            <th>Transfers Date</th>
            <th>Item type</th>
            <th>Item Qty</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dt->refer}}</td>
            <td>{{$dt->barcode}}</td>
            <td>{{$dt->model_no}}</td>
            <td>{{$dt->lot_no}}</td>
            <td>{{date($dt->transfers_date)}}</td>
            <td>{{$dt->item_type}}</td>
            <td>{{$dt->item_qty}}</td>
        </tr>
        @endforeach
    </tbody>
</table>