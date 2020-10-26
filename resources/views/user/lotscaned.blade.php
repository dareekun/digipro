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
                                <h3>Lot Card Scanned {{$date}}</h3>
                            </div>
                            <div class="col-md-6" align="right">
                                <form action="/lotscaned" method="post">
                                {{ csrf_field() }}
                                <table>
                                <tr>
                                <td>Berdasarkan Tanggal</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td><input type="date" name="scandate" value="{{date('Y-m-d')}}" class="form-control form-control-sm"></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td><input type="submit" value="Cari" class="btn btn-sm btn-outline-success"></td>
                                </tr>
                                </table>
                                </form> 
                            </div>
                        </div>
                        <table id="excel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Scanned Date</th>
                                    <th scope="col">Job ID</th>
                                    <th scope="col">Model No</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->Transaction_Date }}</td>
                                    <td>{{ $d->Job }}</td>
                                    <td>{{ $d->Assembly }}</td>
                                    <td>{{ $d->Overcompletion_Quantity }}</td>
                                    <td>{{ $d->Status }}</td>
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
            $('#excel').DataTable({
                order: [[0, 'desc']],
                scrollY: '50vh',
                paging: false,
                info: false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                ]
            });
        });
    </script>
@endpush