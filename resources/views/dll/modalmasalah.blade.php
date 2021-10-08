<!-- Tambah Modal-->
<div class="modal fade" id="tambahmasalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/masalah/ditambah" method="post">
        {{ csrf_field() }}

        <div class="row">
        <div class="col-sm-3">Jenis Masalah</div>
        <div class="col-sm-9"><input type="text" class="form-control" name="type" id="jenisbakallock" list="problemtype"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Masalah</div>
        <div class="col-sm-9"><input required type="text" name="masalah" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Remark</div>
        <div class="col-sm-9"><input required type="text" name="remark" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan Masalah</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Rubah Modal -->
<div class="modal fade" id="rubahmasalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rubah Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/masalah/dirubah" method="post">
        {{ csrf_field() }}
        <input required type="text" hidden name="paramedit0" id="edit00" class="form-control">
        <div class="row">
        <div class="col-sm-3">Jenis Masalah</div>
        <div class="col-sm-9">
        <input type="text" class="form-control" name="paramedit1" id="edit01" list="problemtype"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Masalah</div>
        <div class="col-sm-9"><input required type="text" name="paramedit2" id="edit02" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Remark</div>
        <div class="col-sm-9"><input required type="text" name="paramedit3" id="edit03" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Rubah Masalah</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Hapus Modal -->
<div class="modal fade" id="hapusmasalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <form action="/masalah/dihapus" method="post" hidden>
        {{ csrf_field() }}
        <div class="row">
        <div class="col-sm-9"><input required type="id" name="param2" id="idhapus" value="" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus Masalah</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>