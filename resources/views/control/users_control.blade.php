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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#add_user">
                                Add User
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="row justify-content-center">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Nik</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $dt)
                                    <tr>
                                        <td>{{$dt->username}}</td>
                                        <td>{{$dt->name}}</td>
                                        <td>{{$dt->department}}</td>
                                        <td>{{$dt->role}}</td>
                                        <td>{{$dt->email}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="throw_edit({{$dt->id}})"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></button>
                                                    <button class="btn btn-sm btn-outline-info"
                                                onclick="throw_pass({{$dt->id}})"><i class="fa fa-key" aria-hidden="true"></i></button>
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
        <div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('add_users')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Name</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="name_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Nik</div>
                                <div class="col-md-7"><input type="number" required class="form-control" name="nik_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Password</div>
                                <div class="col-md-7"><input type="number" style="-webkit-text-security:disc;" minlength="6" required class="form-control" name="password_add">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Department</div>
                                <div class="col-md-7">
                                    <select class="form-control" required name="department_add">
                                        <option>Select Department</option>
                                        <option value="3">Production</option>
                                        <option value="4">Quality Control</option>
                                        <option value="5">Warehouse</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Role</div>
                                <div class="col-md-7">
                                    <select class="form-control" required name="role_add">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="user">User</option>
                                    </select></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Email</div>
                                <div class="col-md-7"><input type="email" class="form-control"
                                        name="email_add"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Users</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('edt_users')}}" method="post">
                        <input hidden type="text" value="" name="uid_edit" id="uid_edit">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Name</div>
                                <div class="col-md-7"><input type="text" required class="form-control" name="name_edit"
                                        id="name_edit"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Department</div>
                                <div class="col-md-7">
                                    <select class="form-control" id="department_edit" required name="department_edit">
                                        <option value="3">Production</option>
                                        <option value="4">Quality Control</option>
                                        <option value="5">Warehouse</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Role</div>
                                <div class="col-md-7">
                                    <select class="form-control" id="role_edit" required name="role_edit">
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Email</div>
                                <div class="col-md-7"><input type="email" class="form-control"
                                        name="email_edit" id="email_edit"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Users</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Modal -->
        <div class="modal fade" id="update_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('upd_users')}}" method="post">
                        <input hidden type="text" value="" name="password_id" id="password_id">
                        @csrf
                        <div class="modal-body">
                            <div class="row mt-1">
                                <div class="col-md-5">Name</div>
                                <div class="col-md-7"><input type="text" disabled value="" class="form-control" name="name_upd"
                                        id="name_upd"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Nik</div>
                                <div class="col-md-7"><input type="text" disabled value="" class="form-control" name="nik_upd"
                                        id="nik_upd"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5">Password</div>
                                <div class="col-md-7"><input type="number" minlength="6" required class="form-control"
                                        name="password1" style="-webkit-text-security:disc;" id="password1"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-5"></div>
                                <div class="col-md-7"><input type="number" minlength="6" required class="form-control"
                                        name="password2" style="-webkit-text-security:disc;" id="password2"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="delete_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="col-md-5">Name</div>
                            <div class="col-md-7">: <span id="name_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Nik</div>
                            <div class="col-md-7">: <span id="nik_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Department</div>
                            <div class="col-md-7">: <span id="department_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Role</div>
                            <div class="col-md-7">: <span id="role_delete"></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-5">Email</div>
                            <div class="col-md-7">: <span id="email_delete"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('del_users')}}" method="post">
                            @csrf
                            <input hidden type="number" value="0" id="uid_delete" name="uid_delete">
                            <button type="submit" class="btn btn-danger">Delete Users</button>
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
    axios.post("{{route('data_users')}}", {id: uid})
        .then(function(response) {
            document.getElementById("uid_delete").value = uid;
            document.getElementById("name_delete").innerHTML = response.data[0].name;
            document.getElementById("nik_delete").innerHTML = response.data[0].nik;
            document.getElementById("department_delete").innerHTML = response.data[0].department;
            document.getElementById("role_delete").innerHTML = response.data[0].role;
            document.getElementById("email_delete").innerHTML = response.data[0].email;
        })
    $('#delete_user').modal('show');
}

function throw_edit(uid) {
    axios.post("{{route('data_users')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("uid_edit").value = uid;
            document.getElementById("name_edit").value = response.data[0].name;
            document.getElementById("department_edit").value = response.data[0].department;
            document.getElementById("role_edit").value = response.data[0].role;
            document.getElementById("email_edit").value = response.data[0].email;
        })
    $('#edit_user').modal('show');
}

function throw_pass(uid) {
    axios.post("{{route('data_users')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("password_id").value = uid;
            document.getElementById("name_upd").value = response.data[0].name;
            document.getElementById("nik_upd").value = response.data[0].username;
        })
    $('#update_password').modal('show');
}
</script>
@endpush