<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Barang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
						<li class="breadcrumb-item">Master</li>
						<li class="breadcrumb-item active">Barang</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<div class="input-group">

								<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#form-modal" id="btn-tambah"> <i class="fas fa-plus"></i>
									Tambah
								</button>

								<div class="col-md-4" style="margin-left: 56%;">
									<div class="input-group">
										<input type="text" class="form-control" name="cari_key" id="cari_key" placeholder="Pencarian" />
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-search"></i></span>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="tmpilbarang"></div>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="form-modal" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="quickForm">
					<div class="card-body">
						<div class="form-group">
							<label for="nama_barang">Nama Barang</label>
							<input type="text" name="nama_barang" class="form-control" id="nama_barang" autocomplete="off" placeholder="Nama Barang">
						</div>

						<div class="form-group">
							<label for="id_satuan">Satuan</label>
							<select name="id_satuan" id="id_satuan" class="form-control select2 selectdata" style="width: 100%;" data-link="<?= base_url('Master/Barang/selectdata') ?>"></select>
						</div>

						<div class="form-group slctktg">
							<label for="id_kategori">Kategori</label>
							<select name="id_kategori" id="id_kategori" class="form-control katagori ktgdata" style="width: 100%;">
							</select>
						</div>

						<div class="form-group">
							<label for="spek">Spesifikasi</label>
							<input type="text" name="spek" class="form-control" id="spek" autocomplete="off" placeholder="Spesifikasi">
						</div>
						<div class="form-group">
							<label for="harga_beli">Harga Beli</label>
							<input type="text" name="harga_beli" class="form-control" id="harga_beli" autocomplete="off" placeholder="Harga Beli">
						</div>
						<div class="form-group">
							<label for="harga_jual">Harga Jual</label>
							<input type="text" name="harga_jual" class="form-control" id="harga_jual" autocomplete="off" placeholder="Harga Jual">
						</div>
						<div class="form-group">
							<label for="qty1">Pot 1 <br> Min. Qty</label>
							<input type="text" name="qty1" class="form-control" id="qty1" autocomplete="off" placeholder="Qty">
						</div>
						<div class="form-group">
							<label for="pot1">Pot</label>
							<input type="text" name="pot1" class="form-control" id="pot1" autocomplete="off" placeholder="Pot">
						</div>
						<div class="form-group">
							<label for="qty2">Pot 2 <br> Min. Qty</label>
							<input type="text" name="qty2" class="form-control" id="qty2" autocomplete="off" placeholder="Qty">
						</div>
						<div class="form-group">
							<label for="pot2">Pot</label>
							<input type="text" name="pot2" class="form-control" id="pot2" autocomplete="off" placeholder="Pot">
						</div>
						<div class="form-group">
							<label for="stok_min">Stok Minimum</label>
							<input type="number" name="stok_min" min="1" class="form-control" id="stok_min" autocomplete="off" placeholder="Stok Minimum">
						</div>
						<div class="form-group clearfix">
							<div class="icheck-primary d-inline">
								<input type="checkbox" name="type_exp" id="checkboxPrimary2" value="1">
								<label for="checkboxPrimary2">
									Menggunakan Kode Produksi
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="aktif">Aktif</label>
							<select name="aktif" id="aktif" class="form-control aktif" style="width: 100%;">
								<option></option>
								<option value="Y">YA</option>
								<option value="N">TIDAK</option>
							</select>
						</div>

					</div>
			</div>
			<div class="modal-footer justify-content-between tombol">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="form-edit" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="edit-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="edit" id="qeditbarang">
					<div class="card-body">
						<div class="form-group">
							<input type="hidden" class="form-control" id="txtkode_barang">
						</div>
						<div class="form-group">
							<label for="nama_barang">Nama Barang</label>
							<input type="text" name="nama_barang" class="form-control" id="txtnama_barang" autocomplete="off" placeholder="Nama Barang">
						</div>
						<div class="form-group">
							<label for="id_satuan">Satuan</label>
							<select name="id_satuan" id="txtid_satuan" class="form-control select2" style="width: 100%;" data-link="<?= base_url('Master/Barang/selectdataedit') ?>"></select>
						</div>


						<div class="form-group slctktg">
							<label for="id_kategori">Kategori</label>
							<select name="id_kategori" id="txtid_kategori" class="form-control katagori ktgdata" style="width: 100%;">
							</select>
						</div>

						<div class="form-group">
							<label for="spek">Spesifikasi</label>
							<input type="text" name="spek" class="form-control" id="txtspek" autocomplete="off" placeholder="Spesifikasi">
						</div>
						<div class="form-group">
							<label for="harga_beli">Harga Beli</label>
							<input type="text" name="harga_beli" class="form-control" id="txtharga_beli" autocomplete="off" placeholder="Harga Beli">
						</div>
						<div class="form-group">
							<label for="harga_jual">Harga Jual</label>
							<input type="text" name="harga_jual" class="form-control" id="txtharga_jual" autocomplete="off" placeholder="Harga Jual">
						</div>
						<div class="form-group">
							<label for="qty1">Pot 1<br>Min. Qty</label>
							<input type="text" name="qty1" class="form-control" id="txtqty1" autocomplete="off" placeholder="Qty">
						</div>
						<div class="form-group">
							<label for="pot1">Pot</label>
							<input type="text" name="pot1" class="form-control" id="txtpot1" autocomplete="off" placeholder="Pot">
						</div>
						<div class="form-group">
							<label for="qty2">Pot 2 <br>Min. Qty</label>
							<input type="text" name="qty2" class="form-control" id="txtqty2" autocomplete="off" placeholder="Qty">
						</div>
						<div class="form-group">
							<label for="pot2">Pot</label>
							<input type="text" name="pot2" class="form-control" id="txtpot2" autocomplete="off" placeholder="Pot">
						</div>
						<div class="form-group">
							<label for="stok_min">Stok Minimum</label>
							<input type="number" name="stok_min" min="0" class="form-control" id="txtstok_min" autocomplete="off" placeholder="Stok Minimum">
						</div>
						<div class="form-group clearfix">
							<div class="icheck-primary d-inline">
								<input type="checkbox" name="type_exp" id="ceklis">
								<label for="ceklis">
									Menggunakan Kode Produksi
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="aktif">Aktif</label>
							<select name="aktif" id="txtaktif" class="form-control aktif" style="width: 100%;">
								<option></option>
								<option value="Y">YA</option>
								<option value="N">TIDAK</option>
							</select>
						</div>

					</div>
			</div>
			<div class="modal-footer justify-content-between tombol">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" id="editbarang">Simpan</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>



<!-- Modal Satuan -->
<div class="modal fade" id="satuan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Satuan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="satuanvalid">
					<div class="form-group">
						<label>Nama Satuan</label>
						<input type="text" class="form-control" id="nama_satuan" name="nama_satuan" autocomplete="off" placeholder="Masukan Nama Satuan">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="batalsatuan" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" id="simpan_satuan">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal Kategori -->
<div class="modal fade" id="kategori" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="kategorivalid">
					<div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" class="form-control" id="nama_katagori" name="nama_katagori" autocomplete="off" placeholder="Masukan Nama Kategori">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="batalkategori" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" id="simpan_kategori">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>