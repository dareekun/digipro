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
                        <table style="width:50%" id="dynamic_field">
                                            <tr>
                                                <td align="left">Part Name</td>
                                                <td align="center"> Opsi</td>
                                            </tr>
                                            @foreach ($data as $dt)
                                            <tr>
                                                <td><input type="text" disabled class="form-control" 
                                                        value="{{$dt->partname}}"></td>
                                                        <td align="center">
                                                        <a type="button" name="remove" href="/admin/produk/parts/hapus/{{$dt->id}}" class="btn btn-danger btn_remove"><i class="fa fa-times-circle" aria-hidden="true"></i> Hapus</a>
                                                        </td>
                                            </tr>
                                            @endforeach
                                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush