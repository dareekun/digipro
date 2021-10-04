@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-3">{{$tipe}}</div>
                            <div class="col-md-9" align="right">{{ date('d F Y') }}</div>
                        </div></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <!-- chart 1 -->
                            <div class="col-sm-12" style="height: 325px">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <!-- chart 4 -->
                            <div class="col-sm">
                                <table class="table" id="data" style="width:100%" bordered>
                                <tr>
                                <td>Lini</td>
                                @foreach ($lini as $l)
                                <td><a href="/graphbulan/{{$l->tempat}}" style="color:black"><div class="namalini">{{$l->tempat}}</div></a></td>
                                @endforeach
                                </tr>
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" src="{{ asset('/js/chart2.js') }}"></script>
@endsection