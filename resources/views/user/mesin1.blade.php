@extends('layouts.app')

@section('content')
@section('content')
@if ($status=="belum")
<script>
$(document).ready(function() {
    $("#myModal").modal('show');
});
</script>
@else
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <table style="width:100%">
                <tr>
                <td style="width:50%">Input</td>
                <td><a href="/data/Assy WD" class="btn-sm btn-info" style="color:#fff" role="button" aria-pressed="true">Assy
                                    WD</a></td>
                            <td><a href="/data/Assy Part Compression" style="color:#fff" class="btn-sm btn-info" role="button"
                                    aria-pressed="true">Mesin Compression</a></td>
                            <td><a href="/data/Assy Part Injection" style="color:#fff" class="btn-sm btn-info" role="button"
                                    aria-pressed="true">Mesin Injection</a></td>
                            <td><a href="/data/Metal Part" style="color:#fff" class="btn-sm btn-info" role="button"
                                    aria-pressed="true">Metal Part</a></td>
                            <td><a href="/data/Export" style="color:#fff" class="btn-sm btn-info" role="button"
                                    aria-pressed="true">Export</a></td>
                </tr>
                </table>
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
                    <form action="/mesin2" method="post">
                    {{ csrf_field() }}
                    <table>
                    <tr>
                    <td>
                    <table>
                    <tr><td>Tanggal </td><td> <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal"></td></tr>
                    <tr><td>Tipe Mesin</td><td> <input type="text" class="form-control" value="{{$bagian}}" name="bagian"></td></tr>
                    <tr><td>Nomor Mesin</td><td> <input type="number" min="0" max="28" required class="form-control" name="nomor"></td></tr>
                    <tr><td>Shift</td><td> <select name="shift"  class="custom-select">
                            @foreach($waktu as $w)
                                <option value="{{$w->shift}}">{{$w->shift}}</option>
                            @endforeach
                                </select></td></tr>
                    </table>
                    </td>
                    <td>
                    <table>
                    <tr>
                    <td>Nama PIC </td><td> <input required type="text" style="width:250px" class="form-control" name="pic"></td>
                    </tr>
                    <tr>
                    <td>Nama Part/Product </td><td><input required type="text" style="width:250px" class="form-control" name="tipe"></td>
                    </tr>
                    <tr>
                    <td>Start Production </td><td><input disabled type="time" style="width:250px" class="form-control" name="start"></td>
                    </tr>
                    <tr>
                    <td>Finish Production</td><td><input disabled type="time" style="width:250px" class="form-control" name="finish"></td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-success">Next</button>
                    <br>
                    </form>
                  
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
                <a href="/resumim/{{$data}}" class="btn btn-success" role="button" aria-pressed="true">Ya</a>
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
                    <a href="/refreshing/{{$data}}" style="color:#fff" class="btn btn-danger" role="button"
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