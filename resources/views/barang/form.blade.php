<div class="modal fade" id="modalFormBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="barang">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group row">
                        <label for="kode_barang" class="col-sm-4 col-form-label">Kode Barang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode_barang" value="" name="kode_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_barang" value="" name="nama_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-4 col-form-label">Satuan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="satuan" value="" name="satuan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-sm-4 col-form-label">Harga Jual</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="harga_jual" value="" name="harga_jual">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-sm-4 col-form-label">Stok</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="stok" value="" name="stok">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ditarik" class="col-sm-4 col-form-label">Ditarik</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ditarik" value="" name="ditarik">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-4 col-form-label">User ID</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="user_id" id="user_id">
                                <option disabled selected>Pilih User</option>
                                @foreach($user as $u=>$label )
                                <option value="{{ $u }}">{{ $label }}</option>
                                @endForeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk_id" class="col-sm-4 col-form-label">Produk ID</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="produk_id" id="produk_id">
                                <option disabled selected>Pilih Produk</option>
                                @foreach($produk as $p=>$label )
                                <option value="{{ $p }}">{{ $label }}</option>
                                @endForeach
                            </select>
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