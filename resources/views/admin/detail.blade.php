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
                                <a href="/resume/{{$id}}" class="btn-sm btn-primary" role="button" aria-pressed="true"><i class="fa fa-pencil" aria-hidden="true"></i> Ubah</a>
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
                                <table style="width:100%" class="table-bordered">
                                    @foreach ($data1 as $a )
                                    <tr>
                                        <td>Tanggal </td>
                                        <td>: {{ date('Y-m-d', strtotime($a->tanggal)) }}

                                    </tr>
                                    <tr>
                                        <td>Line</td>
                                        <td>: {{$a->line}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pic</td>
                                        <td>: {{$a->pic}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shift</td>
                                        <td>: {{$a->shift}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width:100%" class="table-bordered">
                                    <tr>
                                        <td>Karyawan tetap </td>
                                        <td style="width:10%">: {{$a->kartap}}</td>
                                        <td>Absen </td>
                                        <td>: {{$a->absenkartap}}</td>
                                        <td>Waktu Kerja</td>
                                        <td>: {{$a->waktukartap}}</td>
                                        <td>Overtime </td>
                                        <td style="width:10%">: {{$a->otkartap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Karyawan Kontrak </td>
                                        <td>: {{$a->kwt}}</td>
                                        <td>Absen </td>
                                        <td>: {{$a->absenkwt}}</td>
                                        <td>Waktu Kerja</td>
                                        <td>: {{$a->waktukwt}}</td>
                                        <td>Overtime </td>
                                        <td>: {{$a->otkwt}}</td>
                                    </tr>
                                    <tr>
                                        <td>DT, PC, KP, CT </td>
                                        <td>: {{$a->izin}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Operator Planning</td>
                                        <td>: {{$a->optplan}}</td>
                                        <td>Start </td>
                                        <td>: {{$a->start}}</td>
                                        <td>Finish </td>
                                        <td>: {{$a->finish}}</td>
                                        <td>Waktu Kerja T.T </td>
                                        <td>: {{$a->waktukerja}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
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
                            <td style="width:15%" align="center">Produk yang dikerjakan</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data2 as $b)
                        <tr>
                            <td>{{$b->problem}}</td>
                            <td align="center">{{$b->start}}</td>
                            <td align="center">{{$b->stop}}</td>
                            <td align="center">{{$b->dur}}</td>
                            <td>{{$b->tipe}}</td>
                            <td>{{$b->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <!-- loss 2 -->
                    Work Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%" align="center">Produk yang dikerjakan</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data3 as $c) <tr>
                            <td>{{$c->problem}}</td>
                            <td align="center">{{$c->start}}</td>
                            <td align="center">{{$c->stop}}</td>
                            <td align="center">{{$c->dur}}</td>
                            <td>{{$c->tipe}}</td>
                            <td>{{$c->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <!-- loss 3 -->
                    Organization Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%" align="center">Produk yang dikerjakan</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data4 as $d) <tr>
                            <td>{{$d->problem}}</td>
                            <td align="center">{{$d->start}}</td>
                            <td align="center">{{$d->stop}}</td>
                            <td align="center">{{$d->dur}}</td>
                            <td>{{$d->tipe}}</td>
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
                            <td style="width:15%" align="center">Produk yang dikerjakan</td>
                            <td style="width:25%" align="center">Keterangan</td>
                        </tr>
                        @foreach ($data5 as $e) <tr>
                            <td>{{$e->problem}}</td>
                            <td align="center">{{$e->start}}</td>
                            <td align="center">{{$e->stop}}</td>
                            <td align="center">{{$e->dur}}</td>
                            <td>{{$e->tipe}}</td>
                            <td>{{$e->ket}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    Rekap Produksi
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:15%" align="center">Tipe Produk</td>
                            <td align="center">Start</td>
                            <td align="center">Stop</td>
                            <td align="center">Duration</td>
                            <td align="center">Total Produksi</td>
                            <td align="center">Produksi Org</td>
                            <td align="center">Standard</td>
                            <td align="center">Actual</td>
                            <td align="center">%</td>
                            <td align="center">Total %</td>
                            <td align="center">Kap/ Org</td>
                            <td align="center">Petugas</td>
                        </tr>
                        @foreach ($data6 as $f) <tr>
                            <td>{{$f->tipe}}</td>
                            <td align="center">{{$f->start}}</td>
                            <td align="center">{{$f->stop}}</td>
                            <td align="center">{{$f->dur}}</td>
                            <td align="center">{{$f->ttlprod}}</td>
                            <td align="center">{{$f->prodorg}}</td>
                            <td align="center">{{$f->standart}}</td>
                            <td align="center">{{$f->actual}}</td>
                            <td align="center">{{$f->percentage}}</td>
                            <td align="center">{{$f->ttlperc}}</td>
                            <td align="center">{{$f->kaporg}}</td>
                            <td align="center">{{$f->petugas}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    Result Produksi
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:20%" align="center">Inti Masalah</td>
                            <td style="width:20%" align="center">Analisa Penyebab</td>
                            <td style="width:20%" align="center">Tindakan Penanggulangan</td>
                            <td style="width:10%" align="center">Hasil Produksi</td>
                            <td style="width:10%" align="center">Available Working Time</td>
                            <td style="width:12%" align="center">Production Head</td>
                        </tr>
                        @foreach ($data7 as $g)
                        <tr>
                            <td>{{$g->inti1}}</td>
                            <td>{{$g->analisa1}}</td>
                            <td>{{$g->tindakan1}}</td>
                            <td align="center">{{$g->hasil}} Pcs</td>
                            <td align="center">{{$g->avalaible}} Menit</td>
                            <td align="center">{{$g->time}} Pcs/Jam </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br><br></td>
                            <td>Total Loss Time</td>
                            <td>Total Man Power</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>{{$g->inti2}}</td>
                            <td>{{$g->analisa2}}</td>
                            <td>{{$g->tindakan2}}</td>
                            <td align="center">{{$g->ttlloss}} Menit</td>
                            <td align="center">{{$g->ttlman}} Person</td>
                            <td></td>
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