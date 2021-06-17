<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mobil</th>
                <!-- <th>Spesifikasi Standart</th> -->
                <th>Ukuran Standart Ban Depan</th>
                <th>Ukuran Standart Ban Belakang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($standart as $stand) : ?>
                <tr>
                    <td><?= ++$start ?></td>
                    <td><?= $stand['nama_standart'] ?></td>
                    <!-- <td><?= $stand['ring_standart'] ?></td> -->
                    <td><?= $stand['bandepan'] ?></td>
                    <td><?= $stand['banbelakang'] ?></td>
                    <td> <a href="javascript:void(0);" class="text-success ubahstandart" data-id_standart="<?= $stand['id_standart'] ?>" data-nama_standart="<?= $stand['nama_standart'] ?>" data-ring_standart="<?= $stand['ring_standart'] ?>" data-bandepan="<?= $stand['bandepan'] ?>" data-banbelakang="<?= $stand['banbelakang'] ?>"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapusstandart" data-id_standart="<?= $stand['id_standart'] ?>"><i class="far fa-trash-alt"></i></a></td>
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