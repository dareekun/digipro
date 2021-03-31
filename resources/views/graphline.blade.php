@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Graph Bulanan</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>{{$tipe}}</h3>
                            </div>
                            <div class="col-md-9" align="right">
                                <a href="/tabel/{{$tipe}}" class="btn-sm btn-secondary" role="button"
                                    aria-pressed="true"><i class="fa fa-table" aria-hidden="true"></i> Tabel</a>
                                <a href="/graph/{{$tipe}}" class="btn-sm btn-success" role="button"
                                    aria-pressed="true"><i class="fa fa-pie-chart" aria-hidden="true"></i> Graph</a>
                            </div>
                        </div>
                        <div class="row">
                            <!-- chart 1 -->
                            <div class="col-sm-8">
                                <h5>Total Produksi</h5>
                                <canvas id="chart2"></canvas>
                            </div>
                            <!-- chart 2 -->
                            <div class="col-sm-4">
                                <h5>Bisnis Plan</h5>
                                <canvas id="chart1"></canvas>
                                <br>
                                <table style="margin:auto;" class="w-75">
                                    <tr>
                                        <td align="left"  style="width:105px">
                                            <h5>Data Plan </h5>
                                        </td>
                                        <td> <h5> : </h5></td>
                                        <td align="right"><h5 class="totala">{{array_sum($planning)}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> VS </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <h5> Data Actual </h5>
                                        </td>
                                        <td> <h5> : </h5></td>
                                        <td align="right"><h5 class="totalp">{{array_sum($actual)}}</h5></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- row chart 2 -->
                        <div class="row">
                            <!-- chart 4 -->
                            <div class="col-sm">
                                <table style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal </td>
                                            <td>: {{ date('d F Y') }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
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