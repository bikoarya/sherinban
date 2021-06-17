<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="shortcut icon" href="<?= base_url('assets/img/logosherin.png') ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php print base_url('assets/'); ?>css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/jqvmap/jqvmap.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/toastr/toastr.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/daterangepicker/daterangepicker.css">
	<!-- <link rel="stylesheet" href="<?php print base_url('assets/'); ?>css/datepicker-bootstrap-4.min.css"> -->
	<!-- summernote -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/summernote/summernote-bs4.css">
	<!-- jquery-ui -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/jquery-ui/jquery-ui.min.css">
	<!-- Google Font: Source Sans Pro -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/'); ?>bootstrap-datepicker.min.css">


	<!-- Theme style -->
	<link rel="stylesheet" href="<?php print base_url('assets/Templates/'); ?>dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php print base_url('assets/css/'); ?>loading.css">
	<link rel="stylesheet" href="<?php print base_url('assets/css/'); ?>style.css">

	<script>
		var base_url = '<?php print base_url() ?>';
		var site_url = '<?php print site_url() ?>';
	</script>
	<style>
		.hidde {
			display: none;
		}

		table.scroll {
			width: 716px;
			/* 140px * 5 column + 16px scrollbar width */
			border-spacing: 0;
			border: 2px solid black;
		}

		table.scroll tbody,
		table.scroll thead tr {
			display: block;
		}

		table.scroll tbody {
			height: 100px;
			overflow-y: auto;
			overflow-x: hidden;
		}

		table.scroll tbody td,
		table.scroll thead th {
			width: 140px;
			border-right: 1px solid black;
		}

		table.scroll thead th:last-child {
			width: 156px;
			/* 140px + 16px scrollbar width */
		}

		thead tr th {
			height: 30px;
			line-height: 30px;
			/*text-align: left;*/
		}

		tbody {
			border-top: 2px solid black;
		}

		tbody td:last-child,
		thead th:last-child {
			border-right: none !important;
		}

		.textright {
			text-align: right;
		}
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<!-- oncontextmenu="return false;" -->
	<div class="bg-load">
		<div id="loading"></div>
	</div>
	<div class="wrapper">