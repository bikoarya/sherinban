 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Satuan</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Master</li>
 						<li class="breadcrumb-item active">Satuan</li>
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
 								<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#form-satuan" id="satuan-tambah"> <i class="fas fa-plus"></i>
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
 						<div class="tmplSatuan">

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


 <div class="modal fade" id="form-satuan" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="satuan-title"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qsatuantambah">
 					<div class="card-body">
 						<div class="form-group">
 							<label for="nama_satuan">Nama Satuan</label>
 							<input type="text" name="nama_satuan" id="nama_satuan" class="form-control" autocomplete="off" placeholder="Nama Satuan" autofocus>
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpansatuan">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-satuanedit" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="satuan-title">Ubah Data Satuan</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qsatuanedit">
 					<div class="card-body">
 						<div class="form-group">
 							<input type="hidden" name="edtid_satuan" id="edtid_satuan" class="form-control">
 						</div>
 						<div class="form-group">
 							<label for="nama_satuan">Nama Satuan</label>
 							<input type="text" name="edtnama_satuan" id="edtnama_satuan" class="form-control" autocomplete="off" placeholder="Nama Satuan" autofocus>
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahsatauan">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->