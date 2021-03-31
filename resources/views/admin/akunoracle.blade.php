@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Akun Oracle</div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-4">
                            Update Akun Oracle
                        </div>
                        <div class="col-md-6">
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
                    @foreach ($data as $dt)
                    <form action="oraclesave" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-2">Username</div>
                        <div class="col-md-3"><input type="text" id="username" class="form-control" placeholder="Masukan Username" value="{{$dt->username}}" name="username" ></div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-2">Password</div>
                        <div class="col-md-3"><input type="text" class="form-control" placeholder="Masukan Password" value="{{$dt->password}}" id="password" name="password" ></div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-3" align="right"><button type="submit" class="btn btn-outline-success">Submit</button></div>
                        </div>
                    </form>
                    @endforeach
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