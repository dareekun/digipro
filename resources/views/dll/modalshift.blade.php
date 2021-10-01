<!-- Tambah Modal-->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/shift/ditambah" method="post">
        {{ csrf_field() }}
        <div class="row">
        <div class="col-sm-3">Shift</div>
        <div class="col-sm-9"><input required type="text" name="nama" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Posisi Shift</div>
        <div class="col-sm-9"><input required type="text" list="shiftlist" name="posisi" id="posisi" value="" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Start Shift</div>
        <div class="col-sm-9"><input required type="time" name="start" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">End Shift</div>
        <div class="col-sm-9"><input required type="time" name="finish" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Break Shift</div>
        <div class="col-sm-9"><input required type="number" name="break" id="break" value="" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan Shift</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Rubah Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rubah Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/shift/diedit" method="post">
        {{ csrf_field() }}
        <input required type="text" hidden name="idedit" id="idedit" value="" class="form-control">
        <div class="row">
        <div class="col-sm-3">Shift</div>
        <div class="col-sm-9"><input required type="text" name="shiftedit" id="shiftedit" value="" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Posisi Shift</div>
        <div class="col-sm-9"><select required type="text" list="shiftlist" name="posisiedit" id="posisiedit" value="" class="form-control">
        <option value="Shift 1">Shift 1</option>
        <option value="Shift 2">Shift 2</option>
        <option value="Shift 3">Shift 3</option></select>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Start Shift</div>
        <div class="col-sm-9"><input required type="time" name="startedit" id="startedit" value="" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">End Shift</div>
        <div class="col-sm-9"><input required type="time" name="finishedit" id="finishedit" value="" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Break Shift</div>
        <div class="col-sm-9"><input required type="number" name="breakedit" id="breakedit" value="" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Rubah Shift</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Hapus Modal -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <form action="/shift/dihapus" method="post" hidden>
        {{ csrf_field() }}
        <div class="row">
        <div class="col-sm-3">Shift</div>
        <div class="col-sm-9"><input required type="id" name="idhapus" id="idhapus" value="" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus Shift</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>