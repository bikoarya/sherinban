<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sherin | Masuk</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/Templates/') ?>plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url('assets/Templates/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/Templates/') ?>dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="jumbotron">
			<div class="login-box mx-auto">
				<div class="card">
					<div class="card-body login-card-body">
						<h2 class="login-box-msg mb-3" style="font-weight: lighter;">Masuk</h2>
						<form action="<?= base_url('Auth/Login') ?>" method="post">
							<?= $this->session->flashdata('message'); ?>
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
							<div class="input-group mb-3">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
							<?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
							<div class="button">
								<button type="submit" class="btn btn-primary btn-block mt-5">Masuk</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="<?= base_url('assets/Templates/') ?>plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="<?= base_url('assets/Templates/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url('assets/Templates/') ?>dist/js/adminlte.min.js"></script>

</body>

</html>