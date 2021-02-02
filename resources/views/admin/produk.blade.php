@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><table style="width:100%">
                <tr>
                <td>Pengaturan Produk</td>
                <td style="width:80%" align="right">
                <a href="/pengaturan/masalah" class="btn-sm btn-primary" role="button" aria-pressed="true">Masalah</a>
                <a href="/pengaturan/shift" class="btn-sm btn-success" role="button" aria-pressed="true">Shift</a>
                <a href="/admin/produk" class="btn-sm btn-secondary" role="button" aria-pressed="true">Produk</a>
                </td>
                </tr>
                </table></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                            <table>
                                    <tr>
                                        <td><select name="tag1" class="form-control form-control-sm" id="bagian">
                                                <option value=""></option>
                                                @foreach($bagian as $l)
                                                <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm" style="width:150px" name="tag2" id="tempat">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
                                        <button id="reset" onclick="reset()" class="btn btn-sm btn-primary">Reset</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4" align="right">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal"
                                data-target="#tambah"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah
                                Produk</button>
                            </div>
                        </div>
                        <br>
                        <table id="test" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                        <th scope="col">Bagian</th>
                        <th scope="col">Line</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Qty Inner</th>
                        <th scope="col">Qty Outer</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                        <tr>
                        <td>{{$dt->bagian}}</td>
                        <td>{{$dt->tempat}}</td>
                        <td><a href="/admin/produk/{{$dt->tipe}}">{{$dt->tipe}}</a></td>
                        <td>{{$dt->qtyinner}}</td>
                        <td>{{$dt->qtyouter}}</td>
                        <td>
                        <a class="btn btn-sm btn-outline-primary" href="/admin/editproduk/{{$dt->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapus({{$dt->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
@include('dll.modalproduk')
@stop

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#test').DataTable({
        order: [[0, 'desc']],
        scrollY: '50vh',
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
 
                $('#bagian').on( 'keyup change clear', function () {
                    if ( table.column(0).search() !== document.getElementById('bagian').value ) {
                        table
                            .column(0)
                            .search( this.value )
                            .draw();
                    }
                } );
                $('#tempat').on( 'keyup change clear', function () {
                    if ( table.column(1).search() !== document.getElementById('tempat').value ) {
                        table
                            .column(1)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );
$(function() {
    $('#bagian').on('change', function() {
        axios.post('{{ route('data1-json.data1') }}', {
                    bag: $(this).val()
                })
            .then(function(response) {
                $('#tempat').empty();
                $('#tempat').append(new Option("", ""));
                $.each(response.data, function(tempat, tempat) {
                    $('#tempat').append(new Option(tempat, tempat))
                })
            });
    });
});
function reset() {
    document.getElementById('bagian').value = '';
    document.getElementById('tempat').value = '';
    $('#test').DataTable().columns().search('').draw();
}
function hapus(x) {
    document.getElementById("idhapus").value = x;
    $('#hapus').modal('show')
}
</script>
@endpush