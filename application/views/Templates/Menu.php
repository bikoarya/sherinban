<?php
$menu = $this->uri->segment(1);
$menu2 = $this->uri->segment(2);
$menu3 = $this->uri->segment(3);
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php print base_url('Dash'); ?>" class="brand-link">
		<!-- &nbsp;&nbsp;&nbsp;<i class="fas fa-wrench"></i> -->
		<img src="<?php print base_url('assets/'); ?>img/logosherin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">&nbsp;&nbsp;&nbsp; SHERIN BAN</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="info text-white text-uppercase">
				<?= $this->session->userdata('nama_lengkap'); ?>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?php print base_url('Dash'); ?>" class="nav-link <?php if ($menu == 'Dash' || $menu == 'dash') {
																					echo 'active';
																				} ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<?php if ($this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 1) { ?>
					<li class="nav-item has-treeview <?php if ($menu2 == 'Barang' || $menu2 == 'Satuan' || $menu2 == 'Kategori' || $menu2 == 'Supplier' || $menu2 == 'Pelanggan' || $menu2 == 'Mekanik' || $menu2 == 'Standart' || $menu2 == 'Jasa') {
															echo 'menu-open';
														} ?>">
						<a href="#" class="nav-link <?php if ($menu == 'Master') {
														echo 'active';
													} ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								Master
								<i class="fas fa-angle-left right"></i>
								<!-- <span class="badge badge-info right">6</span> -->
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item ">
								<a href="<?php print base_url('Master/Barang') ?>" class="nav-link <?php if ($menu2 == 'Barang') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Barang</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php print base_url('Master/Supplier') ?>" class="nav-link <?php if ($menu2 == 'Supplier') {
																											echo 'active';
																										} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Supplier</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php print base_url('Master/Pelanggan') ?>" class="nav-link <?php if ($menu2 == 'Pelanggan') {
																											echo 'active';
																										} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Pelanggan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php print base_url('Master/Mekanik') ?>" class="nav-link <?php if ($menu2 == 'Mekanik') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Mekanik</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php print base_url('Master/Satuan') ?>" class="nav-link <?php if ($menu2 == 'Satuan') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Satuan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php print base_url('Master/Kategori') ?>" class="nav-link <?php if ($menu2 == 'Kategori') {
																											echo 'active';
																										} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Kategori</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php print base_url('Master/Standart') ?>" class="nav-link <?php if ($menu2 == 'Standart') {
																											echo 'active';
																										} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Standart Ban</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php print base_url('Master/Jasa') ?>" class="nav-link <?php if ($menu2 == 'Jasa') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Jasa</p>
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<li class="nav-item has-treeview <?php if ($menu2 == 'Pembelian' || $menu3 == 'transaksi' || $menu2 == 'Penjualan' || $menu3 == 'listkasir') {
														echo 'menu-open';
													} ?>">
					<a href="#" class="nav-link  <?php if ($menu == 'Gudang' || $menu == 'Transaksi') {
														echo 'active';
													} ?>">
						<!-- <i class="nav-icon fas fa-chart-pie"></i> -->
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>
							Transaksi
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="<?php print base_url('Gudang/Pembelian') ?>" class="nav-link <?php if ($menu2 == 'Pembelian') {
																										echo 'active';
																									} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Pembelian</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php print base_url('Transaksi/Penjualan/transaksi') ?>" class="nav-link <?php if ($menu3 == 'transaksi' || $menu2 == 'Penjualan') {
																													echo 'active';
																												} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Penjualan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('Transaksi/Kasir/listkasir') ?>" class="nav-link <?php if ($menu3 == 'listkasir') {
																										echo 'active';
																									} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Cetak Nota</p>
							</a>
						</li>
					</ul>
				</li>


				<!-- <li class="nav-item has-treeview <?php if ($menu == 'returpembelian') {
															echo 'menu-open';
														} ?>">
					<a href="#" class="nav-link  <?php if ($menu == 'returpembelian') {
														echo 'active';
													} ?>">
						<i class="fas fa-undo-alt nav-icon"></i>
						<p>
							Retur Barang
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="<?php print base_url('returpembelian') ?>" class="nav-link <?php if ($menu == 'returpembelian') {
																									echo 'active';
																								} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Retur Pembelian</p>
							</a>
						</li>
					</ul>
				</li> -->

				<li class="nav-item has-treeview <?php if ($menu2 == 'LapPembelian' || $menu2 == 'LapPenjualan' || $menu2 == 'LapMasaAktif' || $menu2 == 'LapStok' || $menu2 == 'LapPembayaran') {
														echo 'menu-open';
													} ?>">
					<a href="#" class="nav-link  <?php if ($menu == 'Laporan') {
														echo 'active';
													} ?>">
						<!-- <i class="nav-icon fas fa-chart-pie"></i> -->
						<i class="fas fa-money-check-alt ml-1 mr-1"></i>
						<p>
							Laporan
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php print base_url('Laporan/LapPembelian') ?>" class="nav-link <?php if ($menu2 == 'LapPembelian') {
																											echo 'active';
																										} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Pembelian</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php print base_url('Laporan/LapPenjualan') ?>" class="nav-link <?php if ($menu2 == 'LapPenjualan') {
																											echo 'active';
																										} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Penjualan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php print base_url('Laporan/LapMasaAktif') ?>" class="nav-link <?php if ($menu2 == 'LapMasaAktif') {
																											echo 'active';
																										} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Masa Kadaluarsa</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php print base_url('Laporan/LapStok') ?>" class="nav-link <?php if ($menu2 == 'LapStok') {
																										echo 'active';
																									} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Stok</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php print base_url('Laporan/LapPembayaran') ?>" class="nav-link <?php if ($menu2 == 'LapPembayaran') {
																											echo 'active';
																										} ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Pembayaran</p>
							</a>
						</li>
					</ul>
				</li>
				<?php if ($this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 1) { ?>
					<li class="nav-item has-treeview <?php if ($menu == 'Auth' || $menu2 == 'Nota' || $menu2 == 'Cetak') {
															echo 'menu-open';
														} ?>">
						<a href="#" class="nav-link  <?php if ($menu == 'Auth' || $menu2 == 'Nota' || $menu2 == 'Cetak') {
															echo 'active';
														} ?>">
							<i class="fas fa-cog ml-1 mr-2"></i>
							<p>
								Pengaturan
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?php print base_url('Auth') ?>" class="nav-link <?php if ($menu == 'Auth') {
																								echo 'active';
																							} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Akun</p>
								</a>
							</li>
							<!-- <li class="nav-item">
								<a href="<?php print base_url('Setting/Nota') ?>" class="nav-link <?php if ($menu2 == 'Nota') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Nota</p>
								</a>
							</li> -->
							<!-- <li class="nav-item">
								<a href="<?php print base_url('Setting/Cetak') ?>" class="nav-link <?php if ($menu2 == 'Cetak') {
																										echo 'active';
																									} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Printer</p>
								</a>
							</li> -->
						</ul>
					</li>
				<?php } ?>
				<li class="nav-item">
					<a href="<?= base_url('keluar/sharin'); ?>" class="nav-link" data-toggle="modal" data-target="#Keluar">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Keluar
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- Modal -->

</aside>
<div class="modal fade" id="Keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Apakah Anda Yakin Ingin Keluar?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
				<a href="<?= base_url('Auth/Keluar'); ?>" type="button" class="btn btn-danger">Keluar</a>
			</div>
		</div>
	</div>
</div>