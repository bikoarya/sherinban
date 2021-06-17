<html>

<head>
    <title><?= $title; ?></title>
    <style>
        @page {
            margin-top: 39mm;
            margin-left: 5mm;
            margin-bottom: 10mm;
            margin-right: 5mm;
            margin-header: 30px;
            /* margin-footer: 50px; */

            odd-header-name: html_MyHeader1;
            odd-footer-name: html_MyFooter1;
        }

        @page chapter2 {
            odd-header-name: html_MyHeader2;
            odd-footer-name: html_MyFooter2;
        }


        div.chapter2 {
            page-break-before: always;
            page: chapter2;
        }


        .hedsherin {
            font-weight: bold;
            text-align: left;
        }

        .jln {
            font-size: 11px;
            text-align: center;
        }

        .namatoko {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .nonota {
            font-size: 10px;
        }

        .gariss {
            border-bottom: 1.5px solid black;
        }

        .gariss1 {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>


    <htmlpageheader name="MyHeader1">
        <div>
            <img src="./assets/img/sherinban.jpg" height="50px" />
            <h4 style="font-weight: bold;margin-top: -50px;margin-left:51px;margin-bottom:0;">SHERIN BAN</h4>
            <h5 style="font-size: 11px;margin-top:-4px;margin-left:51px;margin-bottom:0;">
                Jl. Raya Bululawang Malang
            </h5>
            <h5 style="font-size: 11px;margin-top:-2px;margin-left:51px;margin-bottom:0;">
                0341-805558
            </h5>
            <h3 style="font-weight: bold;margin-top: -45px;margin-left:330px;margin-bottom:0;">Nota Penjualan</h3>

            <table border="0" style="margin-top: 25px;">
                <tr>
                    <td style="font-size: 14px;">
                        Tanggal
                    </td>
                    <td style="font-size: 14px;">:</td>
                    <td style="font-size: 14px;"><?= date('d-m-Y H:i:s') ?></td>
                </tr>
                <tr>
                    <td style="font-size: 14px;">No Nota</td>
                    <td style="font-size: 14px;">:</td>
                    <td style="font-size: 14px;"><?= $no_nota; ?></td>
                </tr>
            </table>
            <table border="0" style="margin-top: -50px;margin-left: 250px;">
                <tr>
                    <td>Mekanik</td>
                    <td>:</td>
                    <td><?= $mekanik['nama_mekanik']; ?></td>
                </tr>
                <tr>
                    <td>Admin</td>
                    <td>:</td>
                    <td><?= $this->session->userdata('nama_lengkap'); ?></td>
                </tr>
            </table>
            <table border="0" style="margin-top: -47px;margin-left: 450px;">
                <tr>
                    <td>Customer</td>
                    <td>:</td>
                    <td><?= substr($mekanik['nama_pelanggan'], 0, 16) ?></td>
                </tr>
                <tr>
                    <td>No. Polisi</td>
                    <td>:</td>
                    <td><?= $mekanik['no_polisi'] ?></td>
                </tr>
            </table>
        </div>

        <div class="gariss"></div>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th width="25%" style="text-align: left;font-size: 14px;">Item</th>
                    <th width="25%" style="text-align: left;font-size: 14px;">Spesifikasi</th>
                    <th style="text-align: right;font-size: 14px;" width="4%">Qty</th>
                    <th style="text-align: left;font-size: 14px;" width="7.5%">Satuan</th>
                    <th style="text-align: right;font-size: 14px;" width="15%">Harga</th>
                    <th style="text-align: right;font-size: 14px;" width="10%">Pot</th>
                    <th style="text-align: right;font-size: 14px;" width="15%">Jumlah</th>
                </tr>
            </thead>
        </table>
        <div class="gariss"></div>
    </htmlpageheader>




    <?php if ($kasir['keterangan'] == '1') { ?>
    <?php } ?>
    <table border="0" width="100%" style="margin-bottom: 0px;">
        <tbody>
            <?php
            $subtotal = 0;
            $total = 0;
            $pot = 0;
            $subpot = 0;

            foreach ($penjualan as $key => $value) :
                if ($value['id_jasa'] != null) {
                    $jasaitem = $value['Jasa'];
                    if ($value['jasapot_2'] == 0) {
                        if ($value['qty'] >= $value['jasaq_1']) {
                            $subjmlhpot = $value['jasapot_1'];
                        } else {
                            $subjmlhpot = 0;
                        }
                    } else {
                        if ($value['qty'] >= $value['jasaq_2']) {
                            $subjmlhpot = $value['jasapot_2'];
                        } elseif ($value['qty'] >= $value['jasaq_1']) {
                            $subjmlhpot = $value['jasapot_1'];
                        } else {
                            $subjmlhpot = 0;
                        }
                    }
                } else {
                    $jasaitem = $value['nama_barang'];
                    if ($value['pot_2'] == 0) {
                        if ($value['qty'] >= $value['q_1']) {
                            $subjmlhpot = $value['pot_1'];
                        } else {
                            $subjmlhpot = 0;
                        }
                    } else {
                        if ($value['qty'] >= $value['q_2']) {
                            $subjmlhpot = $value['pot_2'];
                        } elseif ($value['qty'] >= $value['q_1']) {
                            $subjmlhpot = $value['pot_1'];
                        } else {
                            $subjmlhpot = 0;
                        }
                    }
                }

                $hrga = $value['hrga_jual'];
                $jmlhpot = $value['hrga_jual'] - $subjmlhpot;
                $subhrga   = $value['qty'] * $jmlhpot;
                $subtotal += $subhrga;
            ?>
                <tr>
                    <td width="3%" style="text-align: center;"><?= $key + 1 ?></td>
                    <td width="25%" style="font-size: 14px;"><?= $jasaitem; ?></td>
                    <td width="25%" style="font-size: 14px;"><?= $value['spek'] ?></td>
                    <td style="text-align: right;font-size: 14px;" width="4%"><?= $value['qty']; ?></td>
                    <td style="text-align: left;font-size: 14px;" width="7.5%"><?= $value['nama_satuan']; ?></td>
                    <td style="text-align: right;font-size: 14px;" width="15%"><?= number_format($hrga, 0, ',', '.'); ?></td>
                    <td style="text-align: right;font-size: 14px;" width="10%"><?= number_format($subjmlhpot, 0, ',', '.'); ?></td>
                    <td style="text-align: right;font-size: 14px;" width="15%"><?= number_format($subhrga, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <?php if (count($penjualan) >= 10) { ?>
        <?php if (count($penjualan) <= 14) {
            $margin_top = 'style="margin-bottom:0;margin-top: 100px;"';
        } else {
            $margin_top = 'style="margin-bottom:0;"';
        }
        ?>
        <div class="gariss1" <?= $margin_top ?>></div>
        <div style="margin-bottom:0;">Keterangan : </div>
        <div style="margin-top: -15px;margin-bottom: 0;margin-left: 400px;">Hormat Kami</div>
        <table border="0" style="margin-left: 600px;margin-top: -25px;border: 1px solid black;">
            <tr>
                <th style="text-align: left;font-size: 14px;" colspan="2" width="95px">Total</th>
                <th>:</th>
                <th style="text-align: right;font-size: 14px;" width="95px"><?= number_format($subtotal, 0, ',', '.') ?></th>
            </tr>

        </table>
    <?php } else { ?>
        <div class="gariss1" style="margin-bottom:0;margin-top: 0px;"></div>
        <div style="margin-bottom:0;">Keterangan : </div>
        <div style="margin-top: -15px;margin-bottom: 0;margin-left: 400px;">Hormat Kami</div>
        <table border="0" style="margin-left: 600px;margin-top: -25px;border: 1px solid black;">
            <tr>
                <th style="text-align: left;font-size: 14px;" colspan="2" width="95px">Total</th>
                <th>:</th>
                <th style="text-align: right;font-size: 14px;" width="95px"><?= number_format($subtotal, 0, ',', '.') ?></th>
            </tr>
        </table>
    <?php } ?>

</body>

</html>