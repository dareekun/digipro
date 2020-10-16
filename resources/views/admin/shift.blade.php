@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table style="width:100%">
                        <tr>
                            <td>Pengaturan Shift</td>
                            <td style="width:80%" align="right">
                                <a href="/pengaturan/masalah" class="btn-sm btn-primary" role="button"
                                    aria-pressed="true">Masalah</a>
                                <a href="/pengaturan/shift" class="btn-sm btn-success" role="button"
                                    aria-pressed="true">Shift</a>
                                <a href="/admin/produk" class="btn-sm btn-secondary" role="button"
                                    aria-pressed="true">Produk</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8" align="right">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                data-target="#tambah"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah
                                Shift</button>
                        </div>
                    </div>
                    <br>
                    <table id="test" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Shift</th>
                                <th scope="col">Start</th>
                                <th scope="col">Finsih</th>
                                <th scope="col">Duration</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$dt->shift}}</td>
                                <td>{{$dt->start}}</td>
                                <td>{{$dt->finish}}</td>
                                <td>{{$dt->duration}}</td>
                                <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="edit({{$dt->id}}, '{{$dt->shift}}', '{{$dt->start}}', '{{$dt->finish}}')"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus({{$dt->id}})"><i
                                            class="fa fa-trash" aria-hidden="true"></i></button>
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
@include('dll.modalshift')
@stop

@push('scripts')
<script>
function hapus(x) {
    document.getElementById("idhapus").value = x;
    $('#hapus').modal('show')
}

function edit(a, b, c, d) {
    document.getElementById("idedit").value = a;
    document.getElementById("shiftedit").value = b;
    document.getElementById("startedit").value = c;
    document.getElementById("finishedit").value = d;
    $('#edit').modal('show')
}

</script>
@endpush