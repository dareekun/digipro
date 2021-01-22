@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <table style="width:100%">
                <tr>
                <td>Urus Masalah</td>
                <td style="width:80%" align="right">
                <a href="/pengaturan/masalah" class="btn-sm btn-primary" role="button" aria-pressed="true">Masalah</a>
                <a href="/pengaturan/shift" class="btn-sm btn-success" role="button" aria-pressed="true">Shift</a>
                <a href="/admin/produk" class="btn-sm btn-secondary" role="button" aria-pressed="true">Produk</a>
                </td>
                </tr>
                </table>
                        </div>
                <div class="card-body">
                <div class="row">
                <div class="col-sm-10"></div>
                <div class="col-sm-2" align="right">
                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#tambahmasalah"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Masalah</button>
                </div>
                </div>
                <br>
                    <div class="row">
                    </div>
                    <table id="test" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Masalah</th>
                                <th scope="col">Masalah</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data1 as $dt1)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Defect Loss</td>
                        <td>{{$dt1->loss}}</td>
                        <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt1->id}}, 0, '{{$dt1->loss}}', '{{$dt1->sect}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('defect_loss', {{$dt1->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                        </tr>
                        @endforeach
                        @foreach ($data2 as $dt2)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Organisation Loss</td>
                        <td>{{$dt2->loss}}</td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt2->id}}, 1, '{{$dt2->loss}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('organization_loss', {{$dt2->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        @endforeach
                        @foreach ($data3 as $dt3)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Requlated Loss</td>
                        <td>{{$dt3->loss}}</td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt3->id}}, 2, '{{$dt3->loss}}', '{{$dt3->sect}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('regulated_loss', {{$dt3->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        @endforeach
                        @foreach ($data4 as $dt4)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Stop Loss</td>
                        <td>{{$dt4->loss}}</td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt4->id}}, 3, '{{$dt4->loss}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('stop_loss', {{$dt4->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        @endforeach
                        @foreach ($data5 as $dt5)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Work Loss</td>
                        <td>{{$dt5->loss}}</td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt5->id}}, 4, '{{$dt5->loss}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('work_loss', {{$dt5->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        @endforeach
                        @foreach ($data6 as $dt6)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>Ability Loss</td>
                        <td>{{$dt6->loss}}</td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt6->id}}, 5, '{{$dt6->loss}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus('ability_loss', {{$dt6->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dll.modalmasalah')

@stop

@push('scripts')
<script>
function test() {
    var x = document.getElementById("jenis").value;
 if (x == "defect_loss" || x == "regulated_loss"){
    document.getElementById("baris").removeAttribute("hidden");
    document.getElementById("section").setAttribute("required", true); 
 }
 else {
    document.getElementById("baris").setAttribute("hidden", true); 
    document.getElementById("section").removeAttribute("required");
 }
}

function hapus(x, y) {
    document.getElementById("dbhapus").value = x;
    document.getElementById("idhapus").value = y;
    $('#hapusmasalah').modal('show')
}

function edit(a, b, c, d) {
    var array = ['defect_loss', 'organization_loss', 'regulated_loss', 'stop_loss', 'work_loss', 'ability_loss'];

    document.getElementById("jenisbakallock").selectedIndex = b;
    document.getElementById("jenisbakallock").disabled = true;

    if (b == 0 || b == 2){
    document.getElementById("edit03").setAttribute("required", true); 

    var sect = ["biasa", "mesin"];
    var e = sect.indexOf(d);

    document.getElementById("edit03").selectedIndex = e;
 }
 else {
    document.getElementById("edit03baris").setAttribute("hidden", true); 
    document.getElementById("edit03").removeAttribute("required");
 }

    document.getElementById("edit00").value = a;
    document.getElementById("edit01").value = array[b];
    document.getElementById("edit02").value = c;
    $('#rubahmasalah').modal('show')
}
</script>
@endpush