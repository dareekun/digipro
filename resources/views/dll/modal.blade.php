 <!-- Modal Error -->
 <div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target="#myModal2"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Lot Card -->
    <div id="modallot1" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title">Lot Card Belum Selesai</h5>
        <button type="button" class="close" data-dismiss="modal" data-toggle="modal"
                    data-target="#modallot2" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <div class="modal-body">
                    <p>Terdapat Lot Card yang Belum selesai? <br><br>
                    Apakah Anda ingin melanjutkan?
                    </p>
                </div>
                <div class="modal-footer">
                <a name="lanjut" href="/lotsp/{{$tagkey}}" class="btn btn-success" role="button" aria-pressed="true">Ya</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal"
                    data-target="#modallot2">Tidak</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal 2 -->
    <div id="modallot2" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" data-toggle="modal"
                    data-target="#myModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <div class="modal-body">
                    <p>Data Akan Dihapus, apakah anda yakin?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"
                    data-target="#modallot1">Tidak</button>
                    <a name="hapus" href="/lotsphps/{{$tagkey}}" class="btn btn-danger" role="button" aria-pressed="true">Ya</a>
                </div>
            </div>
        </div>
    </div>