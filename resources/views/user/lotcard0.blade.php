@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lot Card</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Please Select Line First</h3>
                        </div>
                        <div class="col-md-8" align="right">
                        </div>
                    </div>
                    <form action="/lotcardalpha" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                Bagian
                            </div>
                            <div class="col-md-3">
                                <select required class="form-control" name="bagian" id="bagian">
                                    <option value=""></option>
                                    @foreach($data as $l)
                                        <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                        @endforeach
                                </select>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    Line
                                </div>
                                <div class="col-md-3">
                                    <select required class="form-control" name="tempat" id="tempat">
                                        <option value=""></option>
                                    </select>
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        Tipe
                                    </div>
                                    <div class="col-md-3">
                                    <select name="tipe" id="tipe" class="form-control selectpicker"
                                            data-live-search="true">
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="form-control">Submit</button>
                        </div>
                        </div>
                    </form>
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
                    $('#tipe').append(new Option(tipe, tipe));
                })
                $('#tipe').selectpicker('refresh');
            });
    });
});
</script>
@endpush