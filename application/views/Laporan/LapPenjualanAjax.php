<div class="table-responsive">
    <table class="table table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th class="text-left">Tanggal</th>
                <th class="text-left">No Nota</th>
                <th class="text-left">Mekanik</th>
                <th class="text-left">Barang / Jasa</th>
                <th class="text-left">Spesifikasi</th>
                <th class="text-left">Pelanggan</th>
                <th class="text-right">Jumlah Jual</th>
                <th class="text-right">Harga Jual</th>
                <th class="text-right">Pot</th>
                <th class="text-right">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalJual = 0;
            $sub_total = 0;
            foreach ($pem as $key => $value) :

                if ($value['id_jasa'] != 0) {
                    $spek = "-";
                    $nmabrg = $value['Jasa'];
                    $sub_total = $value['Harga_jasa'] * $value['jumlah_jual'];
                    $harga = $value['Harga_jasa'];
                } else {
                    # code...
                    $nmabrg = $value['nama_barang'];
                    $potsub = $value['harga_jual'] - $value['potongan'];
                    $sub_total = $potsub * $value['jumlah_jual'];
                    $harga = $value['harga_jual'];
                    $spek = $value['spek'];
                }
            ?>
                <tr>
                    <td class="text-left"><?= date("d-m-Y", strtotime($value['tgl_penjualan'])) ?></td>
                    <td class="text-left"><?= $value['no_nota'] ?></td>
                    <td class="text-left"><?= $value['nama_mekanik'] ?></td>
                    <td class="text-left"><?= $nmabrg ?></td>
                    <td class="text-left"><?= $spek; ?></td>
                    <td class="text-left"><?= $value['nama_pelanggan'] ?></td>
                    <td class="text-right"><?= $value['jumlah_jual'] ?></td>
                    <td class="text-right"><?= number_format($harga, 0, ',', '.') ?></td>
                    <td class="text-right"><?= $value['potongan'] ?></td>
                    <td class="text-right"><?= number_format($sub_total, 0, ',', '.') ?></td>
                </tr>
            <?php $totalJual  += $sub_total;
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="mt-1 text-center" colspan="9" style="font-size: 16px">Total</th>
                <th class="text-right"><?= number_format($totalJual, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</div>
<?php if ($pagelinks) { ?>
    <?= $pagelinks; ?>
    <div class="mt-n5">
        Jumlah Data : <?= $total; ?>
    </div>
<?php } else { ?>
    <div class="">
        Jumlah Data : <?= $total; ?>
    </div>
<?php } ?>