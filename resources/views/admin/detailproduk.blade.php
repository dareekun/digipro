@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><table style="width:100%">
                <tr>
                <td>Simple BOM Produk {{$tipe}}</td>
                <td style="width:40%" align="right">
                </td>
                </tr>
                </table></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h3>Detail Item Produk</h3>
                            </div>
                        </div>
                        <div class="row my-3">
                        <div class="col-sm-3">Part Name</div>
                        <div class="col-sm-3">Opsi</div>
                        </div>
                        @foreach ($data as $dt)
                        <div class="row my-1">
                        <div class="col-sm-3">{{$dt->partname}}</div>
                        <div class="col-sm-1"><a type="button" name="remove" title="Hapus" href="/admin/produk/parts/hapus/{{$dt->id}}" class="btn btn-sm btn-danger btn_remove"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush