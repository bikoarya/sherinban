<!DOCTYPE html>
<html>

<head>
	<title><?= $title; ?></title>
	<!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<style>
		.font {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			text-align: center;
			font-weight: lighter;
			font-size: 20px;
			margin-bottom: 0;
		}

		.header {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			text-align: center;
			font-weight: lighter;
			margin-top: 20px
		}

		table {
			color: #232323;
			border-collapse: collapse;
		}

		table,
		th,
		td {
			border: 1px solid black;
			padding: 5px 5px;
		}

		.kategori {
			text-align: center;
			margin-top: 5px;
			margin-bottom: 0;
		}
	</style>
</head>

<body>
	<h6 class="font">
		<b>Laporan Pembelian</b>
	</h6>
	<?php if ($awal != null && $akhir != null && $keyword != null) { ?>
		<p class="kategori">
			<?php print $awal; ?> s/d <?php print $akhir; ?><br><?php print $keyword; ?>
		</p>
	<?php } elseif ($awal != null && $akhir != null) { ?>
		<p class="kategori">
			<?php print $awal; ?> s/d <?php print $akhir; ?>
		</p>

	<?php } elseif ($keyword != null) { ?>
		<p class="kategori">
			<?php print  $keys . ' : ' . $keyword; ?>
		</p>
	<?php } else {
	}  ?>

	<hr style="border: 1px solid black;">

	<table border="1" width="100%">
		<thead>
			<tr style="font-weight: lighter;">
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Tanggal</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>No Faktur</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Nama Barang</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Satuan</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Kategori</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Spesifikasi</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Kode Produksi</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Harga Beli</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Jumlah</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Sub Total</b></th>
			</tr>
		</thead>
		<?php
		$sub_total = 0;
		$totalBeli = 0;
		foreach ($cetakBeli as $row => $value) {
			$sub_total = $value->harga_beli * $value->qty;
			$totalBeli += $sub_total;
			if ($value->kode_produksi_pem == 0) {
				$kode_produksi = '-';
			} else {
				$kode_produksi = $value->kode_produksi_pem;
			}
		?>
			<tbody>
				<tr>
					<td style="font-size: 14px;text-align: left;"><?= date('d-m-Y', strtotime($value->tgl_pembelian)) ?></td>
					<td style="font-size: 14px;text-align: left;"><?= $value->no_faktur ?></td>
					<td style="font-size: 14px;text-align: left;"><?= $value->nama_barang ?></td>
					<td style="font-size: 14px;text-align: center;"><?= $value->nama_satuan ?></td>
					<td style="font-size: 14px;text-align: center;"><?= $value->nama_katagori ?></td>
					<td style="font-size: 14px;text-align: left;"><?= $value->spek ?></td>
					<td style="font-size: 14px;text-align: left;"><?= $kode_produksi ?></td>
					<td style="font-size: 14px; text-align: right;">Rp.<?= number_format($value->harga_beli) ?></td>
					<td style="font-size: 14px; text-align: center;"><?= $value->qty ?></td>
					<td style="font-size: 14px; text-align: right;">Rp.<?= number_format($sub_total) ?></td>
				</tr>
			</tbody>
		<?php } ?>
		<tr>
			<td class="mt-1" colspan="9" style="font-size: 14px;text-align: center;"><b>Total</b></td>
			<td style="font-size: 14px; text-align: right;"><b>Rp.<?= number_format($totalBeli) ?></b></td>
		</tr>
	</table>
</body>

</html>