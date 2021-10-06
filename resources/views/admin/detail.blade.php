@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table style="width:100%">
                        <tr>
                            <td>Laporan Produksi</td>
                            <td align="right">
                                <a href="/hapus/{{$id}}" class="btn-sm btn-danger no-print" role="button"
                                    aria-pressed="true"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
                                <a href="/resume/{{$id}}" class="btn-sm btn-primary no-print" role="button"
                                    aria-pressed="true"><i class="fa fa-pencil" aria-hidden="true"></i> Rubah</a>
                                <a href="#" onclick="window.print()" class="btn-sm btn-success no-print" role="button"
                                    aria-pressed="true">
                                    <i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    @foreach ($data1 as $a )
                    <table style="width:100%">
                        <tr>
                            <td style="width:25%">
                                <table>
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
                                    <tr>
                                        <td>Bantuan Masuk</td>
                                        <td>: {{$a->bantuan_masuk}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bantuan Keluar</td>
                                        <td>: {{$a->bantuan_keluar}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Karyawan tetap </td>
                                        <td>: {{$a->kartap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Karyawan Kontrak </td>
                                        <td>: {{$a->kwt}}</td>
                                    </tr>
                                    <tr>
                                        <td>DT, PC, KP, CT </td>
                                        <td>: {{$a->izin}}</td>
                                    </tr>
                                    <tr>
                                        <td>Operator Planning</td>
                                        <td>: {{$a->optplan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Bantuan Masuk</td>
                                        <td>: {{$a->bantuan_masuk_waktu}}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Bantuan Keluar</td>
                                        <td>: {{$a->bantuan_keluar_waktu}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top;">
                                <table>
                                    <tr>
                                        <td>Absen </td>
                                        <td>: {{$a->absenkartap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Absen </td>
                                        <td>: {{$a->absenkwt}}</td>
                                    </tr>
                                    <tr>
                                        <td>Start </td>
                                        <td>: {{$a->start}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top;">
                                <table>
                                    <tr>
                                        <td>Overtime </td>
                                        <td>: {{$a->otkartap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Overtime </td>
                                        <td>: {{$a->otkwt}}</td>
                                    </tr>
                                    <tr>
                                        <td>Finish </td>
                                        <td>: {{$a->finish}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top;">
                                <table>
                                    <tr>
                                        <td>Waktu Kerja</td>
                                        <td>: {{$a->waktukartap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Kerja</td>
                                        <td>: {{$a->waktukwt}}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>Waktu Kerja T.T </td>
                                        <td>: {{$a->waktukerja}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    @endforeach
                    <br>
                    <!-- loss 1 -->
                    Regulated Loss
                    <table style="width:100%" class="table-bordered">
                        <tr>
                            <td style="width:34%">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%">Tipe Produk</td>
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
                            <td style="width:34%">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%">Tipe Produk</td>
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
                            <td style="width:34%">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%">Tipe Produk</td>
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
                            <td style="width:34%">Masalah Yang Terjadi</td>
                            <td style="width:5%" align="center">Start</td>
                            <td style="width:5%" align="center">Stop</td>
                            <td style="width:5%" align="center">Durasi</td>
                            <td style="width:15%">Tipe Produk</td>
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
                    <table style="width:100%">
                        <tr>
                            <td>
                                Rekap Produksi
                                <table style="width:100%" class="table-bordered">
                                    <tr>
                                        <td style="width:20%">Tipe Produk</td>
                                        <td align="center">Start</td>
                                        <td align="center">Stop</td>
                                        <td align="center">Duration</td>
                                        <td align="center">Plan / Actual</td>
                                        <td align="center">Selisih</td>
                                        <td align="center">NG Proses / Material</td>
                                        <td align="center">Keterangan</td>
                                    </tr>
                                    @foreach ($data6 as $f) <tr>
                                        <td>{{$f->tipe}}</td>
                                        <td align="center">{{$f->start}}</td>
                                        <td align="center">{{$f->stop}}</td>
                                        <td align="center">{{$f->dur}}</td>
                                        <td align="center">{{$f->daily_plan}} / {{$f->daily_actual}}</td>
                                        <td align="center">{{$f->daily_diff}}</td>
                                        <td align="center">{{$f->ng_process}} / {{$f->ng_material}}</td>
                                        <td align="center">{{$f->ket}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Result Produksi
                                <table style="width:100%" class="table-bordered">
                                    <tr>
                                        <td style="width:20%" align="center">Inti Masalah</td>
                                        <td style="width:20%" align="center">Analisa Penyebab</td>
                                        <td style="width:20%" align="center">Tindakan Penanggulangan</td>
                                        <td style="width:20%" align="center">Hasil Produksi</td>
                                        <td style="width:20%" align="center">Available Working Time</td>
                                    </tr>
                                    @foreach ($data7 as $g)
                                    <tr>
                                        <td rowspan="3">{{$g->inti1}} <br> {{$g->inti2}}</td>
                                        <td rowspan="3">{{$g->analisa1}} <br> {{$g->analisa2}} </td>
                                        <td rowspan="3">{{$g->tindakan1}} <br> {{$g->tindakan2}}</td>
                                        <td align="center">{{$g->hasil}} Pcs</td>
                                        <td align="center">{{$g->avalaible}} Menit</td>
                                    </tr>
                                    <tr>
                                        <td align="center">Total Loss Time</td>
                                        <td align="center">Production Head</td>
                                    </tr>
                                    <tr>
                                        <td align="center">{{$g->ttlloss}} Menit</td>
                                        <td align="center">{{$g->phh}} Pcs/Jam </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table-bordered" style="width:60%">
                                    <tr>
                                        <td style="width:20%" align="center">Approved</td>
                                        <td style="width:20%" align="center">Checked</td>
                                        <td style="width:20%" align="center">Issued</td>
                                    </tr>
                                    <tr>
                                        <td> <br><br><br> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                        <td><br></td>
                                        <td><br></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop

    @push('scripts')
    @endpush