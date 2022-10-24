@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Production History
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12"><a class="btn btn-outline-primary" href="{{route('download_data', 'production_data')}}">Download Data</a></div>
                        </div>
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
                                    <th>NG</th>
                                    <th>PIC</th>
                                    <th>Judgement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                <tr>
                                    <td><a href="{{route('show_lotcard', $dt->id)}}" style="text-decoration: none;" target="_blank">{{$dt->id}}</a></td>
                                    <td>{{date('Ymd', $dt->lotno)}}</td>
                                    <td>{{$dt->shift}}</td>
                                    <td>{{$dt->model_no}}</td>
                                    <td>{{$dt->finish_goods}}</td>
                                    <td>{{$dt->not_goods}}</td>
                                    <td>{{$dt->pic}}</td>
                                    <td>
                                    @if ($dt->judgement == 1) 
                                    <span class="text-success">GOOD </span> <i class="fa fa-check text-success" aria-hidden="false"></i>
                                    @elseif ($dt->judgement == 2) 
                                    <span class="text-danger">NG </span> <i class="fa fa-times text-danger" aria-hidden="false"></i>
                                    @else 
                                    <span class="text-warning">HOLD </span> <i class="fa fa-exclamation text-warning" aria-hidden="false"></i>
                                    @endif</td>
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