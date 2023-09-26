<div class="modal fade" id="modalFormProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="produk">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group row">
                        <label for="nama_pengajuan" class="col-sm-4 col-form-label">Nama Pengaju</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_pengajuan" value="" name="nama_pengajuan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_barang" value="" name="nama_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_pengajuan" class="col-sm-4 col-form-label">Tanggal Pengajuan</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_pengajuan" value="" name="tanggal_pengajuan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty" class="col-sm-4 col-form-label">Qty</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="qty" value="" name="qty">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="terpenuhi" class="col-sm-4 col-form-label">Terpenuhi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="terpenuhi" value="" name="terpenuhi">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>