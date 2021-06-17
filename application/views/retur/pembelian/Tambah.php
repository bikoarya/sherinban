<form id="form" role="form">
    <div class="card-body">
        <div class="form-group">
            <label for="no_faktur">No Faktur</label>
            <input type="text" name="no_faktur" class="form-control" title="Nama Harus Diisi" id="tambah-nofaktur" autocomplete="off" placeholder="No Faktur">
            <div id="error"></div>
        </div>

        <div class="form-group">
            <label for="tanggal_retur">Tanggal Retur</label>
            <input type="date" name="tanggal_retur" class="form-control" id="tambah-tanggalretur" autocomplete="off" placeholder="Tanggal Retur">
            <div id="error"></div>
        </div>

        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" id="tambah-kodebarang" autocomplete="off" placeholder="Kode Barang">
            <div id="error"></div>
        </div>

        <div class="form-group">
            <label for="jumlah_retur">Jumlah Retur</label>
            <input type="number" name="jumlah_retur" class="form-control" id="tambah-jumlahretur" autocomplete="off" min="0" placeholder="Jumlah Retur">
            <div id="error"></div>
        </div>

        <div class="form-group">
            <label for="harga_retur">Harga Barang Retur</label>
            <input type="text" name="harga_retur" class="form-control" id="tambah-hargaretur" autocomplete="off" placeholder="Harga Barang Retur">
            <div id="error"></div>
        </div>

        <div class="form-group">
            <label for="ket_retur">Keterangan Retur</label>
            <textarea name="ket_retur" class="form-control" id="tambah-ketretur" placeholder="Keterangan Retur"></textarea>
            <div id="error"></div>
        </div>

    </div>
    <div class="modal-footer justify-content-between tombol">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary simpan" data-link="' . base_url(" returpembelian/store") . '"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
    </div>
</form>