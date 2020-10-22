@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Planning {{$tipe}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2" align="left"> 
                        </div>
                        <div class="col-sm-10" align="right">
                        <form action="/user/planning" method="post">
                                {{ csrf_field() }}
                                <table>
                                    <tr>
                                        <td><select name="tag1" class="form-control form-control-sm" id="bagian">
                                                <option value=""></option>
                                                @foreach($bagian as $l)
                                                <option value="{{$l->bagian}}">{{$l->bagian}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm" style="width:150px" name="tag2" id="tempat">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control form-control-sm" value="" name="tag3" id="tanggal">
                                        </td>
                                        <td>
                                        <input type="submit" class="btn btn-sm btn-dark" value="Submit">
                                        </td>
                                    </tr>
                                </table>
                            </form>
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
        $(function() {
    $('#bagian').on('change', function() {
        axios.post('{{ route('data1-json.data1') }}', {
                    bag: $(this).val()
                })
            .then(function(response) {
                $('#tempat').empty();
                $('#tempat').append(new Option("", ""));
                $.each(response.data, function(tempat, tempat) {
                    $('#tempat').append(new Option(tempat, tempat))
                })
            });
    });
});
    </script>
@endpush