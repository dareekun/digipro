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
                                <a href="/pengaturan/masalah" class="btn btn-sm btn-primary" role="button"
                                    aria-pressed="true">Masalah</a>
                                <a href="/pengaturan/shift" class="btn btn-sm btn-success" role="button"
                                    aria-pressed="true">Shift</a>
                                <a href="/admin/produk" class="btn btn-sm btn-secondary" role="button"
                                    aria-pressed="true">Produk</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-4">
                            <select class="form-control form-control-sm" id="tipemasalah">
                                <option value=""></option>
                                @foreach ($problemtype as $mas)
                                <option value="{{$mas->type}}">{{$mas->type}}</option>
                                @endforeach
                            </select>
                                </div>
                                <div class="col-md-4">
                                    
                            <button type="reset" class="btn btn-sm btn-outline-info" onclick="reset()">Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2" align="right">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                data-target="#tambahmasalah"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                Tambah Masalah</button>
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
                                <th scope="col">Remark</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$dt->type}}</td>
                                <td>{{$dt->loss}}</td>
                                <td>{{$dt->remark}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        onclick="edit({{$dt->id}}, '{{$dt->loss}}', '{{$dt->type}}', '{{$dt->remark}}')"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="hapus({{$dt->id}})"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<datalist id="problemtype">
    @foreach ($problemtype as $problem)
    <option value="{{$problem->type}}">
        @endforeach
</datalist>

@include('dll.modalmasalah')

@stop

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#test').DataTable({
        order: [
            [0, 'asc']
        ],
        info: false,        
        initComplete: function() {
            // Apply the search
            this.api().columns().every(function() {
                $('#tipemasalah').on('keyup change clear', function() {
                    if (table.column(1).search() !== document.getElementById(
                            'tipemasalah').value) {
                        table
                            .column(1)
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
});

function reset() {
    document.getElementById('tipemasalah').value = '';
    $('#test').DataTable().columns().search('').draw();
}

function hapus(x) {
    document.getElementById("idhapus").value = x;
    $('#hapusmasalah').modal('show')
}

function edit(a, b, c, d) {
    document.getElementById("edit00").value = a;
    document.getElementById("edit01").value = c;
    document.getElementById("edit02").value = b;
    document.getElementById("edit03").value = d;
    $('#rubahmasalah').modal('show')
}
</script>
@endpush