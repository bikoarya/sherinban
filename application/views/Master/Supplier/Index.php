 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Supplier</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
 						<li class="breadcrumb-item">Master</li>
 						<li class="breadcrumb-item active">Supplier</li>
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
 								<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#form-supplier" id="supplier-tambah"> <i class="fas fa-plus"></i>
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

 						<div class="tmplsupplier">
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


 <div class="modal fade" id="form-supplier" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="supplier-title"></h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qsuppliertambah">
 					<div class="card-body">
 						<div class="form-group">
 							<label>Nama Supplier</label>
 							<input type="text" name="nama_supplier" id="nama_supplier" class="form-control" autocomplete="off" placeholder="Nama Supplier">
 						</div>
 						<div class="form-group">
 							<label>Alamat</label>
 							<input type="text" name="alamat_sup" id="alamat_sup" class="form-control" autocomplete="off" placeholder="Alamat">
 						</div>
 						<div class="form-group">
 							<label>Telpon</label>
 							<input type="text" name="telpon_sup" id="telpon_sup" class="form-control" autocomplete="off" placeholder="Telepon">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="simpansupplier">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-supplieredit" data-keyboard="false" data-backdrop="static">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title" id="supplier-title">Ubah Data Supplier</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" id="qsupplieredit">
 					<div class="card-body">
 						<div class="form-group">
 							<input type="hidden" name="edtkode_supplier" id="edtkode_supplier" class="form-control">
 						</div>
 						<div class="form-group">
 							<label>Nama Supplier</label>
 							<input type="text" name="edtnama_supplier" id="edtnama_supplier" class="form-control" autocomplete="off" placeholder="Nama Supplier">
 						</div>
 						<div class="form-group">
 							<label>Alamat</label>
 							<input type="text" name="edtalamat_supplier" id="edtalamat_supplier" class="form-control" autocomplete="off" placeholder="Alamat">
 						</div>
 						<div class="form-group">
 							<label>Telpon</label>
 							<input type="text" name="edttlp_supplier" id="edttlp_supplier" autocomplete="off" class="form-control" placeholder="Telpon">
 						</div>
 					</div>
 			</div>
 			<div class="modal-footer justify-content-between tombol">
 				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary" id="ubahsupplier">Simpan</button>
 			</div>
 			</form>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->