 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Pelanggan</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Master</li>
 						<li class="breadcrumb-item active">Pelanggan</li>
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
 					<!-- /.card-header -->
 					<div class="card-body">
 						<div class="form-group">
 							<div class="input-group">
 								<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#form-pelanggan" id="pelanggan-tambah"> <i class="fas fa-plus"></i>
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
 						<div id="vpelanggan">
 						</div>

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


 <div class="modal fade" id="form-pelanggan" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="pelanggan-title"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qpelanggantambah">
 					<div class="card-body">
 						<div class="form-group">
 							<label>Nama Pelanggan</label>
 							<input type="text" name="nama_pelanggann" id="nama_pelanggann" class="form-control" autocomplete="off" placeholder="Nama Pelanggan">
 						</div>
 						<div class="form-group">
 							<label>Alamat</label>
 							<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" placeholder="Alamat">
 						</div>
 						<div class="form-group">
 							<label>Telepon</label>
 							<input type="text" name="telepon" id="telepon" class="form-control" autocomplete="off" placeholder="Telepon">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpanpelanggan">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-pelangganedit" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="pelanggan-title">Ubah Data pelanggan</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qpelangganedit">
 					<div class="card-body">
 						<div class="form-group">
 							<input type="hidden" name="edtkode_pelanggan" id="edtkode_pelanggan" class="form-control">
 						</div>
 						<div class="form-group">
 							<label>Nama pelanggan</label>
 							<input type="text" name="edtnama_pelanggan" id="edtnama_pelanggan" class="form-control" autocomplete="off" placeholder="Nama pelanggan">
 						</div>
 						<div class="form-group">
 							<label>Alamat</label>
 							<input type="text" name="edtalamat_pelanggan" id="edtalamat_pelanggan" class="form-control" autocomplete="off" placeholder="Alamat">
 						</div>
 						<div class="form-group">
 							<label>Telepon</label>
 							<input type="text" name="edttelepon_pelanggan" id="edttelepon_pelanggan" class="form-control" autocomplete="off" placeholder="Telepon">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahpelanggan">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->