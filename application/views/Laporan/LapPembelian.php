 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Laporan Pembelian</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Home</a></li>
 						<li class="breadcrumb-item">Laporan</li>
 						<li class="breadcrumb-item active">Pembelian</li>
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
 						<form action="<?= base_url('Laporan/LapPembelian/CetakPembelian'); ?>" method="POST">

 							<div class="form-group">
 								<div class="input-group">
 									<label style="margin-top: 7px;">Tanggal :</label>
 									<span class="input-group-text" style="margin-left: 10px">
 										<i class="far fa-calendar-alt"></i>
 									</span>
 									<div>
 										<input type="text" class="form-control float-right tgllap" autocomplete="off" name="tglPem" id="reservation" readonly><br>
 									</div>
 									<label class="mt-1 ml-4"> Pencarian :</label>
 									<div style="margin-left: 10px">
 										<select name="keys" id="pilih" class="form-control kategori" data-place="Cari Berdasarkan" style="width: 100%;">
 											<option value=""></option>
 											<option value="no_faktur">No Faktur</option>
 											<option value="nama_barang">Nama Barang</option>
 											<option value="nama_satuan">Satuan</option>
 											<option value="nama_katagori">Kategori</option>
 											<option value="spek">Spesifikasi</option>
 										</select>
 									</div>
 									<div>
 										<input type="text" class="form-control ml-2 input-group-text" name="textpencarian" id="textpencarian" autofocus="" placeholder="Cari. . ." autocomplete="off">
 									</div>
 									<button id="caridata" type="button" class="btn btn-primary ml-3">Cari<i class="fas fa-search ml-2"></i></button>
 								</div>
 							</div>

 							<div class="table-responsive">
 								<table id="laporan" class="laporantable table table-bordered" data-link="<?= base_url('Laporan/LapPembelian/vlappembelian'); ?>" data-total="9">
 									<thead>
 										<tr>
 											<th class="text-center">Tanggal</th>
 											<th class="text-center">No Faktur</th>
 											<th class="text-center">Nama Barang</th>
 											<th class="text-center">Satuan</th>
 											<th class="text-center">Kategori</th>
 											<th class="text-center">Spesifikasi</th>
 											<th class="text-center">Kode Produksi</th>
 											<th class="text-center">Jumlah</th>
 											<th class="text-center">Harga Beli</th>
 											<th class="text-center">Sub Total</th>
 										</tr>
 									</thead>
 									<tbody></tbody>
 									<tfoot>
 										<tr>
 											<th colspan="9" class="text-center">Total</th>
 											<th class="text-right"></th>
 										</tr>
 									</tfoot>
 								</table>
 							</div>

 							<div class="text-left">
 								<button type="submit" class="btn btn-primary" style="position: relative;">Cetak</button>
 							</div>
 							<!-- </div> -->
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 </div>