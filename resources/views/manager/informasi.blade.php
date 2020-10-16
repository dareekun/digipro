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
                            Rubah Informasi
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
                    <form action="Informasi/update" method="post">
                    {{ csrf_field() }}
                    <table style="width:100%">
                    <!-- info 1 -->
                    <tr>
                    <td style="width:3%" align="center">
                    1
                    </td>
                    <td>
                    <input type="text" value="{{$info1}}" class="form-control" name="info1" id="info1" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 2 -->
                    <tr>
                    <td style="width:3%" align="center">
                    2
                    </td>
                    <td>
                    <input type="text" value="{{$info2}}" class="form-control" name="info2" id="info2" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 3 -->
                    <tr>
                    <td style="width:3%" align="center">
                    3
                    </td>
                    <td>
                    <input type="text" value="{{$info3}}" class="form-control" name="info3" id="info3" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 4 -->
                    <tr>
                    <td style="width:3%" align="center">
                    4
                    </td>
                    <td>
                    <input type="text" value="{{$info4}}" class="form-control" name="info4" id="info4" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 5 -->
                    <tr>
                    <td style="width:3%" align="center">
                    5
                    </td>
                    <td>
                    <input type="text" value="{{$info5}}" class="form-control" name="info5" id="info5" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 6 -->
                    <tr>
                    <td style="width:3%" align="center">
                    6
                    </td>
                    <td>
                    <input type="text" value="{{$info6}}" class="form-control" name="info6" id="info6" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 7 -->
                    <tr>
                    <td style="width:3%" align="center">
                    7
                    </td>
                    <td>
                    <input type="text" value="{{$info7}}" class="form-control" name="info7" id="info7" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 8 -->
                    <tr>
                    <td style="width:3%" align="center">
                    8
                    </td>
                    <td>
                    <input type="text" value="{{$info8}}" class="form-control" name="info8" id="info8" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 9 -->
                    <tr>
                    <td style="width:3%" align="center">
                    9
                    </td>
                    <td>
                    <input type="text" value="{{$info9}}" class="form-control" name="info9" id="info9" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <!-- info 10 -->
                    <tr>
                    <td style="width:3%" align="center">
                    10
                    </td>
                    <td>
                    <input type="text" value="{{$info10}}" class="form-control" name="info10" id="info10" placeholder="Please Input Information Here">
                    </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>
                    <br>
                    <button type="submit" class="btn btn-danger">Update</button>
                    </td>
                    </tr>
                    </table>
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