@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table style="width:100%">
                        <tr>
                            <td>Dashboard</td>
                            <td align="right">
                            <a href="/hapus/{{$id}}" class="btn-sm btn-danger" role="button" aria-pressed="true"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
                                <a href="/cetak/{{$id}}" class="btn-sm btn-success" role="button" aria-pressed="true"> <i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                                <a href="/resumim/{{$id}}" class="btn-sm btn-primary" role="button" aria-pressed="true"><i class="fa fa-pencil" aria-hidden="true"></i> Ubah</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-2">
                            Laporan Produksi
                        </div>
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2" align="right">
                            {{ date('Y-m-d') }}
                            <br>
                            <div align="right">
                                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table style="width:100%">
                        <tr>
                            <td>
                                <table style="width:50%">
                                    @foreach ($data1 as $a )
                                    <tr>
                                        <td>Tanggal </td>
                                        <td>: {{ date('Y-m-d', strtotime($a->tanggal)) }}</td>
                                        <td>Nama PIC </td>
                                        <td style="width:10%">: {{$a->pic}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe Mesin</td>
                                        <td>: {{$a->bagian}}</td>
                                        <td>Nama Part/Product </td>
                                        <td>: {{$a->part}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Mesin</td>
                                        <td>: {{$a->line}}</td>
                                        <td>Start Production </td>
                                        <td>: {{$a->start}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shift</td>
                                        <td>: {{$a->shift}}</td>
                                        <td>Finish Production</td>
                                        <td>: {{$a->finish}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                                    @endforeach
                    </table>
                    <br>
                    <!-- loss 1 -->
                    Regulated Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data2 as $b)
                        <tr>
                            <td>{{$b->problem}}</td>
                            <td align="center">{{$b->start}}</td>
                            <td align="center">{{$b->stop}}</td>
                            <td align="center">{{$b->dur}}</td>
                            <td>{{$b->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <!-- loss 2 -->
                    Stop Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data3 as $c) <tr>
                            <td>{{$c->problem}}</td>
                            <td align="center">{{$c->start}}</td>
                            <td align="center">{{$c->stop}}</td>
                            <td align="center">{{$c->dur}}</td>
                            <td>{{$c->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <!-- loss 3 -->
                    Ability Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data4 as $d) <tr>
                            <td>{{$d->problem}}</td>
                            <td align="center">{{$d->start}}</td>
                            <td align="center">{{$d->stop}}</td>
                            <td align="center">{{$d->dur}}</td>
                            <td>{{$d->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <!-- loss 4 -->
                    Defect Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data5 as $e) <tr>
                            <td>{{$e->problem}}</td>
                            <td align="center">{{$e->start}}</td>
                            <td align="center">{{$e->stop}}</td>
                            <td align="center">{{$e->dur}}</td>
                            <td>{{$e->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    Result Produksi
                    <table style="width:100%">
                        @foreach ($data7 as $g)
                        <tr>
                        <td style="width:10%">Durasi Kerja</td>
                                <td style="width:10%">: {{$g->durasi}}</td>
                                <td style="width:8%">C/T Mesin</td>
                                <td style="width:10%">: {{$g->cycle}}</td>
                                <td style="width:10%">Detail Masalah</td>
                                <td style="width:15%">: {{$g->detail}}</td>
                        </tr>
                        <tr>
                                <td>Hasil Produksi</td>
                                <td>: {{$g->hasil}}</td>
                                <td >Defect (NG)</td>
                                <td>: {{$g->defect}}</td>
                                <td >Waktu Kerja Actual</td>
                                <td>: {{$g->waktu}}</td>
                            </tr>
                            <tr>
                                <td >Planning Produksi</td>
                                <td>: {{$g->planning}}</td>
                            </tr>
                            <tr>
                                <td>Effisiensi</td>
                                <td>: {{$g->eff}}</td>
                                <td >Total Loss Time</td>
                                <td>: {{$g->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')
<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;
        setTimeout(showTime, 1000);
    }
    showTime();
    </script>
@endpush