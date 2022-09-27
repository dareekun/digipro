@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Finish Production
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Section</th>
                                    <th>Line</th>
                                    <th>Model Product</th>
                                    <th>Lot Number</th>
                                    <th>Shift</th>
                                    <th>Lot Size</th>
                                    <th>Checker</th>
                                    <th>Judgement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$dt->section}}</td>
                                    <td>{{$dt->line}}</td>
                                    <td>{{date($dt->model_no)}}</td>
                                    <td>{{date($dt->lotno)}}</td>
                                    <td>{{$dt->shifts}}</td>
                                    <td>{{$dt->fg_1}}</td>
                                    <td>{{$dt->checker}}</td>
                                    <td>{{$dt->judgjement}}</td>
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