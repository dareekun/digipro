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
                    <div wire:ignore class="row justify-content-center" id="{{$dummy_render}}">
                        <div class="col-md-12">
                            <table id="table_records" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Section</th>
                                        <th>Line</th>
                                        <th>Model Number</th>
                                        <th>Packing</th>
                                        <th>Time</th>
                                        <th>Std_MP</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $dt)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$dt->section}}</td>
                                        <td>{{$dt->line}}</td>
                                        <td>{{$dt->model_no}}</td>
                                        <td>{{$dt->packing}}</td>
                                        <td>{{$dt->time}}</td>
                                        <td>{{$dt->std_mp}}</td>
                                        <td><button class="btn btn-sm btn-outline-danger" onclick="throw_delete({{$dt->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
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
        <div wire:ignore class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="add">
                        <div class="modal-body">
                                    <div class="row mt-1">
                                        <div class="col-md-5">Section</div>
                                        <div class="col-md-7"><input type="text" required class="form-control"
                                                wire:model.defer="section_add"></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Line</div>
                                        <div class="col-md-7"><input type="text" required class="form-control"
                                                wire:model.defer="line_add"></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Model Number</div>
                                        <div class="col-md-7"><input type="text" required class="form-control"
                                                wire:model.defer="model_add"></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Packing</div>
                                        <div class="col-md-7"><input type="number" required class="form-control"
                                                wire:model.defer="packing_add"></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Tact Time</div>
                                        <div class="col-md-7"><input type="number" step="0.01" required
                                                class="form-control" wire:model.defer="time_add"></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Standard Man Power</div>
                                        <div class="col-md-7"><input type="number" required class="form-control"
                                                wire:model.defer="man_add"></div>
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
        
        <!-- Delete Modal -->
        <div wire:ignore class="modal fade" id="delete_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <div class="col-md-5">Section</div>
                                        <div class="col-md-7">: <span id="section_delete"></span></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Line</div>
                                        <div class="col-md-7">:  <span id="line_delete"></span></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Model Number</div>
                                        <div class="col-md-7">:  <span id="model_delete"></span></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Packing</div>
                                        <div class="col-md-7">:  <span id="packing_delete"></span></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Tact Time</div>
                                        <div class="col-md-7">:  <span id="time_delete"></span></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-5">Standard Man Power</div>
                                        <div class="col-md-7">:  <span id="man_delete"></span></div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" wire:click="delete">Delete Product</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>