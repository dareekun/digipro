@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Planning {{$tipe}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10" align="left"> <a href="/user/planning/Assy WD" class="btn-sm btn-primary"
                                role="button" aria-pressed="true">Assy WD</a>
                            <a href="/user/planning/Metal Part" class="btn-sm btn-success" role="button"
                                aria-pressed="true">Metal Part</a>
                            <a href="/user/planning/Export" class="btn-sm btn-secondary" role="button"
                                aria-pressed="true">Export</a>
                        </div>
                        <div class="col-sm-2" align="right">
                            <a href="/admin/planning" class="btn btn-sm btn-outline-primary" role="button"
                                aria-pressed="true">Tambah Planning</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    </div>
                    <table id="test" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Bagian</th>
                                <th scope="col">Line</th>
                                <th scope="col">Tipe Produk</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Planning</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{$dt->bagian}}</td>
                                <td>{{$dt->tempat}}</td>
                                <td>{{$dt->tipe}}</td>
                                <td>{{$dt->bulan}}</td>
                                <td>{{$dt->qty}}</td>
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