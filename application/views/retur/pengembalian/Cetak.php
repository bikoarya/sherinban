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
        <b>Laporan Retur Pengembalian</b>
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
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">#</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Tanggal Retur</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">No Faktur</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Nama Supplier</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">No. Supplier</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Kode Barang</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Nama Barang</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Spesifikasi</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Kode Produksi</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Jumlah Retur</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Jumlah Pengembalian</th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1">Sisa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sub_total = 0;
            $totalBeli = 0;
            foreach ($cetakdata as $row => $value) {
            ?>
                <tr>
                    <td><?= $row + 1 ?></td>
                    <td style="font-size: 14px;text-align: left;"><?= date("d-m-Y", strtotime($value['tgl_pengembalian'])) ?></td>
                    <td><?= $value['no_notapembelian']; ?></td>
                    <td><?= $value['nama_supplier']; ?></td>
                    <td><?= $value['telepon']; ?></td>
                    <td><?= $value['kode_barang']; ?></td>
                    <td><?= $value['nama_barang'] ?></td>
                    <td><?= $value['spek'] ?></td>
                    <td><?= $value['kode_produksi'] ?></td>
                    <td><?= $value['jumlah_brg_retur'] ?></td>
                    <td><?= $value['jumlah_brg_kembali'] ?></td>
                    <td><?= $value['Sisa']; ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</body>

</html>