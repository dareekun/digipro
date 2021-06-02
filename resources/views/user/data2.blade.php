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
                                        <tr>
                                            <td>
                                                Bantuan Masuk 
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" value="{{$d->bantuan_masuk}}" name="bantuanmasuk">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bantuan Keluar 
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" value="{{$d->bantuan_keluar}}" name="bantuankeluar">
                                            </td>
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
                                        <tr>
                                            <td>
                                                Waktu Bantuan Masuk
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" style="width:100px" value="{{$d->bantuan_masuk_waktu}}" name="waktumasuk">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Bantuan Keluar
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" style="width:100px" value="{{$d->bantuan_keluar_waktu}}" name="waktukeluar">
                                            </td>
                                            <td colspan="5"></td>
                                            <td colspan="1"><button type="submit" class="btn btn-success w-100">Update</button></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </form>
                        @endforeach
                        <br>
                <livewire:data  :pass="$refer"/>
                </div>
            </div>
        </div>
    </div>
    @include('dll.modal')
    <script type="text/javascript" src="{{ asset('/js/data2.js') }}"></script>
    @endsection