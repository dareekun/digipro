@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row my-2">
        <div class="col-md-12">
            @if (session()->has('alerts'))
            <div class="alert {{ session('alerts.type') }} alert-dismissible fade show" role="alert">
                {{ session('alerts.message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Transaction Data
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="row justify-content-center">
                            <div class="col-md-12"><a class="btn btn-outline-primary" href="{{route('generate_data')}}">Generate Data</a></div>
                        </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
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
                                    <td>{{date($dt->lotno)}}</td>
                                    <td>{{$dt->shift}}</td>
                                    <td>{{$dt->model_no}}</td>
                                    <td>{{$dt->fg_1}}</td>
                                    <td>{{$dt->ng_1}}</td>
                                    <td>{{$dt->name_1}}</td>
                                    <td>
                                    @if ($dt->judgement == 1) 
                                    <span class="text-success">GOOD</span> <i class="fa fa-check text-success" aria-hidden="false"></i>
                                    @elseif ($dt->judgement == 2) 
                                    <span class="text-danger">NO GOOD</span> <i class="fa fa-times text-danger" aria-hidden="false"></i>
                                    @else 
                                    <span class="text-warning">HOLD</span> <i class="fa fa-exclamation text-warning" aria-hidden="false"></i>
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