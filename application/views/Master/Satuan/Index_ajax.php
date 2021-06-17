<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($satuan as $sat) :
            ?>
                <tr>
                    <td><?= ++$start ?></td>
                    <td><?= $sat['nama_satuan']; ?></td>
                    <td>
                        <a href="javascript:void(0);" class="text-success ubahsatuan" data-id_satuan="<?= $sat['id_satuan'] ?>" data-nama_satuan="<?= $sat['nama_satuan'] ?>"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapussatuan" data-id_satuan="<?= $sat['id_satuan'] ?>"><i class="far fa-trash-alt"></i></a>
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