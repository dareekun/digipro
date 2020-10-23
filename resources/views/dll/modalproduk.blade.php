<!-- Tambah Modal-->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/produk/ditambah" method="post">
        {{ csrf_field() }}

        <div class="row">
        <div class="col-sm-3">Bagian</div>
        <div class="col-sm-9"><input required type="text" name="tag1" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Line</div>
        <div class="col-sm-9"><input required type="text" name="tag2" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Tipe Produk</div>
        <div class="col-sm-9"><input required type="text" name="tag3" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Qty Inner Produk</div>
        <div class="col-sm-9"><input required type="number" min="1" name="tag4" class="form-control"></div>
        </div>
        <br>
        <div class="row">
        <div class="col-sm-3">Qty Outer Produk</div>
        <div class="col-sm-9"><input required type="number" min="1" name="tag5" class="form-control"></div>
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

<!-- Hapus Modal -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda Yakin Ingin Menghapus Data?</p>
        <form action="/produk/dihapus" method="post" hidden>
        {{ csrf_field() }}
        <div class="row">
        <div class="col-sm-3">Shift</div>
        <div class="col-sm-9"><input required type="id" name="idhapus" id="idhapus" value="" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus Produk</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>