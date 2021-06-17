<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th rowspan="2" style="vertical-align: middle;">No.</th>
                <th rowspan="2" style="vertical-align: middle;">Jenis Jasa</th>
                <th rowspan="2" style="vertical-align: middle;">Harga</th>
                <th colspan="2" style="vertical-align: middle;">Pot 1</th>
                <th colspan="2" style="vertical-align: middle;">Pot 2</th>
                <th rowspan="2" style="vertical-align: middle;">Aksi</th>
            </tr>
            <tr class="text-center">
                <th>Min. Qty</th>
                <th>Pot</th>
                <th>Min. Qty</th>
                <th>Pot</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jasa as $jsa) : ?>
                <tr>
                    <td><?= ++$start; ?></td>
                    <td><?= $jsa['Jasa']; ?></td>
                    <td class="text-right"><?= number_format($jsa['Harga_jasa'], 0, ',', '.'); ?></td>
                    <td><?= $jsa['q_1'] ?></td>
                    <td class="text-right"><?= number_format($jsa['pot_1'], 0, ',', '.') ?></td>
                    <td><?= $jsa['q_2'] ?></td>
                    <td class="text-right"><?= number_format($jsa['pot_2'], 0, ',', '.') ?></td>
                    <td>
                        <a href="javascript:void(0);" class="text-success ubhjasa" data-idjasa="<?= $jsa['id_jasa'] ?>" data-jasa="<?= $jsa['Jasa'] ?>" data-hargajasa="<?= $jsa['Harga_jasa'] ?>" data-edtqty="<?= $jsa['q_1']; ?>" data-edtpot="<?= $jsa['pot_1'] ?>" data-edtqty2="<?= $jsa['q_2'] ?>" data-edtpot2="<?= $jsa['pot_2'] ?>"><i class="far fa-edit"></i></a>
                        <?php if ($jsa['del'] == 1) { ?>
                            <a href="#" class="text-danger terpkai"><i class="far fa-trash-alt"></i></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="text-danger hpsjasa" data-id_jasa="<?= $jsa['id_jasa'] ?>"><i class="far fa-trash-alt"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
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