@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Lotcard Status
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('new_lotcard')}}" id="form" method="post" target="_blank">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3 offset-7">
                                <select name="tipe" id="tipe" class="selectpicker w-100" required data-live-search="true" 
                                data-toggle="popover" data-placement="top" data-content="Please Select Model Number"
                                data-size="10">
                                    <option value="">Model Number</option>
                                    @foreach ($products as $pd)
                                    <option value="{{$pd->id}}">{{$pd->model_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" onclick="qwerasd()" class="btn btn-outline-success w-100">New Lotcard</button>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Lot Number</th>
                                        <th>Shift</th>
                                        <th>Model Product</th>
                                        <th>FG</th>
                                        <th>NG</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr>
                                        <td><a href="{{route('show_lotcard', $dt->id)}}" style="text-decoration: none;" target="_blank">{{$dt->id}}</a></td>
                                        <td>{{date('Ymd', strtotime($dt->lotno))}}</td>
                                        <td>{{$dt->shift}}</td>
                                        <td>{{$dt->model_no}}</td>
                                        <td>{{$dt->finish_goods}}</td>
                                        <td>{{$dt->no_goods}}</td>
                                        <td>{{$dt->pic}}</td>
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
$('#table_records').DataTable({
        order: [
            [2, 'desc']
        ],
        dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
    });
    function qwerasd() {
        if (document.getElementById("tipe").value != "") {
            document.getElementById("form").submit(); 
            document.getElementById("tipe").selectedIndex = 0;
            document.getElementsByClassName("filter-option-inner-inner")[0].innerHTML = "Model Number";
            return false;
        } else {
            console.log(document.getElementById("tipe").value)
            $('.id').popover('show')
        }
    }
</script>
@endpush