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
                            <div class="col-md-4">
                                <h3>Item Produk</h3>
                            </div>
                            <div class="col-md-8" align="right">
                            <a class="btn btn-sm btn-outline-success" href="/admin/tambahproduk"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Produk</a>
                            </div>
                        </div>
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
                        <td>{{$dt->tipe}}</td>
                        <td>{{$dt->qtyinner}}</td>
                        <td>{{$dt->qtyouter}}</td>
                        <td>
                        <a class="btn btn-sm btn-outline-success" href="/admin/{{$dt->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                        <a class="btn btn-sm btn-outline-danger" href="/admin/{{$dt->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
    
@endsection