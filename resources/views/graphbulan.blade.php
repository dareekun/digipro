@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                <div class="col-6">
                <h3>Graph Bulanan Lini {{$judul}}</h3>
                </div>
                <div class="col-6" align="right">
                <h3>{{ date('d F Y') }}</h3>
                </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    </div>
                    <div class="row">
                        <!-- chart 1 -->
                        <div class="col-sm-12">
                            <canvas id="chart1"></canvas>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <div class="container">
                                <div class="col-sm-12">
                                    <!-- chart 4 -->
                                    <table hidden id="bulanan" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                @for ($i=1; $i<= $index; $i++) <th class="tanggal" scope="col">{{$i}}</th>
                                                    @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Planning</td>
                                                @foreach ($planning as $p)
                                                <td class="dataplan">{{$p}}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Actual</td>
                                                @foreach ($actual as $a)
                                                <td class="dataactual">{{$a}}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    $('#bulanan').DataTable({
        paging: false,
        info: false,
        searching: false,
    });
});
</script>
<script type="text/javascript" src="{{ asset('/js/chart3.js') }}"></script>
@endpush