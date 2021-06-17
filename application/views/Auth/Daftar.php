 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<!-- <h1>Barang</h1> -->
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Pengaturan</li>
 						<li class="breadcrumb-item active">Akun</li>
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
 					<div class="card-header">
 						<h3 class="card-title">Akun</h3>
 					</div>
 					<!-- /.card-header -->
 					<div class="card-body">
 						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal" id="btn-tambah"> <i class="fas fa-plus"></i>
 							Tambah Akun
 						</button>
 						<br><br>

 						<div class="col-md-2 float-right mt-4">
 							<div class="input-group">
 								<input type="text" class="form-control" name="cari_key" id="cari_key" placeholder="Pencarian" />
 								<div class="input-group-append">
 									<span class="input-group-text"><i class="fas fa-search"></i></span>
 								</div>
 							</div>
 						</div>
 						<div class="viewakun"></div>

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


 <div class="modal fade" id="form-modal">
 	<div class="modal-dialog modal-md">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title">Tambah Akun</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="form">
 					<div class="card-body">
 						<div class="form-group">
 							<label for="nama_barang">Nama Lengkap</label>
 							<input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukan Nama Lengkap">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Username</label>
 							<input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Password</label>
 							<input type="password" name="password1" class="form-control" id="password1" placeholder="Masukan Password">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Konfirmasi Password</label>
 							<input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password">
 						</div>
 						<div class="form-group">
 							<label for="level">Level</label>
 							<select class="form-control level" name="level" id="level" style="width: 100%;">
 								<option value=""></option>
 								<?php foreach ($level as $lev) : ?>
 									<option value="<?= $lev['id_level']; ?>"><?= $lev['nama_level']; ?></option>
 								<?php endforeach; ?>
 							</select>
 						</div>

 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpan">Simpan Data</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>

 <div class="modal fade" id="formEdit">
 	<div class="modal-dialog modal-md">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="judulEdit"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="editAkun">
 					<div class="card-body">
 						<input type="hidden" name="iduser" id="iduser">
 						<div class="form-group">
 							<label for="nama_barang">Nama Lengkap</label>
 							<input type="text" name="nm_lengkap" class="form-control" id="nm_lengkap" placeholder="Masukan Nama Lengkap">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Username</label>
 							<input type="text" name="usrnm" class="form-control" id="usrnm" placeholder="Masukan Username">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Password</label>
 							<input type="password" name="pass1" class="form-control" id="pass1" placeholder="Masukan Username">
 						</div>
 						<div class="form-group">
 							<label for="id_satuan">Konfirmasi Password</label>
 							<input type="password" name="pass2" class="form-control" id="pass2" placeholder="Masukan Username">
 						</div>
 						<div class="form-group">
 							<label for="id_level">Level</label>
 							<select class="form-control akun" name="level2" id="level2" style="width: 100%;">
 								<option value=""></option>
 								<?php foreach ($level as $lev) : ?>
 									<option value="<?= $lev['id_level']; ?>"><?= $lev['nama_level']; ?></option>
 								<?php endforeach; ?>
 							</select>
 						</div>

 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahakun">Simpan Data</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>