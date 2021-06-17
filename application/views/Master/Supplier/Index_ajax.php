<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplier as $sup) : ?>
                <tr>
                    <td><?= ++$start ?></td>
                    <td><?= $sup['kode_supplier'] ?></td>
                    <td><?= $sup['nama_supplier'] ?></td>
                    <td><?= $sup['alamat_supplier'] ?></td>
                    <td><?= $sup['telepon'] ?></td>
                    <td> <a href="javascript:void(0);" class="text-success ubahsup" data-kode_supplier="<?= $sup['kode_supplier'] ?>" data-nama_supplier="<?= $sup['nama_supplier'] ?>" data-alamat_supplier="<?= $sup['alamat_supplier'] ?>" data-telepon="<?= $sup['telepon'] ?>"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapussup" data-kode_supplier="<?= $sup['kode_supplier'] ?>"><i class="far fa-trash-alt"></i></a></td>
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