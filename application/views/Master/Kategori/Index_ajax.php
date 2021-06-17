<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori as $ktg) : ?>
                <tr>
                    <td><?= ++$start; ?></td>
                    <td><?= $ktg['nama_katagori']; ?></td>
                    <td><a href="javascript:void(0);" class="text-success ubahkatagorii" data-id_katagori="<?= $ktg['id_katagori'] ?>" data-nama_katagori="<?= $ktg['nama_katagori'] ?>"><i class="far fa-edit"></i></a>
                        <a href="javascript:void(0);" class="text-danger hapuskatagori" data-id_katagori="<?= $ktg['id_katagori'] ?>"><i class="far fa-trash-alt"></i></a>
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