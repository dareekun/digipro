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
                            Dashboard
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
                                    <th>FG</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                <tr>
                                    <td>{{$dt->barcode}}</td>
                                    <td>{{date('Ymd', strtotime($dt->lotno))}}</td>
                                    <td>{{$dt->shift}}</td>
                                    <td>{{$dt->model_no}}</td>
                                    <td>{{$dt->finish_goods}}</td>
                                    <td>{{$dt->pic}}</td>
                                    <td>
                                        @if ($dt->status == 0)
                                        On Production
                                        @elseif ($dt->status == 1)
                                            @if ($dt->judgement == 1) 
                                                <span class="text-success">GOOD </span> <i class="fa fa-check text-success" aria-hidden="false"></i>
                                            @elseif ($dt->judgement == 2) 
                                                <span class="text-danger">NG </span> <i class="fa fa-times text-danger" aria-hidden="false"></i>
                                            @else 
                                                <span class="text-warning">HOLD</span> <i class="fa fa-exclamation text-warning" aria-hidden="false"></i>
                                            @endif
                                        @elseif ($dt->status == 2)
                                        On Waiting
                                        @elseif ($dt->status == 3)
                                        Transfered
                                        @else
                                                <span>Closed </span> <i class="fa fa-times" aria-hidden="false"></i>
                                        @endif
                                    </td>
                                    <td>
                                    @if ($dt->status == 0)
                                    <a class="btn btn-sm btn-outline-primary" href="{{route('closed_data', $dt->id)}}"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                                    <a class="btn btn-sm btn-outline-success" href="{{route('print_lotcard', $dt->id)}}"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a class="btn btn-sm btn-outline-danger" href="{{route('delete_data', $dt->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @else
                                    <a disable class="btn btn-sm btn-outline-primary disabled"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                                    <a disable class="btn btn-sm btn-outline-success disabled"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a disable class="btn btn-sm btn-outline-danger disabled"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
            [1, 'asc']
        ],
        dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
    });
});
</script>
@endpush