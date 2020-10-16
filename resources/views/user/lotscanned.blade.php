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
                                    <th>Scanned Date</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Model No</th>
                                    <th scope="col">Lot No</th>
                                    <th scope="col">Shift</th>
                                    <th scope="col">Qty Prod</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->scandate }}</td>
                                    <td>{{ $d->barcode }}</td>
                                    <td>{{ $d->modelno }}</td>
                                    <td>{{ $d->lotno }}</td>
                                    <td>{{ $d->shift }}</td>
                                    <td>{{ $d->input1 }}</td>
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