<div class="table-responsive">

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-left">Kode Barang</th>
                <th class="text-left">Nama Barang</th>
                <th class="text-left">Satuan</th>
                <th class="text-left">Kategori</th>
                <th class="text-left">Spesifikasi</th>
                <th class="text-left">Stok</th>
                <th class="text-right">Harga</th>
                <th class="text-left">Kode Produksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cribrng as $key => $value) :
                $mingguskrng = date('yW');
            ?>
                <?php if ($value['Stok'] == 0) { ?>
                <?php } else { ?>
                    <tr>
                        <td class="text-center"><?= ++$start ?></td>
                        <td class="text-left"><?= $value['kode_barang'] ?></td>
                        <td class="text-left"><?= $value['nama_barang'] ?></td>
                        <td class="text-left"><?= $value['nama_satuan'] ?></td>
                        <td class="text-left"><?= $value['nama_katagori'] ?></td>
                        <td class="text-left"><?= $value['spek'] ?></td>
                        <td class="text-left">
                            <?php if ($value['Stok'] <= $value['stok_min']) { ?>
                                <div class="color-palette-set">
                                    <div class="bg-warning color-palette"><span><?= $value['Stok'] ?></span></div>
                                </div>
                            <?php } else { ?>
                                <?= $value['Stok'] ?>
                            <?php } ?>
                        </td>
                        <td class="text-right">Rp. <?= number_format($value['hrg_jual'], 0, ',', '.') ?></td>

                        <?php if ($value['kode_produksi_pem'] == 0) { ?>
                            <td class="text-left">Tidak</td>
                        <?php } else { ?>
                            <?php if ($value['exp'] <= $mingguskrng) { ?>
                                <td class="text-left">
                                    <div class="color-palette-set">
                                        <div class="bg-danger color-palette"><span> <?= $value['kode_produksi_pem'] ?></span></div>
                                    </div>
                                </td>
                            <?php } elseif ($value['indikator'] <= $mingguskrng) { ?>
                                <td class="text-left">
                                    <div class="color-palette-set">
                                        <div class="bg-warning color-palette"><span> <?= $value['kode_produksi_pem'] ?></span></div>
                                    </div>
                                </td>
                            <?php } else { ?>
                                <td class="text-left"><?= $value['kode_produksi_pem'] ?></td>
                            <?php } ?>
                        <?php } ?>
                        <td>
                            <?php if ($value['Stok'] <= $value['stok_min']) { ?>
                                <a href="javascript:void(0);" class="btn btn-primary stkkurang" data-kode_brg="<?= $value['kode_barang'] ?>" data-nama_barang="<?= $value['nama_barang'] ?>" data-harga_jual="<?= $value['harga_jual'] ?>" data-harga_beli="<?= $value['harga_beli'] ?>" data-satuan="<?= $value['nama_satuan'] ?>" data-kategori="<?= $value['nama_katagori'] ?>" data-kode_produksi="<?= $value['kode_produksi_pem'] ?>" data-nofaktur="<?= $value['no_faktur'] ?>" data-qty="<?= $value['Stok'] ?>">Pilih</a>
                            <?php } else { ?>
                                <a href="javascript:void(0);" class="btn btn-primary caripenjualan" data-kode_brg="<?= $value['kode_barang'] ?>" data-nama_barang="<?= $value['nama_barang'] ?>" data-harga_jual="<?= $value['harga_jual'] ?>" data-harga_beli="<?= $value['harga_beli'] ?>" data-satuan="<?= $value['nama_satuan'] ?>" data-kategori="<?= $value['nama_katagori'] ?>" data-kode_produksi="<?= $value['kode_produksi_pem'] ?>" data-nofaktur="<?= $value['no_faktur'] ?>" data-qty="<?= $value['Stok'] ?>">Pilih</a>
                            <?php } ?>

                        </td>
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