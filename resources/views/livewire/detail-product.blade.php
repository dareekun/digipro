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
                    Detail Product {{$model_number}}
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" wire:model="new_parts" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row justify-content-end mt-4">
                                <div class="col-md-5"><button class="btn btn-outline-success w-100" wire:click="add">Add
                                        Parts</button></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table id="table_records" class="table table-striped table-bordered w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:50px">No</th>
                                        <th>Parts</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parts as $pt)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$pt->part_name}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="throw_delete({{$pt->id}})"><i class="fa fa-trash"
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
    </div>
    
<!-- Delete Modal -->
<div class="modal fade" id="delete_parts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure, wanna delete this parts <b id="part_delete"></b> from product {{$model_number}} ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="remove">Delete Parts</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>