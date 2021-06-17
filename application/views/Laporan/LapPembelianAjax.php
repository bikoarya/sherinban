<div class="table-responsive ">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-left">Tanggal</th>
                <th class="text-left">No Faktur</th>
                <th class="text-left">Nama Barang</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Kategori</th>
                <th class="text-right">Spesifikasi</th>
                <th class="text-right">Harga Beli</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Sub Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sub_total = 0;
            $totalBeli = 0;
            foreach ($pem as $pemb) :
                $sub_total = $pemb['harga_beli'] * $pemb['qty'];
            ?>
                <tr>
                    <td class="text-left"><?= date('d-m-Y', strtotime($pemb['tgl_pembelian'])) ?></td>
                    <td class="text-left"><?= $pemb['no_faktur'] ?></td>
                    <td class="text-left"><?= $pemb['nama_barang'] ?></td>
                    <td class="text-center"><?= $pemb['nama_satuan'] ?></td>
                    <td class="text-center"><?= $pemb['nama_katagori'] ?></td>
                    <td class="text-left"><?= $pemb['spek'] ?></td>
                    <td class="text-right">Rp. <?= number_format($pemb['harga_beli'], 0, ',', '.') ?></td>
                    <!-- <td class="text-right">Rp. <?= number_format($pemb['harga_jual'], 0, ',', '.') ?></td> -->
                    <td class="text-center"><?= $pemb['qty'] ?></td>
                    <td class="text-right"> Rp. <?= number_format($sub_total, 0, ',', '.')  ?></td>
                </tr>
            <?php
                $totalBeli += $sub_total;
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="mt-1 text-center" colspan="8">Total</th>
                <th class="text-right">
                    Rp. <?= number_format($totalBeli, 0, ',', '.') ?>
                </th>
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