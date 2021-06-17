<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mekanik</th>
                <th>Nama Mekanik</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Mekanik as $mek) : ?>
                <tr>
                    <td><?= ++$start ?></td>
                    <td><?= $mek['kode_mekanik'] ?></td>
                    <td><?= $mek['nama_mekanik'] ?></td>
                    <td><?= $mek['jabatan_mekanik'] ?></td>
                    <td> <a href="javascript:void(0);" class="text-success ubahmek" data-kode_mekanik="<?= $mek['kode_mekanik'] ?>" data-nama_mekanik="<?= $mek['nama_mekanik'] ?>" data-jabatan_mekanik="<?= $mek['jabatan_mekanik'] ?>"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapusmek" data-kode_mekanik="<?= $mek['kode_mekanik'] ?>"><i class="far fa-trash-alt"></i></a></td>
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