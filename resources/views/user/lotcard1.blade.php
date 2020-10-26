@extends('layouts.app')

@section('content')
@if($errors->any())
<script>
$(document).ready(function() {
    $("#modallot1").modal('show');
});
</script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lotcard</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10" align="left">
                                <table>
                                    <tr>
                                        <td><select name="bagian" class="form-control form-control-sm" id="bagian">
                                                <option value=""></option>
                                                @foreach($bagian as $l)
                                                <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select required class="form-control form-control-sm" style="width:150px" name="tempat" id="tempat">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}" name="tanggal" id="tanggal">
                                        </td>
                                        <td>
                                        <button class="btn btn-sm btn-dark" onclick="reset()">Reset</button>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                        <div class="col-md-2" align="right">
                            <a href="/lotcard0" class="btn btn-sm btn-success" role="button" target="_blank"
                                aria-pressed="true"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Lotcard</a>
                        </div>
                    </div>
                    <br>
                    <table id="test" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Main</th>
                                <th scope="col">Model No</th>
                                <th scope="col">Lot No</th>
                                <th scope="col">PIC</th>
                                <th scope="col">FG \ NG </th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->tempat }}</td>
                                <td><a style="color: #000" target="_blank" href="/cetaklot/{{$d->barcode}}">
                                        {{ $d->modelno }}</a></td>
                                <td>{{ $d->lotno }} &nbsp; {{ $d->shift }}</td>
                                <td>{{ $d->name2 }}</td>
                                <td>{{ $d->input1 }} \ {{ $d->ng1 }}</td>
                                <td>
                                    @if($d->status==0)
                                    <button class="btn btn-sm btn-outline-success" type="button" role="button"
                                        aria-pressed="true"><i class="fa fa-square-o" aria-hidden="true"></i></button>
                                    @else
                                    <button class="btn btn-sm btn-success" type="button" role="button"
                                        aria-pressed="true"><i class="fa fa-check-square-o"
                                            aria-hidden="true"></i></button>
                                    @endif
                                    @can('isAdmin')
                                    <a href="/dellot/{{$d->barcode}}" class="btn btn-sm btn-outline-danger"><i
                                            class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @endcan
                                    @if($d->status==0)
                                    <a href="/rubahlot/{{$d->barcode}}" target="_blank" class="btn btn-sm btn-outline-info"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    @else
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Lot Card -->
<div id="modallot1" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title">Error Lot Card</h5>
        <button type="button" class="close" data-dismiss="modal" data-toggle="modal"
                    data-target="#modallot2" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <div class="modal-body">
                    <p>Lot Card Error, Sudah Diproses Tidak Dapat Diedit
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal"
                    data-target="#modallot2">Oke</button>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')
<script>
$(document).ready(function() {
var table = $('#test').DataTable({
        order: [[0, 'desc']],
        scrollY: '50vh',
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                $('#tempat').on( 'keyup change clear', function () {
                    if ( table.column(0).search() !== document.getElementById('tempat').value ) {
                        table
                            .column(0)
                            .search( this.value )
                            .draw();
                    }
                } );
                $('#tanggal').on( 'keyup change clear', function () {
                    if ( table.column(2).search() !== document.getElementById('tanggal').value ) {
                        table
                            .column(2)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );
$(function() {
    $('#bagian').on('change', function() {
        axios.post('{{ route('data1-json.data1') }}', {
                    bag: $(this).val()
                })
            .then(function(response) {
                $('#tempat').empty();
                $('#tipe').empty();

                $.each(response.data, function(tempat, tempat) {
                    $('#tempat').append(new Option(tempat, tempat))
                })
            });
    });
});
function reset() {
    document.getElementById('bagian').value = '';
    document.getElementById('tempat').value = '';
    document.getElementById('tanggal').value = '';
    $('#test').DataTable().columns().search('').draw();
}
</script>
@endpush