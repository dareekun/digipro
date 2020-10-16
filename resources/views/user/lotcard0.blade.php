@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lot Card</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h3>Please Select Line First</h3>
                            </div>
                            <div class="col-md-8" align="right">
                            </div>
                        </div>
                        <form action="/lotcardalpha" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-3">
                        <select required class="form-control" name="tempat" id="tempat">
                        <option value=""></option>
                        @foreach ($data as $d)
                            <option value="{{$d->tempat}}">{{$d->tempat}}</option>
                        @endforeach
                        </select>
                        </div>
                        <div class="col-md-2">
                        <button type="submit" class="form-control">Submit</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection