@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Lotcard Status
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
                                    <th>Lot Number</th>
                                    <th>Shift</th>
                                    <th>Model Product</th>
                                    <th>FG</th>
                                    <th>NG</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{date($dt->lotno)}}</td>
                                    <td>{{$dt->shifts}}</td>
                                    <td>{{$dt->model_no}}</td>
                                    <td>{{$dt->finish_goods}}</td>
                                    <td>{{$dt->no_goods}}</td>
                                    <td>{{$dt->pic}}</td>
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