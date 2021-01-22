@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <table style="width:100%">
                    <tr>
                    <td align="left">Lot Card</td>
                    <td align="right">
                    <a href="/lotstatus" class="btn-sm btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                    <a href="/cetaklot/{{$id}}" class="btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a></td>
                    </tr>
                    </table>
                    </div>
                    <div class="card-body" align="center">
                    @include('dll.lotdetail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection