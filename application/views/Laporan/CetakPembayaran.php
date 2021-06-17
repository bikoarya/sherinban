<!DOCTYPE html>
<html>

<head>
	<title><?= $title; ?></title>
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
		<b><?= $title; ?></b>
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

	<table border="1px" width="100%" style="margin-top: 15px; margin-bottom: 30px">
		<tr style="font-weight: lighter;">
			<th style="font-size: 12px;font-weight: lighter; text-align: left;" class="mt-1"><b>Tanggal</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: left;" class="mt-1"><b>No Nota</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: left;" class="mt-1"><b>Nama Mekanik</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: left;" class="mt-1"><b>Nama Pelanggan</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: right;" class="mt-1"><b>Total Pembayaran</b></th>
		</tr>
		<?php
		$sub_total = 0;
		$totalBayar = 0;
		foreach ($cetakBayar as $row => $value) {
			$sub_total = $value->total_pembayaran;
			$totalBayar += $sub_total;
		?>
			<tr>
				<td style="font-size: 12px;text-align: left;"><?= $value->tgl_penjualan ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->no_nota ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->nama_mekanik ?></td>
				<td style="font-size: 12px;text-align: left;"><?= $value->nama_pelanggan ?></td>
				<td style="font-size: 12px; text-align: right;"><?= number_format($sub_total) ?></td>
			</tr>
		<?php } ?>
		<tr>
			<td class="mt-1 text-center" colspan="4" style="font-size: 12px"><b>Total</b></td>
			<td style="font-size: 12px; text-align: right;"><b>Rp.<?= number_format($totalBayar) ?></b></td>
		</tr>
	</table>
</body>

</html>