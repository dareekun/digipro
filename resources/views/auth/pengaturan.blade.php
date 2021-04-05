@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Daftar Pengguna</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <small @if ($error=="Akun Berhasil Di Hapus" || $error=="Password Berhasil Dirubah") style="color:#7bc043" @else style="color:#fe4a49"
                            @endif class="form-text"><strong>{{$error}}</strong></small>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-7" align="right">
                        <a href="/admin/tambahakun" style="text-decoration:none" class="btn-sm btn-info" role="button"
                            aria-pressed="true">Tambah Pengguna</a>
                    </div>
                </div>
                <br>

                <table id="test" class="table table-striped table-bordered test">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Rubah Password</th>
                            <th>Hapus Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->role }}</td>
                            @can('isAdmin')
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#pass{{ $d->name }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confrim{{ $d->name }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>

                            </td>
                            @elsecan('isUser')
                            <td><a href="change/{{$d->id}}" class="btn btn-sm btn-info disabled"><i class="fa fa-pencil"
                                        aria-hidden="true"></i></a></td>
                            <td><a href="delaku/{{$d->id}}" class="btn btn-sm btn-danger disabled"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a></td>
                            @endcan

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal 1-->
@foreach ($data as $d)
<div class="modal fade" id="confrim{{ $d->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalText">
                Apakah Anda Yakin ingin menghapus Akun <br>
                {{ $d->name }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal"
                    data-target="#reconfrim{{ $d->name }}">Ya</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="reconfrim{{ $d->name }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalText">
                <form action="delaku" method="post">
                    {{ csrf_field() }}
                    Konfirmasi Kredensial Anda <br>
                    <input type="text" name="data0" hidden value="{{ $d->name }}">
                    <table>
                        <tr>
                            <td>Password</td>
                            <td>Konfirmasi Password</td>
                        </tr>
                        <tr>
                            <td><input type="password" required name="password"></td>
                            <td><input type="password" required name="password_confirmation"></td>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal 3 -->
<div class="modal fade" id="pass{{ $d->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Rubah Password Akun {{ $d->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalText">
                <form action="changep" method="post">
                    {{ csrf_field() }}
                    <br>
                    <input type="text" name="data0" hidden value="{{ $d->name }}">
                    <table>
                        <tr>
                            <td>Password Baru</td>
                            <td>Konfirmasi Password Baru</td>
                        </tr>
                        <tr>
                            <td><input type="password" required name="password"></td>
                            <td><input type="password" required name="password_confirmation"></td>
                        </tr>
                        <tr>
                        <td><br></td><td></td>
                        </tr>
                        <tr>
                            <td colspan="2">Konfirmasi Kredensial <br>
                            <input type="password" required name="pass">
                            </td>
                            </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection