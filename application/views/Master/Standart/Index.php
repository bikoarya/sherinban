 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Standart Ban</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Master</li>
 						<li class="breadcrumb-item active">Standart Ban</li>
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
 								<button type="button" class="btn btn-primary md-1" data-toggle="modal" data-target="#form-standart" id="standart-tambah"> <i class="fas fa-plus"></i>
 									Tambah
 								</button>
 								<div class="col-md-4" style="margin-left: 56%;">
 									<div class="input-group">
 										<input type="text" class="form-control" name="cari_key" id="cari_key" autocomplete="off" placeholder="Pencarian" />
 										<div class="input-group-append">
 											<span class="input-group-text"><i class="fas fa-search"></i></span>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 						<div id='viewstandart'>
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


 <div class="modal fade" id="form-standart">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="standart-title"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qstandarttambah">
 					<div class="card-body">
 						<div class="form-group">
 							<label>Nama Mobil</label>
 							<input type="text" name="nama_standart" id="nama_standart" autocomplete="off" class="form-control" placeholder="Nama Mobil">
 						</div>
 						<!-- <div class="form-group">
 							<label>Spesifikasi Standart</label>
 							<input type="text" name="ring_standart" id="ring_standart" autocomplete="off" class="form-control" placeholder="Spesifikasi Standart">
 						</div> -->
 						<div class="form-group">
 							<label>Ukuran Standart Ban Depan</label>
 							<input type="text" name="bandepan" id="bandepan" autocomplete="off" class="form-control" placeholder="Ban Depan">
 						</div>
 						<div class="form-group">
 							<label>Ukuran Standart Ban Belakang</label>
 							<input type="text" name="banbelakang" id="banbelakang" autocomplete="off" class="form-control" placeholder="Ban Belakang">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpanstandart">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-standartedit">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="standart-title">Ubah Data Standart Ban</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qstandartedit">
 					<div class="card-body">
 						<div class="form-group">
 							<input type="hidden" name="edtid_standart" id="edtid_standart" class="form-control">
 						</div>
 						<div class="form-group">
 							<label>Nama Mobil</label>
 							<input type="text" name="edtnama_standart" id="edtnama_standart" class="form-control" autocomplete="off" placeholder="Nama Mobil">
 						</div>
 						<!-- <div class="form-group">
 							<label>Spesifikasi Standart</label>
 							<input type="text" name="edtring_standart" id="edtring_standart" class="form-control" autocomplete="off" placeholder="Spesifikasi Standart">
 						</div> -->
 						<div class="form-group">
 							<label>Ukuran Standart Ban Depan</label>
 							<input type="text" name="edtbandepan" id="edtbandepan" autocomplete="off" class="form-control" placeholder="Ban Depan">
 						</div>
 						<div class="form-group">
 							<label>Ukuran Standart Ban Belakang</label>
 							<input type="text" name="edtbanbelakang" id="edtbanbelakang" autocomplete="off" class="form-control" placeholder="Ban Belakang">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahstandart">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->