@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <form action="/admin/tambahplan" method="post">
                    @csrf
                        <table>
                            <tr>
                                <td>Tanggal </td>
                                <td> : </td>
                                <td><input name="tanggal"value="{{ date('Y-m-d') }}" class="form-control" type="date"></td>
                            </tr>
                            <tr>
                                <td>Bagian </td>
                                <td> : </td>
                                <td><select name="bagian" class="custom-select" id="bagian">
                                <option selected value=""></option>
                                        @foreach($line as $l)
                                        <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                        @endforeach
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Line </td>
                                <td> : </td>
                                <td><select name="tempat" class="custom-select" id="tempat">
                                        <option selected value=""></option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Tipe Produk </td>
                                <td> : </td>
                                <td><select name="tipe" class="custom-select" id="tipe">
                                        <option selected value=""></option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Qty </td>
                                <td> : </td>
                                <td><input name="qty" class="form-control" type="number" min="0"></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td></td>
                            <td><input type="submit" class="btn btn-success" value="submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
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
$(function() {
    $('#bagian').on('change', function() {
        axios.post('{{ route('data1-json.data1') }}', {
                    bag: $(this).val()
                })
            .then(function(response) {
                $('#tempat').empty();
                $('#tipe').empty();

                $.each(response.data, function(tempat, tempat) {
                    $('#tempat').append(new Option(tempat, tempat))
                })
            });
    });
});
$(function() {
    $('#tempat').on('change', function() {
        axios.post('{{ route('data2-json.data2') }}', {
                    temt: $(this).val()
                })
            .then(function(response) {
                $('#tipe').empty();

                $.each(response.data, function(produk, tipe) {
                    $('#tipe').append(new Option(tipe, tipe))
                })
            });
    });
});
</script>
@endpush