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
                            Users Control
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#add_printer">
                                Add Printer Device
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Device Name</th>
                                        <th>Device IP</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($printer as $prt)
                                    <tr>
                                        <td>{{$prt->id}}</td>
                                        <td>{{$prt->device_name}}</td>
                                        <td>{{$prt->ip}}</td>
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
        <div class="modal fade" id="add_printer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Printer Device</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('add_printer')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Device Name</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="name_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Device IP</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="ip_add">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Printer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="edit_printer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Printer Device</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('edt_printer')}}" method="post">
                        <input hidden type="text" value="" name="uid_edit" id="uid_edit">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Device Name </div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="name_edit" id="name_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Device IP</div>
                                <div class="col-md-7"><input type="text" class="form-control" name="ip_edit" id="ip_edit"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Printer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="delete_printer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-1">
                            <div class="col-md-5">ID</div>
                            <div class="col-md-7">: <span id="id_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Device Name</div>
                            <div class="col-md-7">: <span id="name_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Device ID</div>
                            <div class="col-md-7">: <span id="ip_delete"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('del_printer')}}" method="post">
                            @csrf
                            <input hidden type="number" value="0" id="uid_delete" name="uid_delete">
                            <button type="submit" class="btn btn-danger">Delete Printer</button>
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
    axios.post("{{route('data_printer')}}", {id: uid})
        .then(function(response) {
            document.getElementById("uid_delete").value = uid;
            document.getElementById("name_delete").innerHTML = response.data[0].device_name;
            document.getElementById("ip_delete").innerHTML = response.data[0].ip;
        })
    $('#delete_printer').modal('show');
}
function throw_edit(uid) {
    axios.post("{{route('data_printer')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("uid_edit").value = uid;
            document.getElementById("name_edit").innerHTML = response.data[0].device_name;
            document.getElementById("ip_edit").innerHTML = response.data[0].ip;
        })
    $('#edit_printer').modal('show');
}
</script>
@endpush