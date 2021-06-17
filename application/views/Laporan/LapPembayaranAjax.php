<div class="table-responsive ">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-left">Tanggal</th>
                <th class="text-left">No Nota</th>
                <th class="text-left">Nama Mekanik</th>
                <th class="text-left">Nama Pelanggan</th>
                <th class="text-right">Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sub_total = 0;
            $totalBayar = 0;
            foreach ($pembayaran as $key => $value) :
                $sub_total = $value['total_pembayaran'];
            ?>
                <tr>
                    <td class="text-left"><?= $value['tgl_penjualan'] ?></td>
                    <td class="text-left"><?= $value['no_nota'] ?></td>
                    <td class="text-left"><?= $value['nama_mekanik'] ?></td>
                    <td class="text-left"><?= $value['nama_pelanggan'] ?></td>
                    <td class="text-right">Rp. <?= number_format($sub_total, 0, ',', '.') ?></td>
                </tr>
            <?php
                $totalBayar += $sub_total;
            endforeach;
            ?>
        </tbody>
        <tr>
            <th class="mt-1 text-center" colspan="4" style="font-size: 16px">Total</th>
            <th class="text-right">Rp. <?= number_format($totalBayar, 0, ',', '.') ?></th>
        </tr>
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