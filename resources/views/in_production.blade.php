@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Progress Inspection
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Lot Number</th>
                                        <th>Shift</th>
                                        <th>Model Product</th>
                                        <th>Checker</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr>
                                        <td><a href="{{route('show_inspection', $dt->id)}}" style="text-decoration: none;"
                                                target=”_blank”>{{$dt->id}}</a></td>
                                        <td>{{date('Ymd', strtotime($dt->lotno))}}</td>
                                        <td>{{$dt->shift}}</td>
                                        <td>{{$dt->model_no}}</td>
                                        <td>{{$dt->checker}}</td>
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
        dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
    });
});
</script>
@endpush