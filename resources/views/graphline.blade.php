@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="height:100%">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-3">{{$tipe}}</div>
                            <div class="col-md-9" align="right">{{ date('d F Y') }}</div>
                        </div></div>
                    <div class="card-body">
                        <div style="height:70vh">
                        <canvas id="Chart1"></canvas>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <!-- chart 4 -->
                            <div class="col-sm">
                                <table hidden class="table" id="data" style="width:100%" bordered>
                                <tr>
                                <td>Lini</td>
                                @foreach ($lini as $l)
                                <td><a href="/graphbulan/{{$l->tempat}}" style="color:black"><div class="namalini">{{$l->tempat}}</div></a></td>
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