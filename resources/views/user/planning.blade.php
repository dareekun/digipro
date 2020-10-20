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
                                <th scope="col">Job Id</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Line</th>
                                <th scope="col">Tipe Produk</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Planning</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                        @if ($dt["bagian"] == "")

                        @else 
                        <tr>
                                <td>{{$dt["job_number"]}}</td>
                                <td>{{$dt["bagian"]}}</td>
                                <td>{{$dt["line"]}}</td>
                                <td>{{$dt["assembly_item_name"]}}</td>
                                <td>{{date('d M Y', strtotime($dt["job_start_date"]))}}</td>
                                <td>{{$dt["plan_qty"]}}</td>
                            </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
        $(document).ready(function() {
            $('#test').DataTable({
                order: [[0, 'desc']],
                scrollY: '50vh',
                paging: false,
                info: false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                ]
            });
        });
    </script>
@endpush