@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-2">
                            Profile
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
                    <table>
                        @foreach($data as $d)
                        <tr>
                            <td>Nama </td>
                            <td> : {{ $d->name }}</td>
                        </tr>
                        <tr>
                            <td>Username </td>
                            <td> : {{ $d->username }}</td>
                        </tr>
                        <tr>
                            <td>Passwrod </td>
                            <td> : {{ $d->role }}</td>
                        </tr>
                        @endforeach

                    </table>
                    <br>
                    Update Password
                    <br>
                    <form action="/user/update" method="post">
                        {{ csrf_field() }}
                        <table>
                        <tr>
                        <td>
                        Old Password
                        <input type="password" class="form-control" name="oldpass" placeholder="Type The Password"></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td>New Password</td>
                        <td>Confirm New Password</td>
                        </tr>
                            <tr>
                                <td>
                                
                                <input type="password" class="form-control" name="password" placeholder="Type The Password">
                                </td>
                                <td><input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Re-type The Password "></td>
                                <td><button type="submit" class="btn btn-danger">Update</button></td>
                            </tr>
                        </table>
                        @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <small @if ($error=="Password Berhasil Dirubah") style="color:#7bc043" @else style="color:#fe4a49" @endif class="form-text"><strong>{{$error}}</strong></small>
                        @endforeach
                        @endif
                    </form>
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