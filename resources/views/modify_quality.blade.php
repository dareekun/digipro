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
                        <div class="col-md-12">
                            Modify Data Inspection Check Sheet
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('modify_inspection')}}" method="post">
                        @csrf
                        @foreach ($data as $dt)
                        <input type="text" name="barcode_id" hidden value="{{$dt->barcode}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row my-2">
                                    <div class="col-md-3">Product Name</div>
                                    <div class="col-md-9"><input type="text" disabled class="form-control" value="{{$dt->model_no}}"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">Lot Number</div>
                                    <div class="col-md-9"><input type="text" value="{{$dt->lotno}}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">Shift</div>
                                    <div class="col-md-9"><input type="text" value="{{$dt->shift}}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">Section</div>
                                    <div class="col-md-9"><input type="text" value="{{$dt->section}}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row my-2">
                                    <div class="col-md-3">Line</div>
                                    <div class="col-md-9"><input type="text" value="{{$dt->line}}" disabled
                                            class="form-control"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">@ Box</div>
                                    <div class="col-md-9"><input type="number" required value="{{$dt->packing}}"
                                            name="packing_size" min="0" class="form-control"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">Total Box</div>
                                    <div class="col-md-9"><input type="number" required value="{{$dt->total_box}}"
                                            name="total_box" min="0" class="form-control"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">Lot Size</div>
                                    <div class="col-md-9"><input type="number" required value="{{$dt->lot_size}}"
                                            name="lot_size" min="0" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-12">
                                <input type="text" name="remark" value="{{$dt->remark}}" class="form-control" placeholder="Remark">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row my-2">
                                    <div class="col-md-3">Status</div>
                                    <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" @if ($dt->judgement == 1) checked @else @endif type="radio" required name="status" id="inlineRadio1"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio1">OK</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" @if ($dt->judgement == 2) checked @else @endif type="radio" required name="status" id="inlineRadio2"
                                                value="2">
                                            <label class="form-check-label" for="inlineRadio2">NG</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" @if ($dt->judgement == 3) checked @else @endif type="radio" required name="status" id="inlineRadio2"
                                                value="3">
                                            <label class="form-check-label" for="inlineRadio2">HOLD</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-success w-100" type="submit">Submit</button>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stop

    @push('scripts')
    @endpush