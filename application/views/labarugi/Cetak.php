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
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Kode Barang</b></th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Nama Barang</b></th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Jumlah Jual</b></th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Total Penjualan</b></th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;" class="mt-1"><b>Total Pembelian</b></th>
                <th style="font-size: 14px;font-weight: lighter; text-align: center;"><b>Laba</b></th>
            </tr>
        </thead>
        <?php
        $sub_total = 0;
        $totalBeli = 0;
        $total = 0;
        foreach ($cetakBeli as $row => $value) :

            $this->db->select('SUM(t_pembelian.qty) AS totalqtypembelian,t_pembelian.hrg_beli AS harga_belipembelian');
            $this->db->group_by('t_pembelian.kode_barang');
            $this->db->where('kode_barang', $value->kode_barang);
            $datapembelian = $this->db->get('t_pembelian')->row_array();

            $jmlhbeli    = $datapembelian['totalqtypembelian'] * $datapembelian['harga_belipembelian'];
            $jmlhterjual = $value->totaljaual * $value->hrgapenjualan;
            $totallaba = $jmlhterjual - $jmlhbeli;
            $total += $totallaba;
        ?>
            <tbody>
                <tr>
                    <td style="font-size: 14px;text-align: left;"><?= $value->kode_barang ?></td>
                    <td style="font-size: 14px;text-align: left;"><?= $value->nama_barang ?></td>
                    <td style="font-size: 14px;text-align: left;"><?= $value->totaljaual ?></td>
                    <td style="font-size: 14px;text-align: right;"><?= number_format($jmlhterjual, 0, ',', '.') ?></td>
                    <td style="font-size: 14px;text-align: right;"><?= number_format($jmlhbeli, 0, ',', '.') ?></td>
                    <td style="font-size: 14px;text-align: right;"><?= number_format($totallaba, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
        <tr>
            <td class="mt-1" colspan="5" style="font-size: 14px;text-align: center;"><b>Total</b></td>
            <td style="font-size: 14px; text-align: right;"><b>Rp.<?= number_format($total, 0, ',', '.') ?></b></td>
        </tr>
    </table>
</body>

</html>