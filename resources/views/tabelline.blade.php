@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>{{$tipe}}</h3>
                            </div>
                            <div class="col-md-9" align="right">
                                <a href="/tabel/{{$tipe}}" class="btn-sm btn-secondary" role="button"
                                    aria-pressed="true"><i class="fa fa-table" aria-hidden="true"></i> Tabel</a>
                                <a href="/graph/{{$tipe}}" class="btn-sm btn-success" role="button"
                                    aria-pressed="true"><i class="fa fa-pie-chart" aria-hidden="true"></i> Graph</a>
                            </div>
                        </div>
                        <form action="/downloadpwk" method="post">
                        {{ csrf_field() }}
                        <div class="row mb-2">
                        <div class="col-md-2">
                        <input type="month" class="form-control form-control-sm" name="tahuninput" id="tahuninput">
                        </div>
                        <div class="col-md-2">
                        <select name="lineproduksi" class="form-control form-control-sm" required id="lineproduksi">
                        <option value=""></option>
                        @foreach ($line as $ln)
                        <option value="{{$ln->tempat}}">{{$ln->tempat}}</option>
                        @endforeach
                        </select>
                        </div>
                        <div class="col-md-1">
                        <button type="reset" class="btn btn-sm btn-outline-info" onclick="reset()">Reset</button>
                        </div>
                        <div class="col-md-7" align="right">
                        <button type="submit" href="downloaddata" class="btn btn-sm btn-outline-dark"><i class="fa fa-download" aria-hidden="true"></i> Download Data</button>
                        </div>
                        </div>
                        </form>
                        <table id="test" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Shift</th>
                                    <th scope="col">Line Produksi</th>
                                    <th scope="col">Hasil Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>
                                    <a style="color: #000" href="/detail/{{$d->keyid}}">
                                    {{date('Y-m-d', strtotime($d->tanggal))}}</a></td>
                                    <td>{{ $d->pic }}</td>
                                    <td>{{ $d->shift }}</td>
                                    <td>{{ $d->line }}</td>
                                    <td>{{ $d->hasil }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
var table = $('#test').DataTable({
        order: [[0, 'desc']],
        scrollY: '50vh',
        paging: false,
        info: false,
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                $('#tahuninput').on( 'keyup change clear', function () {
                    if ( table.column(0).search() !== document.getElementById('tahuninput').value ) {
                        table
                            .column(0)
                            .search( this.value )
                            .draw();
                    }
                });
                $('#lineproduksi').on( 'keyup change clear', function () {
                    if ( table.column(3).search() !== document.getElementById('lineproduksi').value ) {
                        table
                            .column(3)
                            .search( this.value )
                            .draw();
                    }
                });
            } );
        }
    });
});
function reset() {
    document.getElementById('tahuninput').value = '';
    document.getElementById('lineproduksi').value = '';
    $('#test').DataTable().columns().search('').draw();
}
</script>
@endsection