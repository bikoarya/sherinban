<div class="table-responsive">
    <table class="table table-bordered table-striped tmpilakun">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td><?= ($key + 1) ?></td>
                    <td><?= $value['nama_lengkap'] ?></td>
                    <td><?= $value['username'] ?></td>
                    <td><?= $value['nama_level'] ?></td>
                    <td><a href="javascript:void(0);" class="text-success ubahbarang" data-iduser="<?= $value['id_user'] ?>" data-nm_lengkap="<?= $value['nama_lengkap'] ?>" data-usrnm="<?= $value['username'] ?>" data-pass1="<?= $value['password'] ?>" data-level="<?= $value['id_level'] ?>"><i class="far fa-edit"></i></a> <a href="#" class="text-danger hapusakun" data-id_user="<?= $value['id_user'] ?>"><i class="far fa-trash-alt"></i></a></td>
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