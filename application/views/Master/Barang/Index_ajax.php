<div class="table-responsive">
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th rowspan="2" class="text-center" style="vertical-align: middle;">No.</th>
                <th rowspan="2" style="vertical-align: middle;" style="width: 50%;">Kode Barang</th>
                <th rowspan="2" style="vertical-align: middle;">Nama Barang</th>
                <th rowspan="2" style="vertical-align: middle;">Satuan</th>
                <th rowspan="2" style="vertical-align: middle;">Kategori</th>
                <th rowspan="2" style="vertical-align: middle;">Spesifikasi</th>
                <th rowspan="2" style="vertical-align: middle;">Harga Beli</th>
                <th rowspan="2" style="vertical-align: middle;">Harga Jual</th>
                <th colspan="2" style="text-align: center;vertical-align: middle;">Pot 1</th>
                <th colspan="2" style="text-align: center;vertical-align: middle;">Pot 2</th>
                <th rowspan="2" style="vertical-align: middle;">Stok Minimum</th>
                <th rowspan="2" style="vertical-align: middle;">Kode Produksi</th>
                <th rowspan="2" style="vertical-align: middle;">Aktif</th>
                <th rowspan="2" style="vertical-align: middle;">Aksi</th>
            </tr>
            <tr>
                <th style="text-align: center;">Min. Qty</th>
                <th style="text-align: center;">Pot</th>
                <th style="text-align: center;">Min. Qty</th>
                <th style="text-align: center;">Pot</th>
            </tr>
        </thead>
        <tbody>
            <?php $Y = 1;
            foreach ($barang as $key => $data) : ?>
                <tr>
                    <td class="text-center"><?= ++$start ?></td>
                    <td style="width: 50%;"><?= $data['kode_barang']; ?></td>
                    <td><?= $data['nama_barang']; ?></td>
                    <td><?= $data['nama_satuan'] ?></td>
                    <td><?= $data['nama_katagori'] ?></td>
                    <td><?= $data['spek'] ?></td>
                    <td style="text-align: right;"><?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                    <td style="text-align: right;"><?= number_format($data['harga_jual'], 0, ',', '.') ?></td>
                    <td><?= $data['q_1'] ?></td>
                    <td style="text-align: right;"><?= number_format($data['pot_1'], 0, ',', '.') ?></td>
                    <td><?= $data['q_2'] ?></td>
                    <td style="text-align: right;"><?= number_format($data['pot_2'], 0, ',', '.') ?></td>
                    <td><?= $data['stok_min'] ?></td>
                    <td>
                        <?php if ($data['type_exp'] == $Y) { ?>
                            <div class="color-palette-set">
                                <div class="bg-success color-palette"><span>Ya</span></div>
                            </div>
                        <?php } else { ?>
                            <div class="color-palette-set">
                                <div class="bg-danger color-palette"><span>Tidak</span></div>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($data['aktif'] == 'Y') { ?>
                            <div class="color-palette-set">
                                <div class="bg-success color-palette"><span>Aktif</span></div>
                            </div>
                        <?php } else { ?>
                            <div class="color-palette-set">
                                <div class="bg-danger color-palette"><span>Tidak Aktif</span></div>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="text-success ubahbarang" data-kode_barang="<?= $data['kode_barang'] ?>" data-nama_barang="<?= $data['nama_barang'] ?>" data-id_satuan="<?= $data['id_satuan'] ?>" data-id_kategori="<?= $data['id_kategori'] ?>" data-spek="<?= $data['spek'] ?>" data-harga_jual="<?= $data['harga_jual'] ?>" data-harga_beli="<?= $data['harga_beli'] ?>" data-stok_min="<?= $data['stok_min'] ?>" data-aktif="<?= $data['aktif'] ?>" data-typeexp="<?= $data['type_exp'] ?>" data-qty1="<?= $data['q_1'] ?>" data-qty2="<?= $data['q_2'] ?>" data-pot1="<?= $data['pot_1'] ?>" data-pot2="<?= $data['pot_2'] ?>"><i class="far fa-edit"></i></a>
                        <?php if ($data['del'] == 1) { ?>
                            <a href="#" class="text-danger terpkai" data-kode_barang="<?= $data['kode_barang'] ?>"><i class="far fa-trash-alt"></i></a>
                        <?php } else { ?>
                            <a href="#" class="text-danger hapusbarang" data-kode_barang="<?= $data['kode_barang'] ?>"><i class="far fa-trash-alt"></i></a>
                        <?php } ?>
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