@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lotcard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Lot Card</h3>
                            </div>
                            <div class="col-md-9" align="right">
                                <a href="/lotcard0" class="btn-sm btn-success" role="button" target="_blank"
                                    aria-pressed="true"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Lotcard</a>
                            </div>
                        </div>
                        <table id="test" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Main</th>
                                    <th scope="col">Model No</th>
                                    <th scope="col">Lot No</th>
                                    <th scope="col">Shift</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->tempat }}</td>
                                    <td><a style="color: #000" target="_blank" href="/cetaklot/{{$d->barcode}}">
                                        {{ $d->modelno }}</a></td>
                                    <td>{{ $d->lotno }}</td>
                                    <td>{{ $d->shift }}</td>
                                    <td>{{ $d->name2 }}</td>
                                    <td>
                                    @if($d->status==0)
                                    <button class="btn btn-sm btn-info" type="button" role="button" aria-pressed="true"><i class="fa fa-square-o" aria-hidden="true"></i></button>
                                    @else
                                    <button class="btn btn-sm btn-success" type="button" role="button" aria-pressed="true"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                                    @endif
                                    @can('isAdmin')
                                    <a href="/dellot/{{$d->barcode}}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @endcan
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