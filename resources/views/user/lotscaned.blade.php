@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lotcard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Lot Card Scanned</h3>
                            </div>
                            <div class="col-md-6" align="right">
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
                                    <th scope="col">Job</th>
                                    <th hidden scope="col">Type</th>
                                    <th scope="col">Assembly</th>
                                    <th hidden scope="col">Class</th>
                                    <th hidden scope="col">Quantity</th>
                                    <th hidden scope="col">Status</th>
                                    <th scope="col">Start Date</th>
                                    <th hidden scope="col">Completion Date</th>
                                    <th hidden scope="col">Transaction Quantity(Quantity Remained)</th>
                                    <th hidden scope="col">From Operation Seq No</th>
                                    <th hidden scope="col">To Operation Seq No</th>
                                    <th scope="col">Overcompletion Quantity</th>
                                    <th scope="col">Transaction Date</th>
                                    <th hidden scope="col">Reference</th>
                                    <th hidden scope="col">Organization ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->Job }}</td>
                                    <td hidden>{{ $d->Type }}</td>
                                    <td>{{ $d->Assembly }}</td>
                                    <td hidden>{{ $d->Class }}</td>
                                    <td hidden>{{ $d->Quantity }}</td>
                                    <td hidden>{{ $d->Status }}</td>
                                    <td>{{ $d->Start_Date }}</td>
                                    <td hidden>{{ $d->Completion_Date }}</td>
                                    <td hidden>{{ $d->Quantity_Remained }}</td>
                                    <td hidden>{{ $d->FromA }}</td>
                                    <td hidden>{{ $d->ToA }}</td>
                                    <td>{{ $d->Overcompletion_Quantity }}</td>
                                    <td>{{ $d->Transaction_Date }}</td>
                                    <td hidden>{{ $d->Reference }}</td>
                                    <td hidden>{{ $d->Organization_ID }}</td>
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
                    if ( table.column(12).search() !== document.getElementById('tanggal').value ) {
                        table
                            .column(12)
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