@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Transfered Data
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12"><a class="btn btn-outline-primary"
                                href="{{route('download_data', 'transfers_record')}}">Download Data</a></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Reference Number</th>
                                        <th>Generated Date</th>
                                        <th>Item type</th>
                                        <th>Item Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="{{route('show_pdf_form', $dt->refer)}}" style="text-decoration: none;" target="_blank">{{$dt->refer}}</a></td>
                                        <td>{{date($dt->transfers_date)}}</td>
                                        <td>{{$dt->item_type}}</td>
                                        <td>{{$dt->item_qty}}</td>
                                        <td>{{$dt->status}}</td>
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
<script>
$(document).ready(function() {
    var table = $('#table_records').DataTable({
        order: [
            [2, 'desc']
        ],
        dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
    });
});
</script>
@endpush