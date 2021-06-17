<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-left">Kode Barang</th>
                <th class="text-left">Nama Barang</th>
                <th class="text-left">Spesifikasi</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Stok</th>
                <th class="text-left">Kode Produksi</th>
                <th class="text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($masaaktif as $key => $value) :
                $mingguskrng = date('yW'); ?>
                <?php if (!$value['kode_produksi_pem']) { ?>
                <?php } else { ?>
                    <tr>
                        <td class="text-left"><?= $value['kode_barang'] ?></td>
                        <td class="text-left"><?= $value['nama_barang'] ?></td>
                        <td class="text-left"><?= $value['spek'] ?></td>
                        <td class="text-center"><?= $value['nama_katagori'] ?></td>
                        <td class="text-center"><?= $value['Stok'] ?></td>
                        <td class="text-left"><?= $value['kode_produksi_pem'] ?></td>
                        <?php if ($value['exp'] <= $mingguskrng) { ?>
                            <td class="text-left">
                                <span class="badge badge-pill badge-danger">Expired</span>
                            </td>
                        <?php } elseif ($value['indikator'] <= $mingguskrng) { ?>
                            <td class="text-left">
                                <span class="badge badge-pill badge-warning">Warning</span>
                            </td>
                        <?php } else { ?>
                            <td class="text-left">
                                <span class="badge badge-pill badge-success">Ready</span>
                            </td>
                        <?php } ?>
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