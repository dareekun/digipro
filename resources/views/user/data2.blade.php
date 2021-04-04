@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<script>
$(document).ready(function() {
    $("#myModal").modal('show');
});
</script>
@endforeach
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-3">
                            Input Produksi Bagian {{$bagian}}
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-2" align="right">
                            Tanggal {{ date('Y-m-d') }}
                            <br>
                            <div align="right">
                                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form name="masuk" id="masuk" action="/next2" method="post">
                        {{ csrf_field() }}
                        <input type="text" id="id_hapus" name="id_hapus" hidden>
                        <table>
                            <tr>
                                <td>
                                    @foreach($data as $d)
                                    <table>
                                        <tr>
                                            <td>Tanggal </td>
                                            <td> <input type="date" class="form-control" value="{{$d->tanggal}}"
                                                    name="tanggal"></td>
                                        </tr>
                                        <tr>
                                            <td>Line</td>
                                            <td> <select name="line" class="custom-select">
                                                    @foreach($bline as $b)
                                                    <option @if($b->tempat == $d->line) selected @else @endif
                                                        value="{{$b->tempat}}">{{$b->tempat}}</option>
                                                    @endforeach
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>Pic</td>
                                            <td> <input type="text" value="{{$d->pic}}" required class="form-control"
                                                    name="pic"></td>
                                        </tr>
                                        <tr>
                                            <td>Shift</td>
                                            <td> <select name="shift" class="custom-select">
                                                    @foreach($waktu as $w)
                                                    <option @if($w->shift===$d->shift) selected @else @endif
                                                        value="{{$w->shift}}">{{$w->shift}}</option>
                                                    @endforeach
                                                </select></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Karyawan tetap </td>
                                            <td> <input required value="{{$d->kartap}}" type="number"
                                                    style="width:100px" class="form-control" name="kartap"></td>
                                            <td>Absen </td>
                                            <td> <input required value="{{$d->absenkartap}}" type="number"
                                                    style="width:100px" class="form-control" name="absenkartap"></td>
                                            <td>Waktu Kerja</td>
                                            <td> <input required value="{{$d->waktukartap}}" type="number"
                                                    style="width:100px" class="form-control" name="waktukartap"></td>
                                            <td>Overtime </td>
                                            <td> <input required value="{{$d->otkartap}}" type="number"
                                                    style="width:100px" class="form-control" name="otkartap"></td>
                                        </tr>
                                        <tr>
                                            <td>Karyawan Kontrak </td>
                                            <td><input required value="{{$d->kwt}}" type="number" style="width:100px"
                                                    class="form-control" name="kwt"></td>
                                            <td>Absen </td>
                                            <td> <input required value="{{$d->absenkwt}}" type="number"
                                                    style="width:100px" class="form-control" name="absenkwt"></td>
                                            <td>Waktu Kerja</td>
                                            <td> <input required value="{{$d->waktukwt}}" type="number"
                                                    style="width:100px" class="form-control" name="waktukwt"></td>
                                            <td>Overtime </td>
                                            <td> <input required value="{{$d->otkwt}}" type="number" style="width:100px"
                                                    class="form-control" name="otkwt"></td>
                                        </tr>
                                        <tr>
                                            <td>DT, PC, KP, CT </td>
                                            <td><input required value="{{$d->izin}}" type="number" style="width:100px"
                                                    class="form-control" name="izin"></td>
                                            <td><input hidden value="{{$d->keyid}}" style="width:100px"
                                                    class="form-control" name="subaru"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Operator Planning</td>
                                            <td><input required value="{{$d->optplan}}" type="number"
                                                    style="width:100px" class="form-control" name="optplan"></td>
                                            <td>Start </td>
                                            <td> <input required value="{{$d->start}}" type="time" style="width:100px"
                                                    class="form-control" name="start"></td>
                                            <td>Finish </td>
                                            <td> <input value="{{$d->finish}}" type="time" style="width:100px"
                                                    class="form-control" name="finish"></td>
                                            <td>Waktu Kerja T.T </td>
                                            <td> <input required value="{{$d->waktukerja}}" type="number"
                                                    style="width:100px" class="form-control" name="waktukerja"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                        <br>
                        <!-- loss 1 -->
                        Regulated Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:15%" align="center">Produk yang dikerjakan</td>
                                <td style="width:20%" colspan="2" align="center">Keterangan</td>
                            </tr>
                            @foreach($data1 as $d1)
                            <tr>
                                <td><input hidden value="{{$d1->idp}}" type="number" style="width:100px"
                                        class="form-control" name="idd1"></td>
                                <td><input disabled value="{{$d1->problem}}" type="text" style="width:100px"
                                        class="form-control-plaintext w-100" name="regprob"></td>
                                <td><input disabled value="{{$d1->start}}" type="time" style="width:100px" class="form-control"
                                        name="regstart"></td>
                                <td><input disabled value="{{$d1->stop}}" type="time" style="width:100px" class="form-control"
                                        name="regfinish"></td>
                                <td><input disabled value="{{$d1->dur}}" type="number" style="width:100px" class="form-control"
                                        name="regdur"></td>
                                <td><select disabled name="regprod" class="custom-select">
                                        @foreach($produk as $p)
                                        <option @if($d1->tipe==$p->tipe) selected @else @endif
                                            value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input disabled type="text" value="{{$d1->ket}}" class="form-control" name="regket"></td>
                                <td align="right"><a href="/"></a>
                                    <button class="btn btn-danger" type="submit" onclick="del1({{$d1->idp}})" name="rem1"><i
                                            class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="regprob0" class="custom-select">
                                        <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossa as $a)
                                        <option @if(old('regprob0')==$a->loss) selected @else @endif
                                            value="{{$a->loss}}">{{$a->loss}}</option>
                                        @endforeach</td>
                                <td><input type="time" data-placement="top" data-trigger="manual"
                                        data-content="Required" value="{{old('regstart0')}}" style="width:100px"
                                        class="form-control" name="regstart0"></td>
                                <td><input type="time" data-placement="top" data-trigger="manual"
                                        data-content="Required" value="{{old('regfinish0')}}" style="width:100px"
                                        class="form-control" name="regfinish0"></td>
                                <td><input type="number" data-placement="top" data-trigger="manual"
                                        disabled value="{{old('regdur0')}}" style="width:100px"
                                        class="form-control" name="regdur0"></td>
                                <td><select name="regprod0" class="custom-select">
                                        @foreach($produk as $p)
                                        <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input type="text" data-placement="top" data-trigger="manual"
                                        data-content="Required" value="-" class="form-control"
                                        name="regket0">
                                </td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data1()"
                                        name="ram1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
                            </tr>
                        </table>
                        <br>
                        <!-- loss 2 -->
                        Work Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:15%" align="center">Produk yang dikerjakan</td>
                                <td style="width:20%" colspan="2" align="center">Keterangan</td>
                            </tr>
                            @foreach($data2 as $d2)
                            <tr>
                                <td><input hidden value="{{$d2->idp}}" type="number" style="width:100px"
                                        class="form-control" name="idd2"></td>
                                <td><input disabled value="{{$d2->problem}}" type="text" style="width:100px"
                                        class="form-control-plaintext w-100" name="wrkprob"></td>
                                <td><input disabled value="{{$d2->start}}" type="time" style="width:100px" class="form-control"
                                        name="wrkstart"></td>
                                <td><input disabled value="{{$d2->stop}}" type="time" style="width:100px" class="form-control"
                                        name="wrkfinish"></td>
                                <td><input disabled value="{{$d2->dur}}" type="number" style="width:100px" class="form-control"
                                        name="wrkdur"></td>
                                <td><select disabled name="wrkprod" class="custom-select">
                                        @foreach($produk as $p)
                                        <option @if($d2->tipe==$p->tipe) selected @else @endif
                                            value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input disabled type="text" value="{{$d2->ket}}" class="form-control" name="wrkket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del2({{$d2->idp}})"
                                        name="rem2"><i class="fa fa-minus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="wrkprob0" class="custom-select">
                                        <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossb as $b)
                                        <option value="{{$b->loss}}">{{$b->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{old('wrkstart0')}}" type="time" style="width:100px"
                                        class="form-control" name="wrkstart0"></td>
                                <td><input value="{{old('wrkfinish0')}}" type="time" style="width:100px"
                                        class="form-control" name="wrkfinish0"></td>
                                <td><input value="{{old('wrkdur0')}}" disabled type="number" style="width:100px"
                                        class="form-control" name="wrkdur0"></td>
                                <td><select name="wrkprod0" class="custom-select">
                                        @foreach($produk as $p)
                                        <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input type="text" value="-" class="form-control" name="wrkket0">
                                </td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data2()"
                                        name="ram2"><i class="fa fa-plus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                        </table>
                        <br>
                        <!-- loss 3 -->
                        Organization Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:15%" align="center">Produk yang dikerjakan</td>
                                <td style="width:20%" colspan="2" align="center">Keterangan</td>
                            </tr>
                            @foreach($data3 as $d3)
                            <tr>
                                <td><input hidden value="{{$d3->idp}}" type="number" style="width:100px"
                                        class="form-control" name="idd3"></td>
                                <td><input disabled value="{{$d3->problem}}" type="text" style="width:100px"
                                        class="form-control-plaintext w-100" name="orprob"></td>
                                <td><input disabled value="{{$d3->start}}" type="time" style="width:100px" class="form-control"
                                        name="orstart"></td>
                                <td><input disabled value="{{$d3->stop}}" type="time" style="width:100px" class="form-control"
                                        name="orfinish"></td>
                                <td><input disabled value="{{$d3->dur}}" type="number" style="width:100px" class="form-control"
                                        name="ordur"></td>
                                <td><select disabled name="orprod" class="custom-select">
                                        @foreach($produk as $p)
                                        <option @if($d3->tipe==$p->tipe) selected @else @endif
                                            value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input disabled type="text" value="{{$d3->ket}}" class="form-control" name="orket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del3({{$d3->idp}})"
                                        name="rem3"><i class="fa fa-minus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="orprob0" class="custom-select">
                                        <option value="Tidak Ada Masalah" selected>Tidak Ada Masalah</option>
                                        @foreach($lossc as $c)
                                        <option value="{{$c->loss}}">{{$c->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{old('orstart0')}}" type="time" style="width:100px"
                                        class="form-control" name="orstart0"></td>
                                <td><input value="{{old('orfinish0')}}" type="time" style="width:100px"
                                        class="form-control" name="orfinish0"></td>
                                <td><input value="{{old('ordur0')}}" disabled type="number" style="width:100px"
                                        class="form-control" name="ordur0"></td>
                                <td><select name="orprod0" class="custom-select">
                                        @foreach($produk as $p)
                                        <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input type="text" value="-" class="form-control" name="orket0">
                                </td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data3()"
                                        name="ram3"><i class="fa fa-plus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                        </table>
                        <br>
                        <!-- loss 4 -->
                        Defect Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:15%" align="center">Produk yang dikerjakan</td>
                                <td style="width:20%" colspan="2" align="center">Keterangan</td>
                            </tr>
                            @foreach($data4 as $d4)
                            <tr>
                                <td><input hidden value="{{$d4->idp}}" type="number" style="width:100px"
                                        class="form-control-plaintext" name="idd4"></td>
                                <td><input disabled value="{{$d4->problem}}" type="text" style="width:100px"
                                        class="form-control-plaintext w-100" name="defprob"></td>
                                <td><input disabled value="{{$d4->start}}" type="time" style="width:100px"
                                        class="form-control-plaintext" name="defstart"></td>
                                <td><input disabled value="{{$d4->stop}}" type="time" style="width:100px"
                                        class="form-control-plaintext" name="deffinish"></td>
                                <td><input disabled value="{{$d4->dur}}" type="number" style="width:100px"
                                        class="form-control-plaintext" name="defdur"></td>
                                <td><select disabled name="defprod" class="form-control-plaintext">
                                        @foreach($produk as $p)
                                        <option @if($d4->tipe==$p->tipe) selected @else @endif
                                            value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input disabled type="text" value="{{$d4->ket}}" class="form-control-plaintext" name="defket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del4({{$d4->idp}})"
                                        name="rem4"><i class="fa fa-minus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="defprob0" class="custom-select">
                                        <option value="Tidak Ada Masalah" selected>Tidak Ada Masalah</option>
                                        @foreach($lossd as $d)
                                        <option value="{{$d->loss}}">{{$d->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{old('defstart0')}}" type="time" style="width:100px"
                                        class="form-control" name="defstart0"></td>
                                <td><input value="{{old('deffinish0')}}" type="time" style="width:100px"
                                        class="form-control" name="deffinish0"></td>
                                <td><input value="{{old('defdur0')}}" disabled type="number" style="width:100px"
                                        class="form-control" name="defdur0"></td>
                                <td><select name="defprod0" class="custom-select">
                                        @foreach($produk as $p)
                                        <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input type="text" value="-" class="form-control" name="defket">
                                </td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data4()"
                                        name="ram4"><i class="fa fa-plus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                        </table>
                        <br>
                        Rekap Produksi
                        <table>
                            <tr>
                                <td></td>
                                <td style="width:15%" align="center">Tipe Produk</td>
                                <td align="center">Start</td>
                                <td align="center">Stop</td>
                                <td align="center">Duration</td>
                                <td align="center">Total Produksi</td>
                                <td align="center">Produksi Org</td>
                                <td align="center">Standart</td>
                                <td align="center">Actual</td>
                                <td align="center">%</td>
                                <td align="center">Total %</td>
                                <td align="center">Kap / Orang</td>
                                <td align="center">Petugas</td>
                                <td></td>
                            </tr>
                            @foreach($data5 as $d5)
                            <tr>
                                <td><input hidden value="{{$d5->id}}" style="width:100px"
                                        class="form-control-plaintext" name="idd5"></td>
                                <td><input disabled value="{{$d5->tipe}}" type="text" style="width:150px"
                                        class="form-control-plaintext" name="rekprod"></td>
                                <td><input disabled value="{{$d5->start}}" type="time" style="width:100px"
                                        class="form-control-plaintext" name="rekstart"></td>
                                <td><input disabled value="{{$d5->stop}}" required type="time" style="width:100px"
                                        class="form-control-plaintext" name="rekstop"></td>
                                <td><input disabled value="{{$d5->dur}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekdur"></td>
                                <td><input disabled value="{{$d5->ttlprod}}" type="text" min="0"
                                        class="form-control-plaintext" name="rektime"></td>
                                <td><input disabled value="{{$d5->prodorg}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekplus"></td>
                                <td><input disabled value="{{$d5->standart}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekmin"></td>
                                <td><input disabled value="{{$d5->actual}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekman"></td>
                                <td><input value="{{$d5->percentage}}" type="text" min="0" 
                                        class="form-control-plaintext" name="rekdlyp"></td>
                                <td><input disabled value="{{$d5->ttlperc}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekngp"></td>
                                <td><input disabled value="{{$d5->kaporg}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekngm"></td>
                                <td><input disabled value="{{$d5->petugas}}" type="text" min="0"
                                        class="form-control-plaintext" name="rekngm"></td>
                                <td align="left"><button class="btn btn-danger" type="submit" onclick="del5({{$d5->id}})"
                                        name="rem5"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="rekprod0" style="width:300px" class="custom-select">
                                        @foreach($produk as $p)
                                        <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                                        @endforeach</td>
                                <td><input type="time" style="width:100px" class="form-control" name="rekstart0"></td>
                                <td><input type="time" style="width:100px" class="form-control" name="rekstop0"></td>
                                <td><input value="{{old('dur')}}" disabled style="width:100px" type="number" min="0" class="form-control" name="dur"></td>
                                <td><input value="{{old('ttlprod')}}" type="number" min="0" class="form-control"
                                        name="ttlprod"></td>
                                <td><input value="{{old('prodorg')}}" type="number" min="0" class="form-control"
                                        name="prodorg"></td>
                                <td><input value="{{old('standart')}}" type="number" min="0" class="form-control"
                                        name="standart">
                                </td>
                                <td><input value="{{old('actual')}}" style="width:100px" disabled type="number" min="0" class="form-control"
                                        name="actual"></td>
                                <td><input value="{{old('percentage')}}" style="width:80px" disabled type="number" min="0" class="form-control"
                                        name="percentage"></td>
                                <td><input value="{{old('ttlperc')}}" style="width:80px" disabled type="number" min="0" class="form-control"
                                        name="ttlperc"></td>
                                <td><input value="{{old('kaporg')}}" disabled type="number" min="0" class="form-control"
                                        name="kaporg"></td>
                                <td><input value="{{old('petugas')}}" style="width:150px" type="text" class="form-control"
                                        name="petugas"></td>
                                <td align="left"><button class="btn btn-success" type="submit" onclick="data5()"
                                        name="ram5"><i class="fa fa-plus-circle"
                                            aria-hidden="true"></i></button></button></td>
                            </tr>
                        </table>
                        <br>
                        Result Produksi

                        @forelse ($data6 as $d6)
                        <table style="width:100%">
                            <tr>
                                <td style="width:20%" align="center">Inti Masalah</td>
                                <td style="width:20%" align="center">Analisa Penyebab</td>
                                <td style="width:20%" align="center">Tindakan Penanggulangan</td>
                                <td style="width:10%" align="center">Hasil Produksi</td>
                                <td style="width:10%" align="center">Available Working Time</td>
                                <td style="width:12%" align="center">Production Head</td>
                            </tr>
                            <tr>
                                <td><input value="{{$d6->inti1}}" type="text" class="form-control" name="reslt1">
                                </td>
                                <td><input value="{{$d6->analisa1}}" type="text" class="form-control" name="reslt2">
                                </td>
                                <td><input value="{{$d6->tindakan1}}" type="text" class="form-control" name="reslt3">
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$d6->hasil}}"
                                            type="number" class="form-control" name="reslt4">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Pcs</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$d6->avalaible}}"
                                            type="number" class="form-control" name="reslt5">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Menit</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$d6->time}}"
                                            type="number" class="form-control" name="reslt6">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Pcs/Jam</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><br></td>
                                <td>Total Loss Time</td>
                                <td>Total Man Power</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input value="{{$d6->inti2}}" type="text" class="form-control" name="reslt1a">
                                </td>
                                <td><input value="{{$d6->analisa2}}" type="text" class="form-control" name="reslt2a">
                                </td>
                                <td><input value="{{$d6->tindakan2}}" type="text" class="form-control" name="reslt3a">
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$d6->ttlloss}}"
                                            type="number" min="0" class="form-control" name="reslt4a">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Menit</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$d6->ttlman}}"
                                            type="number" class="form-control" name="reslt5a">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Person</span>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <!-- Empety Data -->
                        @empty
                        <table style="width:100%">
                            <tr>
                                <td style="width:20%" align="center">Inti Masalah</td>
                                <td style="width:20%" align="center">Analisa Penyebab</td>
                                <td style="width:20%" align="center">Tindakan Penanggulangan</td>
                                <td style="width:10%" align="center">Hasil Produksi</td>
                                <td style="width:10%" align="center">Available Working Time</td>
                                <td style="width:12%" align="center">Production Head</td>
                            </tr>
                            <tr>
                                <td><input value="{{old('reslt1')}}" type="text" class="form-control" name="reslt1">
                                </td>
                                <td><input value="{{old('reslt2')}}" type="text" class="form-control" name="reslt2">
                                </td>
                                <td><input value="{{old('reslt3')}}" type="text" class="form-control" name="reslt3">
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$summ}}"
                                            type="number" class="form-control" name="reslt4">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Pcs</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$avail}}"
                                            type="number" class="form-control" name="reslt5">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Menit</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{old('reslt6')}}"
                                            type="number" class="form-control" name="reslt6">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Pcs/Jam</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><br></td>
                                <td>Total Loss Time</td>
                                <td>Total Man Power</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input value="{{old('reslt1a')}}" type="text" class="form-control" name="reslt1a">
                                </td>
                                <td><input value="{{old('reslt2a')}}" type="text" class="form-control" name="reslt2a">
                                </td>
                                <td><input value="{{old('reslt3a')}}" type="text" class="form-control" name="reslt3a">
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{$ttloss}}"
                                            type="number" min="0" class="form-control" name="reslt4a">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Menit</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"><input value="{{old('reslt5a')}}" type="number" class="form-control" name="reslt5a">
                                        <div class="input-group-append"><span class="input-group-text"
                                                id="basic-addon2">Person</span>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        @endforelse
                        <br>
                        <table style="width:100%">
                            <tr>
                                <td><button type="button" class="btn btn-danger" onclick="history.back();">Back</button>
                                </td>
                                <td align="right"><button type="submit" name="emilia" onclick="data6()"
                                        class="btn btn-success">Next</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('dll.modal')
    <script type="text/javascript" src="{{ asset('/js/data2.js') }}"></script>
    @endsection