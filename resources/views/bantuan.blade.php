@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Isi</div>
                    <div class="card-body">
                    <h3>Bantuan</h3>
                        <br>
                        <div class="row">
                        <table id="test" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td><button value="tambahlotcard" type="submit" class="btn btn-sm btn-light">
                                Bagaimana Cara Menambah Lot Card Baru?
                                </button></td>
                                <td><button value="tambahproduk" type="submit" class="btn btn-sm btn-light">
                                Bagaimana Cara Menambah Produk Baru?
                                </button></td>
                                <td><button value="tambahmasalah" type="submit" class="btn btn-sm btn-light">
                                Bagaimana Cara Menambah Masalah Baru?
                                </button></td>
                                <td><button value="tambahshift" type="submit" class="btn btn-sm btn-light">
                                Bagaimana Cara Menambah Shift Baru?
                                </button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $(document).ready(function() {
    var table = $('#test').DataTable({
        order: [[0, 'asc']],
        scrollY: '25vh',
        paging: false,
        info: false,
    });
} );
</script>
@endpush