@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lot Card Scanned</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3" align="right">
                                <table>
                                <tr>
                                <td>Berdasarkan Tanggal</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td><input type="date"  name="tanggal" id="tanggal" class="form-control form-control-sm"></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td><button onclick="reset()" type="submit" class="btn btn-sm btn-outline-success">Reset</button></td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        <table id="excel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">No Lot</th>
                                    <th scope="col">Qty / Box</th>
                                    <th scope="col">Total Box</th>
                                    <th scope="col">Total Qty</th>
                                    <th scope="col">OK / NG</th>
                                    <th scope="col">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->type }}</td>
                                    <td>{{ $d->nolot }}</td>
                                    <td>{{ $d->qtyouter }}</td>
                                    <td>{{ $d->totalbox }}</td>
                                    <td>{{ $d->totalqty }}</td>
                                    <td>{{ $d->totalqty }} / {{ $d->ng }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
@push('scripts')
<script>
$(document).ready(function() {
var table = $('#excel').DataTable({
        order: [[0, 'desc']],
        scrollY: '50vh',
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'excelHtml5',
            text: 'Save as Excel',
            title : null,
            customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row:nth-child(1) c', sheet).attr( 's', '46' );
                exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
            }
            }
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
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
function reset() {
    document.getElementById('tanggal').value = '';
    $('#excel').DataTable().columns().search('').draw();
}
</script>
@endpush