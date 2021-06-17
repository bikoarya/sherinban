<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mobil</th>
                <!-- <th>Spesifikasi Standart</th> -->
                <th>Ban Depan</th>
                <th>Ban Belakang</th>
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