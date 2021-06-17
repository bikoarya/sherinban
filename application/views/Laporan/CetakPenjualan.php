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
		<b>Laporan Penjualan</b>
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
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>No Nota</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Nama Mekanik</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Nama Barang</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Spesifikasi</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Kode Produksi</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Nama Pelanggan</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Jumlah Jual</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Harga Jual</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Pot Jual</b></th>
				<th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Sub Total</b></th>
			</tr>
		</thead>
		<?php
		$sub_total = 0;
		$totalJual = 0;
		foreach ($cetakJual as $row => $value) {
			if ($value->id_jasa != 0) {
				$spek = "-";
				$nmabrg = $value->Jasa;
			} else {
				# code...
				$spek = $value->spek;
				$nmabrg = $value->nama_barang;
			}
			$harga = $value->hrga_jual;
			$pothrg = $value->hrga_jual - $value->potongan;
			$sub_total = $pothrg * $value->jumlah_jual;
			$totalJual += $sub_total;
		?>
			<tr>
				<td style="font-size: 12px;text-align: left;"><?= date("d-m-Y", strtotime($value->tgl_penjualan)) ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->no_nota ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->nama_mekanik ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $nmabrg ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $spek ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->kode_produksi_pen ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->nama_pelanggan ?></td>
				<td style="font-size: 12px;text-align: center;"><?= $value->jumlah_jual ?></td>
				<td style="font-size: 12px; text-align: right;"><?= number_format($harga, 0, ',', '.') ?></td>
				<td style="font-size: 12px; text-align: right;"><?= number_format($value->potongan, 0, ',', '.') ?></td>
				<td style="font-size: 12px; text-align: right;"><?= number_format($sub_total, 0, ',', '.') ?></td>
			</tr>
		<?php } ?>
		<tr>
			<td class="mt-1" colspan="10" style="font-size: 12px;text-align: center;"><b>Total</b></td>
			<td style="font-size: 12px; text-align: right;"><b>Rp.<?= number_format($totalJual, 0, ',', '.') ?></b></td>
		</tr>
	</table>
</body>

</html>