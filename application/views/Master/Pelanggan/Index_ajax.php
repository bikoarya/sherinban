<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggan as $pel) : ?>
                <?php if ($pel['kode_pelanggan'] == "PEL0001") { ?>
                <?php } else { ?>
                    <tr>
                        <td><?= ++$start ?></td>
                        <td><?= $pel['kode_pelanggan'] ?></td>
                        <td><?= $pel['nama_pelanggan'] ?></td>
                        <td><?= $pel['alamat_pelanggan'] ?></td>
                        <td><?= $pel['telepon_pelanggan'] ?></td>
                        <td> <a href="javascript:void(0);" class="text-success ubahpelanggan" data-kode_pelanggan="<?= $pel['kode_pelanggan'] ?>" data-nama_pelanggan="<?= $pel['nama_pelanggan'] ?>" data-alamat_pelanggan="<?= $pel['alamat_pelanggan'] ?>" data-telepon_pelanggan="<?= $pel['telepon_pelanggan'] ?>"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapuspelanggan" data-kode_pelanggan="<?= $pel['kode_pelanggan'] ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                <?php } ?>
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