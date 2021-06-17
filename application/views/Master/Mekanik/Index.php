 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Mekanik</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Master</li>
 						<li class="breadcrumb-item active">Mekanik</li>
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
 								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-mekanik" id="mekanik-tambah"> <i class="fas fa-plus"></i>
 									Tambah
 								</button>
 							</div>
 						</div>

 						<div class="table-responsive">
 							<table class="datatable2 table table-bordered table-striped" data-link="<?= base_url('Master/Mekanik/vmekanik') ?>" width="100%">
 								<thead>
 									<tr>
 										<th>No</th>
 										<th>Kode Mekanik</th>
 										<th>Nama Mekanik</th>
 										<th>Jabatan</th>
 										<th>Aksi</th>
 									</tr>
 								</thead>
 								<tbody></tbody>
 							</table>
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


 <div class="modal fade" id="form-mekanik" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="mekanik-title"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qmekaniktambah">
 					<div class="card-body">
 						<div class="form-group">
 							<label>Nama mekanik</label>
 							<input type="text" name="nama_mekanikk" id="nama_mekanikk" class="form-control" autocomplete="off" placeholder="Nama Mekanik" autofocus>
 						</div>
 						<div class="form-group">
 							<label>Jabatan</label>
 							<input type="text" name="jabatan_mekanik" id="jabatan_mekanik" class="form-control" autocomplete="off" placeholder="Jabatan">
 						</div>

 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpanmekanik">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-mekanikedit" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="mekanik-title">Ubah Data mekanik</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qmekanikedit">
 					<div class="card-body">
 						<div class="form-group">
 							<input type="hidden" name="edtkode_mekanik" id="edtkode_mekanik" class="form-control">
 						</div>
 						<div class="form-group">
 							<label>Nama mekanik</label>
 							<input type="text" name="edtnama_mekanik" id="edtnama_mekanik" class="form-control" autocomplete="off" placeholder="Nama Mekanik">
 						</div>
 						<div class="form-group">
 							<label>Jabatan</label>
 							<input type="text" name="edtjabatan_mekanik" id="edtjabatan_mekanik" autocomplete="off" class="form-control" placeholder="Jabatan">
 						</div>

 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahmekanik">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->