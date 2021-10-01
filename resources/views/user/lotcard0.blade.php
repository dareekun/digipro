@extends('layouts.app')

@section('content')
@if($errors->any())
<script>
$(document).ready(function() {
    $("#modallot1").modal('show');
});
</script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lot Card</div>
                <div class="card-body">
                    <div class="row">
                    <!-- Tag Pilih Sendiri -->
                    <div class="col-md-4">
                    <h3>Please Select Line First</h3>
                    <form action="/lotcardalpha" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                Bagian
                            </div>
                            <div class="col-md-8">
                                <select required class="form-control" name="bagian" id="bagian">
                                    <option value=""></option>
                                    @foreach($line as $l)
                                        <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                        @endforeach
                                </select>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    Line
                                </div>
                                <div class="col-md-8">
                                    <select required class="form-control" name="tempat" id="tempat">
                                        <option value=""></option>
                                    </select>
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        Tipe
                                    </div>
                                    <div class="col-md-8">
                                    <select name="tipe" id="tipe" class="form-control selectpicker"
                                            data-live-search="true">
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5">
                                    <button onclick="reset()" class="form-control btn btn-dark">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="form-control btn btn-success">Submit</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modallot1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Lotcard Tidak Memiliki Part
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $(document).ready(function() {
    var table = $('#test').DataTable({
        order: [[3, 'asc']],
        scrollY: '25vh',
        paging: false,
        info: false,
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                $('#tempat').on( 'keyup change clear', function () {
                    if ( table.column(1).search() !== document.getElementById('tempat').value ) {
                        table
                            .column(1)
                            .search( this.value )
                            .draw();
                    }
                } );
                $('#tipe').on( 'keyup change clear', function () {
                    if ( table.column(2).search() !== document.getElementById('tipe').value ) {
                        table
                            .column(2)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
} );
function reset() {
    document.getElementById('bagian').value = '';
    document.getElementById('tempat').value = '';
    $('#test').DataTable().columns().search('').draw();
}
</script>
<script>
$(function() {
    $('#bagian').on('change', function() {
        axios.post('{{ route('data1-json.data1') }}', {
                    bag: $(this).val()
                })
            .then(function(response) {
                $('#tempat').empty();
                $('#tipe').empty();
                $('#tempat').append(new Option("", ""));
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