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
                        <div class="col-md-12">
                            Modify Data Inspection
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-1 text-center align-self-center">Search</div>
                        <div class="col-md-3"><input type="text" class="form-control" wire:model.lazy="search" name="packing"></div>
                        <div class="col-md-2"><button class="btn btn-sm btn-outline-info h-100" wire:click="clear"><i class="fa fa-times" aria-hidden="true"></i> Clear</button></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>No Lot</th>
                                        <th>Model No</th>
                                        <th>Packing</th>
                                        <th>Total Box</th>
                                        <th>Lot size</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $index => $data )
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{date('Ymd', strtotime($data->lotno))}}</td>
                                        <td>{{$data->model_no}}</td>
                                        <td><input type="text" class="form-control" wire:model.defer="datas.{{$index}}.packing" name="packing"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="datas.{{$index}}.total_box" name="total_box"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="datas.{{$index}}.finish_goods" name="finish_goods"></td>
                                        <td><button class="btn btn-sm btn-outline-primary w-100" wire:click="save('{{$data->id}}', {{$index}})"><i class="fa fa-floppy-o" aria-hidden="true"></i></button></td>
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