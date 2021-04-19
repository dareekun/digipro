@extends('layouts.app')

@section('content')
@if ($status=="belum")
<script>
$(document).ready(function() {
    $("#myModal").modal('show');
});
</script>
@else
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                <div class="col-sm-6">
                Input
                </div>
                <div class="col-sm-6" align="right">
                <a href="/data/Assy WD" class="btn btn-sm btn-info" style="color:#fff" role="button" aria-pressed="true">Assy WD</a>
                <a href="/data/Metal Part" style="color:#fff" class="btn btn-sm btn-info" role="button" aria-pressed="true">Metal Part</a>
                <a href="/data/Export" style="color:#fff" class="btn btn-sm btn-info" role="button" aria-pressed="true">Export</a>
                </div>
                </div>
                </div>
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
                    <div class="row justify-center">
                    <div class="col-12">
                    <form action="/next" method="post">
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$bagian}}" class="form-control" name="bagian">
                        <table>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Tanggal </td>
                                            <td> <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                                    name="tanggal"></td>
                                        </tr>
                                        <tr>
                                            <td>Line</td>
                                            <td> <select name="line" class="custom-select">
                                                    @foreach($line as $l)
                                                    <option value="{{$l->tempat}}">{{$l->tempat}}</option>
                                                    @endforeach
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bantuan Masuk Terdaftar
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" value="0" name="bantuanmasuk">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bantuan Keluar Terdaftar
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" value="0" name="bantuankeluar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pic</td>
                                            <td> <input type="text" required class="form-control" name="pic"></td>
                                        </tr>
                                        <tr>
                                            <td>Shift</td>
                                            <td> <select name="shift" class="custom-select">
                                                    @foreach($waktu as $w)
                                                    <option value="{{$w->shift}}">{{$w->shift}}</option>
                                                    @endforeach
                                                </select></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Karyawan tetap </td>
                                            <td> <input required type="number" style="width:100px" class="form-control"
                                                    name="kartap"></td>
                                            <td>Absen </td>
                                            <td> <input required type="number" value="0" style="width:100px" class="form-control"
                                                    name="absenkartap"></td>
                                            <td>Waktu Kerja</td>
                                            <td> <input disabled type="number" style="width:100px" class="form-control"
                                                    name="waktukartap"></td>
                                            <td>Overtime </td>
                                            <td> <input required type="number" style="width:100px" value="0" class="form-control"
                                                    name="otkartap"></td>
                                        </tr>
                                        <tr>
                                            <td>Karyawan Kontrak </td>
                                            <td><input required type="number" style="width:100px" class="form-control"
                                                    name="kwt"></td>
                                            <td>Absen </td>
                                            <td> <input required type="number" value="0" style="width:100px" class="form-control"
                                                    name="absenkwt"></td>
                                            <td>Waktu Kerja</td>
                                            <td> <input disabled type="number" style="width:100px" class="form-control"
                                                    name="waktukwt"></td>
                                            <td>Overtime </td>
                                            <td> <input required type="number" style="width:100px" value="0" class="form-control"
                                                    name="otkwt"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Kerja Bantuan Masuk
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" style="width:100px" value="0" name="waktumasuk">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Kerja Bantuan Keluar
                                            </td>
                                            <td>
                                            <input type="number" class="form-control" style="width:100px" value="0" name="waktukeluar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DT, PC, KP, CT </td>
                                            <td><input required type="number" value="0" style="width:100px" class="form-control"
                                                    name="izin"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Operator Planning</td>
                                            <td><input required disabled type="number" style="width:100px" class="form-control"
                                                    name="jmlop"></td>
                                            <td>Start </td>
                                            <td> <input disabled type="time" style="width:100px" class="form-control"
                                                    name="start"></td>
                                            <td>Finish </td>
                                            <td> <input disabled type="time" style="width:100px" class="form-control"
                                                    name="finish"></td>
                                            <td>Waktu Kerja T.T </td>
                                            <td> <input required type="number" disabled style="width:100px" class="form-control"
                                                    name="wktkrj"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-success">Next</button>
                        <br>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal 1 -->
    <div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title">Dokumen Belum Selesai</h5>
        <button type="button" class="close" data-dismiss="modal" data-toggle="modal"
                    data-target="#myModal2" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
                <div class="modal-body">
                    <p>Terdapat Dokumen yang Belum selesai? <br><br>
                    Apakah Anda ingin melanjutkan?
                    </p>
                </div>
                <div class="modal-footer">
                <a href="/resume/{{$data}}" class="btn btn-success" role="button" aria-pressed="true">Ya</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal"
                    data-target="#myModal2">Tidak</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal 2 -->
    <div id="myModal2" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" data-toggle="modal"
                    data-target="#myModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <div class="modal-body">
                    <p>Data Akan Dihapus, apakah anda yakin?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"
                    data-target="#myModal">Tidak</button>
                    <a href="/refresh/{{$data}}" style="color:#fff" class="btn btn-danger" role="button"
                                    aria-pressed="true">Ya</a>
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