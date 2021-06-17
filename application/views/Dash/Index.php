<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">

		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg col-6">
					<!-- small box -->
					<a href="<?= base_url('Laporan/LapPenjualan') ?>">
						<div class="small-box bg-info">
							<div class="inner">
								<h3><?= $ijmlhpnjualan ?></h3>
								<p>Penjualan Hari Ini</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
						</div>
					</a>
				</div>
				<!-- ./col -->
				<div class="col-lg col-6">
					<!-- small box -->
					<a href="<?= base_url('Laporan/LapMasaAktif'); ?>">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3><?= $ilimitexp ?></h3>
								<p>Barang Hampir Exp</p>
							</div>
							<div class="icon">
								<i class="ion ion-alert"></i>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg col-6">
					<!-- small box -->
					<a href="<?= base_url('Laporan/LapMasaAktif'); ?>">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3><?= $iexp ?></h3>
								<p>Barang Exp</p>
							</div>
							<div class="icon">
								<i class="ion ion-trash-a"></i>
							</div>
						</div>
					</a>
				</div>

				<div class="col-lg col-6">
					<!-- small box -->
					<a href="<?= base_url('Laporan/LapStok') ?>">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3><?= $ihampir ?></h3>
								<p>Limit Stok</p>
							</div>
							<div class="icon">
								<i class="ion ion-alert-circled"></i>
							</div>
						</div>
					</a>
				</div>
				<!-- ./col -->
				<div class="col-lg col-6">
					<!-- small box -->
					<a href="<?= base_url('Laporan/LapStok') ?>">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3><?= $ikosong ?></h3>
								<p>Stok Kosong</p>
							</div>
							<div class="icon">
								<i class="ion ion-trash-a"></i>
							</div>
						</div>
					</a>
				</div>
				<!-- ./col -->


			</div>
			<!-- /.row -->
			<!-- Main row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

</div>