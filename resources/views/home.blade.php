@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <b>Jumlah Produksi</b>
                        </div>
                        <div class="col-md-10" align="right">
                            {{ date('Y-m-d') }} // <span id="MyClockDisplay" class="clock" onload="showTime()"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <select class="form-control form-control-sm" id="lineproduksi">
                                <option value=""></option>
                                @foreach ($lini as $ln)
                                <option value="{{$ln->tempat}}">{{$ln->tempat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="reset" class="btn btn-sm btn-outline-info" onclick="reset()">Reset</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="test" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>Lini</th>
                                    <th>Tipe</th>
                                    <th>Plan Produksi</th>
                                    <th>Jumlah Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($summary as $sum)
                                <tr>
                                    <td>{{$sum[0]}}</td>
                                    <td>{{$sum[1]}}</td>
                                    <td>{{$sum[2]}} Pcs</td>
                                    <td>{{$sum[3]}} Pcs</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<!-- script separator -->
<script>
function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    var time = h + ":" + m + ":" + s;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    setTimeout(showTime, 1000);
}
showTime();
</script>

<script>
$(document).ready(function() {
    var table = $('#test').DataTable({
        order: [
            [0, 'asc']
        ],
        info: false,
        initComplete: function() {
            // Apply the search
            this.api().columns().every(function() {
                $('#lineproduksi').on('keyup change clear', function() {
                    if (table.column(0).search() !== document.getElementById(
                            'lineproduksi').value) {
                        table
                            .column(0)
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
});

function reset() {
    document.getElementById('lineproduksi').value = '';
    $('#test').DataTable().columns().search('').draw();
}
</script>
@endpush