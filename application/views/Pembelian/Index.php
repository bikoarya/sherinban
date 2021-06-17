 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h4>
 						Pembelian
 					</h4>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item active">Pembelian</li>
 					</ol>
 				</div>
 			</div>
 		</div><!-- /.container-fluid -->
 	</section>
 	<div class="flash-berhasil" data-berhasil="<?= $this->session->flashdata('berhasil'); ?>"></div>
 	<div class="flash-gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
 	<section class="content">
 		<div class="row">
 			<div class="col-12">
 				<div class="card">
 					<form role="form" id="pembelianvalid">
 						<div class="card-body mt-1">
 							<div class="form-group">
 								<div class="input-group">
 									<div class="col-md-4">
 										<div class="form-group">
 											<label>No Faktur</label>
 											<input type="txtno_faktur" class="form-control w-50 " id="txtno_faktur" name="txtno_faktur" placeholder="No Faktur" autocomplete="off" value="<?= $this->session->userdata('txtno_faktur'); ?>">
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="form-group">
 											<label>Tanggal</label>
 											<input type="text" class="form-control w-50 " id="txttgl_pembelian" name="txttgl_pembelian" placeholder="Tanggal Pembelian" value="<?= $this->session->userdata('txttgl_pembelian') ?>" autocomplete="off">
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="form-group">
 											<label>Supplier</label>
 											<select class="sup form-control supplierselect" name="kode_supplier" id="kode_supplier" style="width: 100%;" data-link="<?= base_url('Gudang/Pembelian/supplierdata') ?>">
 											</select>
 										</div>
 									</div>
 								</div>
 							</div>


 							<div class="form-group">
 								<div class="input-group">
 									<div class="col-md-3">
 										<div class="form-group">
 											<label>Kode Barang</label>
 											<div class="input-group">
 												<input type="text" class="form-control input-upper" name="txtkode_barang" id="txtkode_barang" autocomplete="off" placeholder="Kode Barang">
 												<span class="input-group-append">
 													<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Cari</button>
 												</span>
 											</div>
 										</div>
 									</div>
 									<div class="col-md-2">
 										<div class="form-group">
 											<label>Nama Barang</label>
 											<input type="text" class="form-control" id="txtnama_barang" name="txtnama_barang" placeholder="Nama Barang">
 										</div>
 									</div>
 									<div class="col-md-2">
 										<div class="form-group">
 											<label>Harga Beli</label>
 											<input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli">
 										</div>
 									</div>
 									<div class="col-md-2">
 										<div class="form-group">
 											<label>Harga Jual</label>
 											<input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual">
 										</div>
 									</div>
 									<div class="col-md-2 hidde">
 										<div class="form-group">
 											<label>Kode Produksi</label>
 											<input type="text" class="form-control" id="txtkode_produksi" min="0" minlength="4" maxlength="4" autocomplete="off" name="txtkode_produksi" placeholder="Kode Produksi">
 										</div>
 									</div>
 									<div class="col-md-2 hidde">
 										<div class="form-group">
 											<label>Masa Aktif</label>
 											<select class="form-control select2 masa" id="txtmasa_aktif" name="txtmasa_aktif" style="width: 100%;">
 												<option></option>
 												<option value="1">1 tahun</option>
 												<option value="2">2 tahun</option>
 												<option value="3">3 tahun</option>
 												<option value="4">4 tahun</option>
 												<option value="5">5 tahun</option>
 												<option value="6">6 tahun</option>
 												<option value="7">7 tahun</option>
 												<option value="8">8 tahun</option>
 												<option value="9">9 tahun</option>
 												<option value="10">10 tahun</option>
 											</select>
 										</div>
 									</div>
 									<div class="col-md-2">
 										<div class="form-group">
 											<label>Qty</label>
 											<input type="number" class="form-control" id="txtqty" name="txtqty" autocomplete="off" placeholder="Qty" autocomplete="off">
 										</div>
 									</div>
 									<div class="col-md-1 mt-3">
 										<div class="form-group">
 											<button type="submit" id="tambahcart" class="btn btn-primary form-control mt-3"><i class="fas fa-cart-plus"></i></button>
 										</div>
 									</div>

 									<input type="hidden" class="form-control" id="satuan" name="satuan" placeholder="satuan">
 									<input type="hidden" class="form-control" id="katagori" name="katagori" placeholder="katagori">
 								</div>
 							</div>


 						</div>
 					</form>

 					<div class="card-body">
 						<table id="transpembelian" class="table display" style="width:100%" data-link="<?= base_url('Gudang/Pembelian/cartvbrg') ?>">
 							<thead>
 								<tr>
 									<th>Kode Barang</th>
 									<th>Nama Barang</th>
 									<th>Satuan</th>
 									<th>Kategori</th>
 									<th>Spesifikasi</th>
 									<th>Harga Jual</th>
 									<th>Harga Beli</th>
 									<th>Kode Produksi</th>
 									<th>Masa Aktif (Th)</th>
 									<th>Qty</th>
 									<th>Total</th>
 									<th>Aksi</th>
 								</tr>
 							</thead>
 							<tbody>
 							</tbody>
 						</table>
 						<a href="<?= base_url('Gudang/Pembelian/simpan_pembelian'); ?>" class="btn btn-primary mx-auto mb-5 mt-3" id='simpan_data'>Simpan</a>
 					</div>

 				</div>
 			</div>
 		</div>
 	</section>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- /.card-header -->
 				<div class="col-md-4 float-right mt-1 mb-3">
 					<div class="input-group">
 						<input type="text" class="form-control" name="cari_key" id="cari_key" autocomplete="off" placeholder="Pencarian" />
 						<div class="input-group-append">
 							<span class="input-group-text"><i class="fas fa-search"></i></span>
 						</div>
 					</div>
 				</div>
 				<div id="vvcribrng"></div>
 				<!-- /.card-body -->
 			</div>
 		</div>
 	</div>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- /.card-header -->
 				<table id="example1" class="table table-bordered table-striped">
 					<thead>
 						<tr>
 							<th>No</th>
 							<th>Kode Barang</th>
 							<th>Nama Barang</th>
 							<th>Satuan</th>
 							<th>Kategori</th>
 							<th>Spesifikasi</th>
 							<th>Harga Beli</th>
 							<th>Harga Jual</th>
 							<th>Aksi</th>

 						</tr>
 					</thead>
 					<tbody>
 					</tbody>
 				</table>

 				<!-- /.card-body -->
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="supplier" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="suppliervalid">
 					<div class="form-group">
 						<label>Nama Supplier</label>
 						<input type="text" class="form-control" id="nama_supplier" name="nama_supplier" autocomplete="off" placeholder="Masukan Nama Supplier">
 					</div>
 					<div class="form-group">
 						<label>Alamat Supplier</label>
 						<input type="text" class="form-control" id="alamat_sup" name="alamat_sup" autocomplete="off" placeholder="Masukan Alamat Supplier">
 					</div>
 					<div class="form-group">
 						<label>Nomor Telepon</label>
 						<input type="text" class="form-control" id="telpon_sup" name="telpon_sup" autocomplete="off" placeholder="Masukan Nomor Telepon">
 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-secondary" id="supdata" data-dismiss="modal">Close</button>
 						<button type="submit" class="btn btn-primary" id="simpan_sup">Simpan Data</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>