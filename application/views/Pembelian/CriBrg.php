<div class="table-responsive">
    <table class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Spesifikasi</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Kode Produksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $key => $value) : ?>
                <?php if ($value['aktif'] == 'N') {
                } else { ?>
                    <tr>
                        <td><?= ++$start ?></td>
                        <td><?= $value['kode_barang'] ?></td>
                        <td><?= $value['nama_barang'] ?></td>
                        <td><?= $value['nama_satuan'] ?></td>
                        <td><?= $value['nama_katagori'] ?></td>
                        <td><?= $value['spek'] ?></td>
                        <td>Rp. <?= number_format($value['harga_beli'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($value['harga_jual'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($value['type_exp'] == '1') { ?>
                                <div class="color-palette-set">
                                    <div class="bg-success color-palette"><span>Ya</span></div>
                                </div>
                            <?php } else { ?>
                                <div class="color-palette-set">
                                    <div class="bg-danger color-palette"><span>Tidak</span></div>
                                </div>
                            <?php } ?>
                        </td>
                        <td><a href="javascript:void(0);" class="btn btn-primary caribrg" data-kode_brg="<?= $value['kode_barang'] ?>" data-nama_barang="<?= $value['nama_barang'] ?>" data-harga_jual="<?= $value['harga_jual'] ?>" data-harga_beli="<?= $value['harga_beli'] ?>" data-nama_satuan="<?= $value['nama_satuan'] ?>" data-nama_katagori="<?= $value['nama_katagori'] ?>" data-type_exp="<?= $value['type_exp'] ?>">Pilih</a></td>
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