@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row my-2">
        <div class="col-md-12">
            @if (session()->has('alerts'))
            <div class="alert {{ session('alerts.type') }} alert-dismissible fade show" role="alert">
                {{ session('alerts.message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Product Control
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#add_product">
                                Add Product
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Market</th>
                                        <th>Section</th>
                                        <th>Line</th>
                                        <th>Model Number</th>
                                        <th>Packing</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $dt)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$dt->market}}</td>
                                        <td>{{$dt->section}}</td>
                                        <td>{{$dt->line}}</td>
                                        <td><a href="{{route('detail_product', $dt->id)}}" style="text-decoration: none;">{{$dt->model_no}}</a></td>
                                        <td>{{$dt->packing}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="throw_edit({{$dt->id}})"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="throw_delete({{$dt->id}})"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></button>
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
        <!-- Add Modal -->
        <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('add_product')}}" method="post">
                        @csrf
                        <div class="modal-body">
                        <div class="row mt-1">
                                <div class="col-md-5">Market</div>
                                <div class="col-md-7">
                                    <select class="form-control" name="market_add">
                                            <option value="Domestic">Domestic</option>
                                            <option value="Export">Export</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Section</div>
                                <div class="col-md-7"><input type="text" required class="form-control"
                                        name="section_add"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Line</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="line_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Model Number</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="model_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Packing</div>
                                <div class="col-md-7"><input type="number" required class="form-control"
                                        name="packing_add"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Tact Time</div>
                                <div class="col-md-7"><input type="number" step="0.01" required class="form-control"
                                        name="time_add"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Standard Man Power</div>
                                <div class="col-md-7"><input type="number" required class="form-control" name="man_add">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="edit_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('edt_product')}}" method="post">
                        <input hidden type="text" value="" name="value_uid_edit" id="value_uid_edit">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Market</div>
                                <div class="col-md-7">
                                    <select class="form-control" name="market_edit" id="market_edit">
                                            <option value="Domestic">Domestic</option>
                                            <option value="Export">Export</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Section</div>
                                <div class="col-md-7"><input type="text" required class="form-control"
                                        name="section_edit" id="section_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Line</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="line_edit"
                                        id="line_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Model Number</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="model_edit"
                                        id="model_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Packing</div>
                                <div class="col-md-7"><input type="number" required class="form-control"
                                        name="packing_edit" id="packing_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Tact Time</div>
                                <div class="col-md-7"><input type="number" step="0.01" required class="form-control"
                                        name="time_edit" id="time_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Standard Man Power</div>
                                <div class="col-md-7"><input type="number" required class="form-control" name="man_edit"
                                        id="man_edit"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="delete_product" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-1">
                            <div class="col-md-5">Market</div>
                            <div class="col-md-7">: <span id="market_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Section</div>
                            <div class="col-md-7">: <span id="section_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Line</div>
                            <div class="col-md-7">: <span id="line_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Model Number</div>
                            <div class="col-md-7">: <span id="model_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Packing</div>
                            <div class="col-md-7">: <span id="packing_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Tact Time</div>
                            <div class="col-md-7">: <span id="time_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Standard Man Power</div>
                            <div class="col-md-7">: <span id="man_delete"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('del_product')}}" method="post">
                            @csrf
                            <input hidden type="number" value="0" id="value_uid_delete" name="value_uid_delete">
                            <button type="submit" class="btn btn-danger">Delete Product</button>
                        </form>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script>
var table = $('#table_records').DataTable({
    dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
});

function throw_delete(uid) {
    axios.post("{{route('data_product')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("value_uid_delete").value = uid;
            document.getElementById("market_delete").innerHTML = response.data[0].market;
            document.getElementById("section_delete").innerHTML = response.data[0].section;
            document.getElementById("line_delete").innerHTML = response.data[0].line;
            document.getElementById("model_delete").innerHTML = response.data[0].model_no;
            document.getElementById("packing_delete").innerHTML = response.data[0].packing;
            document.getElementById("time_delete").innerHTML = response.data[0].time;
            document.getElementById("man_delete").innerHTML = response.data[0].std_mp;
        })
    $('#delete_product').modal('show');
}

function throw_edit(uid) {
    axios.post("{{route('data_product')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("value_uid_edit").value = uid;
            document.getElementById("market_edit").value = response.data[0].market;
            document.getElementById("section_edit").value = response.data[0].section;
            document.getElementById("line_edit").value = response.data[0].line;
            document.getElementById("model_edit").value = response.data[0].model_no;
            document.getElementById("packing_edit").value = response.data[0].packing;
            document.getElementById("time_edit").value = response.data[0].time;
            document.getElementById("man_edit").value = response.data[0].std_mp;
        })
    $('#edit_product').modal('show');
}
</script>
@endpush