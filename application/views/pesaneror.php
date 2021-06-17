<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/Templates/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/Templates/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini" style="margin-top: 250px">

  <div class="jumbotron my-auto">
    <section class="content mx-auto">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning mt-3"></i> Oops! Halaman tidak ditemukan.</h3>

          <p>
            Kami tidak dapat menemukan halaman yang anda cari. Silahkan cari halaman yang sesuai.
          </p>


        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>

  <!-- jQuery -->
  <script src="<?= base_url('assets/Templates/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/Templates/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/Templates/') ?>dist/js/adminlte.min.js"></script>
</body>

</html>