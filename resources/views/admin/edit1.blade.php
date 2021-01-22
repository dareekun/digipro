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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-2">
                            Input Produksi Bagian {{$bagian}}
                        </div>
                        <div class="col-md-8">
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
                    <form id="masuk" name="masuk" action="/mesin3" method="post">
                        {{ csrf_field() }}
                        <table>
                            <tr>
                                <td>
                                @foreach ($data as $d)
                                    <table>
                                        <tr>
                                            <td>Tanggal </td>
                                            <td> <input type="date" class="form-control" value="{{$d->tanggal}}"
                                                    name="tanggal"></td>
                                        </tr>
                                        <tr>
                                            <td>Tipe Mesin</td>
                                            <td> <input type="text" class="form-control" value="{{$d->bagian}}"
                                                    name="bagian"></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Mesin</td>
                                            <td> <input type="number" value="{{$d->line}}" min="0" max="28" required class="form-control"
                                                    name="nomor"></td>
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
                                            <td>Nama PIC </td>
                                            <td> <input type="text" value="{{$d->pic}}" style="width:250px" class="form-control"
                                                    name="pic"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Part/Product </td>
                                            <td><input type="text" value="{{$d->part}}" style="width:250px" class="form-control"
                                                    name="tipe"></td>
                                        </tr>
                                        <tr>
                                            <td>Start Production </td>
                                            <td><input type="time" value="{{$d->start}}" disabled style="width:250px" class="form-control"
                                                    name="start"></td>
                                        </tr>
                                        <tr>
                                            <td>Finish Production</td>
                                            <td><input type="time" value="{{$d->finish}}" disabled style="width:250px" class="form-control"
                                                    name="finish"></td>
                                        </tr>
                                    </table>
                                    <input hidden type="number" value="0" name="duration">
                                    <input hidden type="text" value="{{$d->keyid}}" name="subaru">
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                        <br>
                        <!-- loss 1 -->
                        Regulated Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:6%" align="center">Durasi</td>
                                <td style="width:25%" align="center">Keterangan</td>
                                <td style="width:1%"></td>
                            </tr>
                            @foreach ($data1 as $d1)
                            <tr>
                                <td></td>
                                <td><select required name="regprob" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossa as $a)
                                        <option @if($a->loss===$d1->problem) selected @else @endif value="{{$a->loss}}">{{$a->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{$d1->start}}" type="time" style="width:100px" class="form-control"
                                        name="regstart"></td>
                                <td><input value="{{$d1->stop}}" type="time" style="width:100px" class="form-control"
                                        name="regfinish"></td>
                                <td><input value="{{$d1->dur}}" type="number" style="width:100px" class="form-control"
                                        name="regdur"></td>
                                <td><input type="text" value="{{$d1->ket}}" class="form-control" name="regket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del1()" name="rem1"><i
                                            class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                                @endforeach
                                <tr>
                                <td></td>
                                <td><select required name="regprob0" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossa as $a)
                                        <option value="{{$a->loss}}">{{$a->loss}}</option>
                                        @endforeach</td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="regstart0"></td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="regfinish0"></td>
                                <td><input type="number" style="width:100px" class="form-control"
                                        name="regdur0"></td>
                                <td><input type="text" value="-" class="form-control" name="regket0"></td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data1()"
                                        name="ram1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                        </table>
                        <br>
                        <!-- loss 2 -->
                        Stop Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:25%" align="center">Keterangan</td>
                                <td style="width:1%"></td>
                            </tr>
                            @foreach ($data2 as $d2)
                            <tr>
                                <td></td>
                                <td><select name="wrkprob" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossb as $b)
                                        <option @if($b->loss===$d2->problem) selected @else @endif value="{{$b->loss}}">{{$b->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{$d2->start}}" type="time" style="width:100px" class="form-control"
                                        name="wrkstart"></td>
                                <td><input value="{{$d2->stop}}" type="time" style="width:100px" class="form-control"
                                        name="wrkfinish"></td>
                                <td><input value="{{$d2->dur}}" type="number" style="width:100px" class="form-control"
                                        name="wrkdur"></td>
                                <td><input type="text" value="{{$d2->ket}}" class="form-control" name="wrkket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del2()" name="rem2"><i
                                            class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                                @endforeach
                                <tr>
                                <td></td>
                                <td><select name="wrkprob0" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossb as $b)
                                        <option value="{{$b->loss}}">{{$b->loss}}</option>
                                        @endforeach</td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="wrkstart0"></td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="wrkfinish0"></td>
                                <td><input type="number" style="width:100px" class="form-control"
                                        name="wrkdur0"></td>
                                <td><input type="text" value="-" class="form-control" name="wrkket0"></td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data2()"
                                        name="ram2"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                        </table>
                        <br>
                        <!-- loss 3 -->
                        Ability Loss
                        <table>
                            <tr>
                                <td style="width:1%"></td>
                                <td style="width:34%" align="center">Masalah Yang Terjadi</td>
                                <td style="width:5%" align="center">Start</td>
                                <td style="width:5%" align="center">Stop</td>
                                <td style="width:5%" align="center">Durasi</td>
                                <td style="width:25%" align="center">Keterangan</td>
                                <td style="width:1%"></td>
                            </tr>
                            @foreach ($data3 as $d3)
                            <tr>
                                <td></td>
                                <td><select name="orprob" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossc as $c)
                                        <option @if($c->loss===$d3->problem) selected @else @endif value="{{$c->loss}}">{{$c->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{$d3->start}}" type="time" style="width:100px" class="form-control"
                                        name="orstart"></td>
                                <td><input value="{{$d3->stop}}" type="time" style="width:100px" class="form-control"
                                        name="orfinish"></td>
                                <td><input value="{{$d3->dur}}" type="number" style="width:100px" class="form-control"
                                        name="ordur"></td>
                                <td><input type="text" value="{{$d3->ket}}" class="form-control" name="orket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del3()" name="rem3"><i
                                            class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                                @endforeach
                                <tr>
                                <td></td>
                                <td><select name="orprob0" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossc as $c)
                                        <option value="{{$c->loss}}">{{$c->loss}}</option>
                                        @endforeach</td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="orstart0"></td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="orfinish0"></td>
                                <td><input type="number" style="width:100px" class="form-control"
                                        name="ordur0"></td>
                                <td><input type="text" value="-" class="form-control" name="orket0"></td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data3()"
                                        name="ram3"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
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
                                <td style="width:25%" align="center">Keterangan</td>
                                <td style="width:1%"></td>
                            </tr>
                            @foreach ($data4 as $d4)
                            <tr>
                                <td></td>
                                <td><select name="defprob" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossd as $d)
                                        <option @if($d->loss===$d4->problem) selected @else @endif value="{{$d->loss}}">{{$d->loss}}</option>
                                        @endforeach</td>
                                <td><input value="{{$d4->start}}" type="time" style="width:100px" class="form-control"
                                        name="defstart"></td>
                                <td><input value="{{$d4->stop}}" type="time" style="width:100px" class="form-control"
                                        name="deffinish"></td>
                                <td><input value="{{$d4->dur}}" type="number" style="width:100px" class="form-control"
                                        name="defdur"></td>
                                <td><input type="text" value="{{$d4->ket}}" class="form-control" name="defket"></td>
                                <td align="right"><button class="btn btn-danger" type="submit" onclick="del4()" name="rem4"><i
                                            class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><select name="defprob0" class="custom-select">
                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                        @foreach($lossd as $d)
                                        <option value="{{$d->loss}}">{{$d->loss}}</option>
                                        @endforeach</td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="defstart0"></td>
                                <td><input type="time" style="width:100px" class="form-control"
                                        name="deffinish0"></td>
                                <td><input type="number" style="width:100px" class="form-control"
                                        name="defdur0"></td>
                                <td><input type="text" value="-" class="form-control" name="defket0"></td>
                                <td align="right"><button class="btn btn-success" type="submit" onclick="data4()"
                                        name="ram4"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                        </table>
                        <br>
                        Result Produksi
                        <table style="width:100%">
                            <tr>
                                <td style="width:10%">Durasi Kerja</td>
                                <td style="width:10%" align="center"><input type="number" value="" min="0" class="form-control" name="reslt1"></td>
                                <td style="width:8%">C/T Mesin</td>
                                <td style="width:10%" align="center"><input type="number" value="" step="0.001" min="0" class="form-control" name="reslt2"></td>
                                <td style="width:10%">Detail Masalah</td>
                                <td style="width:15%" align="center"><input type="text" value="" class="form-control" name="reslt3"></td>
                            </tr>
                            <tr>
                                <td>Hasil Produksi</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt4"></td>
                                <td >Defect (NG)</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt5"></td>
                                <td >Waktu Kerja Actual</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt6"></td>
                            </tr>
                            <tr>
                                <td >Planning Produksi</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt7"></td>
                            </tr>
                            <tr>
                                <td>Effisiensi</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt8"></td>
                                <td >Total Loss Time</td>
                                <td align="center"><input type="number" min="0" value="" class="form-control" name="reslt9"></td>
                            </tr>
                        </table>
                        <br>
                        <table style="width:100%">
                            <tr>
                                <td><button type="button" class="btn btn-danger" onclick="history.back();">Back</button>
                                </td>
                                <td align="right"><button type="submit" class="btn btn-success"  name="emilia" onclick="data5()">Next</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target="#myModal2"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/mesin2.js') }}"></script>
    @endsection