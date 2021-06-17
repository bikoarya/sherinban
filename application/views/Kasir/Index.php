 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h4>
 						Cetak Nota
 					</h4>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item active">Cetak Nota</li>
 					</ol>
 				</div>
 			</div>
 		</div><!-- /.container-fluid -->
 	</section>
 	<div class="flash-berhasil" data-berhasil="<?= $this->session->flashdata('berhasil'); ?>"></div>
 	<div class="flash-gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
 	<section class="content">
 		<div class="col-12">
 			<div class="card">
 				<form role="form" id="kasir">
 					<div class="card-body mt-2">
 						<div class="form-group">
 							<div class="input-group">
 								<div class="form-group">
 									<label for="nonota">No Nota</label>
 									<input type="text" class="form-control w-75" id="no_nota" name="no_nota" placeholder="No Nota" value="<?= $this->session->userdata('no_nota'); ?>" readonly>
 									<input type="hidden" name="kode_pelanggan" id="kode_pelanggan">
 								</div>

 								<div class="form-group">
 									<label for="tanggal">Tanggal</label>
 									<input type="text" class="form-control w-75" id="tanggal" name="tanggal" placeholder="Tanggal" value="<?= $this->session->userdata('tanggal'); ?>" readonly>
 								</div>

 								<div class="form-group">
 									<label for="namapelanggan">Nama Pelanggan</label>
 									<input type="text" class="form-control w-75" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan" value="<?= $this->session->userdata('nama_pelanggan'); ?>" readonly>
 								</div>

 								<div class="form-group">
 									<label for="namamekanik">Nama Mekanik</label>
 									<input type="text" class="form-control w-75" id="nama_mekanik" name="nama_mekanik" placeholder="Nama Mekanik" value="<?= $this->session->userdata('nama_mekanik'); ?>" readonly>
 								</div>

 								<div class="form-group" style="margin-top: 33px;">
 									<button type="button" class="btn btn-info cripnjualan" data-toggle="modal" data-target="#cariPenjualan">Cari Penjualan &nbsp;<i class="fas fa-search"></i></button>
 								</div>
 							</div>
 						</div>
 					</div>

 					<div class="card-body">
 						<div class="table-responsave">
 							<div class="real">
 								<table class="table table-bordered table-striped">
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Nama Barang</th>
 											<th>Satuan</th>
 											<th>Kategori</th>
 											<th>Qty</th>
 											<th>Harga</th>
 											<th>Pot</th>
 											<th>Total</th>
 											<th>Status</th>
 										</tr>
 									</thead>
 									<tbody id="cartKasir">
 									</tbody>
 								</table>
 							</div>
 						</div>
 					</div>


 					<div class="float-right">
 						<div class="card-body">
 							<div class="form-group row">
 								<label for="total_pembayaran" style="font-size: 20px" class="col-sm-4 col-form-label text-right">Total </label>
 								<div class="col-sm-8">
 									<div id="total_pembayaran"></div>
 								</div>
 							</div>

 							<div class="form-group row">
 								<!-- <label for="total_tunai" style="font-size: 20px" class=" col-sm-4 col-form-label text-right">Bayar</label>
 								<div class="col-sm-8">
 									<input style="height: 50px; font-size:20px;font-weight: bold;" type="text" class="form-control" name="total_tunai" id="total_tunai" placeholder="Total Tunai" autocomplete="off">
 								</div> -->
 								<div id="ttlbyr">
 								</div>
 							</div>

 							<!-- <div class="form-group row">
 								<label for="kembalian" style="font-size: 20px" class="col-sm-4 col-form-label text-right">Kembali</label>

 								<div class="col-sm-8">
 									<input type="text" style="height: 50px; font-size:20px;font-weight: bold;" class="form-control" name="kembalian" id="kembalian" placeholder="Kembalian" readonly>
 								</div>

 								<input type="hidden" style="height: 50px; font-size:20px;font-weight: bold;" class="form-control" name="kembalian2" id="kembalian2" placeholder="Kembalian2" readonly>
 							</div> -->

 							<div class="float-right">
 								<button type="button" class="btn btn-primary " style="font-size: 20px; width: 110px;height: 50px" id="byrr">Cetak</button>
 							</div>

 						</div>
 					</div>
 					<div class="float-left">
 						<div class="card-body" style="margin-top: 82px;">
 							<a href="<?= base_url('Transaksi/Kasir/listkasir'); ?>" class="btn btn-danger " style="font-size: 20px; width: 110px;height: 50px">Batal</a>
 						</div>
 					</div>


 				</form>

 			</div>
 		</div>
 	</section>
 </div>


 <!-- Modal Cari Penjualan -->
 <div class="modal fade" id="cariPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Cari Penjualan</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- /.card-header -->
 				<table id="cariPenjualan2" class="table table-bordered table-striped">
 					<thead>
 						<tr>
 							<th>No</th>
 							<th>No Nota</th>
 							<th>Tanggal</th>
 							<th>Nama Pelanggan</th>
 							<th>Nama Mekanik</th>
 							<th>No Polisi</th>
 							<th>Aksi</th>
 						</tr>
 					</thead>
 					<tbody id="cariKasir">
 					</tbody>
 				</table>
 				<!-- /.card-body -->
 			</div>
 		</div>
 	</div>
 </div>

 <div class="modal fade" id="cariJasa1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Cari Jasa</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- /.card-header -->
 				<table id="cariPenjualan2" class="table table-bordered table-striped">
 					<thead>
 						<tr>
 							<th>No</th>
 							<th>Nama Jasa</th>
 							<th>Harga Jasa</th>
 							<th>Aksi</th>
 						</tr>
 					</thead>
 					<tbody id="cariJasa">
 					</tbody>
 				</table>
 				<!-- /.card-body -->
 			</div>
 		</div>
 	</div>
 </div>