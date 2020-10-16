@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>{{$tipe}}</h3>
                            </div>
                            <div class="col-md-9" align="right">
                                <a href="/tabel/{{$tipe}}" class="btn-sm btn-secondary" role="button"
                                    aria-pressed="true"><i class="fa fa-table" aria-hidden="true"></i> Tabel</a>
                                <a href="/graph/{{$tipe}}" class="btn-sm btn-success" role="button"
                                    aria-pressed="true"><i class="fa fa-pie-chart" aria-hidden="true"></i> Graph</a>
                            </div>
                        </div>
                        <table id="test" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Shift</th>
                                    <th scope="col">Tipe Produk</th>
                                    <th scope="col">Hasil Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>
                                        <a style="color: #000" href="/detail/{{$d->keyid}}">
                                        {{date('d F Y', strtotime($d->tanggal))}}</a></td>
                                    <td>{{ $d->pic }}</td>
                                    <td>{{ $d->shift }}</td>
                                    <td>{{ $d->line }}</td>
                                    <td>{{ $d->hasil }}</td>
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