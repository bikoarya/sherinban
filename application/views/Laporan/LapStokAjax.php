<div class="table-responsive">
    <table class="table table-bordered">
        <thead>

            <tr>
                <th class="text-left">Kode Produksi</th>
                <th class="text-left">Kode Barang</th>
                <th class="text-left">Nama Barang</th>
                <th class="text-left">Spesifikasi</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tlstok = 0;
            foreach ($stk as $key => $value) :
                $tlstok += $value['stok'];
            ?>
                <tr>
                    <td class="text-left"><?= $value['kode_produksi_pem'] ?></td>
                    <td class="text-left"><?= $value['kode_barang'] ?></td>
                    <td class="text-left"><?= $value['nama_barang'] ?></td>
                    <td class="text-left"><?= $value['spek'] ?></td>
                    <td class="text-center"><?= $value['nama_katagori'] ?></td>
                    <td class="text-center"><?= $value['nama_satuan'] ?></td>
                    <td class="text-center"><?= $value['stok'] ?></td>
                </tr>
            <?php endforeach; ?>
        <tfoot>
            <tr>
                <th class="mt-1 text-center" colspan="5" style="font-size: 16px">Total</th>
                <th class="text-center"><?= $tlstok ?></th>
            </tr>
        </tfoot>
        </tbody>
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