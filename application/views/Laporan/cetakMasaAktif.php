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
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Kode Barang</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Nama Barang</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Spesifikasi</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Katagori</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Stok</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Kode Produksi</b></th>
			<th style="font-size: 12px;font-weight: lighter; text-align: center;" class="mt-1"><b>Status</b></th>
		</tr>

		<?php
		foreach ($cetakMasaAktif as $row => $value) {
			$mingguskrng = date('yW');
		?>
			<?php if (!$value->kode_produksi_pem) { ?>
			<?php } else { ?>
				<tr>
					<td style="font-size: 12px;text-align: left;"><?= $value->kode_barang ?></td>
					<td style="font-size: 12px;text-align: left;"><?= $value->nama_barang ?></td>
					<td style="font-size: 12px;text-align: left;"><?= $value->spek ?></td>
					<td style="font-size: 12px;text-align: left;"><?= $value->nama_katagori ?></td>
					<td style="font-size: 12px; text-align: center;"><?= $value->Stok ?></td>
					<td style="font-size: 12px; text-align: left;"><?= $value->kode_produksi_pem ?></td>
					<?php if ($value->exp <= $mingguskrng) { ?>
						<td class="font-size: 12px; text-align: center;">
							<span class="badge badge-danger">Expired</span>
						</td>
					<?php } elseif ($value->indikator <= $mingguskrng) { ?>
						<td class="font-size: 12px; text-align: center;">
							<span class="badge badge-warning">Warning</span>
						</td>
					<?php } else { ?>
						<td class="font-size: 12px; text-align: center;">
							<span class="badge badge-success">Ready</span>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
</body>

</html>