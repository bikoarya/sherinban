<?php
$sess = [
    'tgl_penjualan' => $penjualanedt['tgl_penjualan'],
    'kode_pelanggan' => $penjualanedt['kode_pelanggan'],
    'no_polisi' => $penjualanedt['no_polisi'],
    'kode_mekanik' => $penjualanedt['kode_mekanik'],
];
$this->session->set_userdata($sess);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>
                        Penjualan
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="flash-berhasil" data-berhasil="<?= $this->session->flashdata('berhasil'); ?>"></div>
                    <div class="flash-gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
                    <form role="form" id="penjualanvalid">
                        <div class="card-body mt-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No Nota : <?= $penjualanedt['no_nota'] ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal : <?= date("d-m-Y", strtotime($penjualanedt['tgl_penjualan'])); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div style="margin-left: 24.2%;">
                                        <button type="button" class="badge badge-success" id="vstandart">Standart Ban</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pelanggan</label>
                                            <select class="form-control select2 pela" name="kode_pelanggan" id="kode_pelanggan1" style="width: 100%;" disabled>
                                                <option value=""></option>
                                                <option value="PelangganBaru">Pelanggan Baru</option>
                                                <?php
                                                $idpel = $penjualanedt['kode_pelanggan'];
                                                foreach ($plgn as $pel) : ?>
                                                    <?php if ($idpel == $pel['kode_pelanggan']) { ?>
                                                        <option value="<?= $pel['kode_pelanggan']; ?>" selected><?= $pel['nama_pelanggan']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $pel['kode_pelanggan']; ?>"><?= $pel['nama_pelanggan']; ?></option>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Polisi</label>
                                            <input type="text" class="form-control" id="no_polisi" name="no_polisi" autocomplete="off" placeholder="No Polisi" value="<?= $penjualanedt['no_polisi'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mekanik</label>
                                            <select class="form-control select2 meka" name="txtmekanik2" id="txtmekanik1" style="width: 100%;" disabled>
                                                <option value=""></option>
                                                <?php
                                                $idmekanik = $penjualanedt['kode_mekanik'];
                                                foreach ($meka as $mek) :  ?>
                                                    <?php if ($mek['kode_mekanik'] == $idmekanik) { ?>
                                                        <option value="<?= $mek['kode_mekanik']; ?>" selected><?= $mek['nama_mekanik']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $mek['kode_mekanik']; ?>"><?= $mek['nama_mekanik']; ?></option>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 100%;background-color: grey;">
                                <hr style="border: 0.5px solid grey;">
                            </div>

                            <div class="float-right" style="margin-top: 25px;">
                                <a class="btn btn-success text-white vjasa" data-link="<?php print base_url('Transaksi/Penjualan/listjasa'); ?>">Jasa</a>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <div class="kodebrghide">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="txtkode_barang" id="txtkode_barang" autocomplete="off" placeholder="Kode Barang">
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#v-caribarang">Cari</button>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="kodejasa" style="display: none;">
                                                <div class="input-group ">
                                                    <input type="text" class="form-control" name="txtidjasa" id="txtidjasa" autocomplete="off" placeholder="Kode Barang" readonly>
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#v-caribarang">Cari</button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" class="form-control" id="nm_brg" name="nm_brg" placeholder="Nama Barang">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" id="hrg_jual" name="hrg_jual" placeholder="Harga Jual">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control" id="txtjumlah" name="txtjumlah" autocomplete="off" placeholder="Qty">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-3">
                                        <button type="submit" id="tambahpenjualan" class="btn btn-primary mt-3" style="height: 55%;" data-link="<?= base_url("Transaksi/Penjualan/edittambah") ?>"><i class="fas fa-cart-plus"></i></button>

                                        <input type="hidden" class="form-control" id="satuan" name="satuan" placeholder="satuan">
                                        <input type="hidden" class="form-control" id="kategori" name="kategori" placeholder="kategori">
                                        <input type="hidden" class="form-control" id="kode_produksi" name="kode_produksi" placeholder="kode_produksi">
                                        <input type="hidden" class="form-control" id="no_faktur" name="no_faktur">
                                        <input type="hidden" class="form-control" id="txtqty" name="txtqty">
                                    </div>

                                    <input type="hidden" class="form-control w-50" id="txtqty1" name="txtqty1">
                                    <input type="hidden" class="form-control w-50" id="txtqty2" name="txtqty2">
                                    <input type="hidden" class="form-control w-50" id="txtpot2" name="txtpot2">
                                    <input type="hidden" class="form-control w-50" id="txtpot1" name="txtpot1">

                                </div>
                            </div>

                        </div>
                    </form>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tabelv" data-link="<?= base_url("Transaksi/Penjualan/edittable/") . $penjualanedt['no_nota']; ?>"></div>

                        </div>
                        <a href="<?= base_url('Transaksi/Penjualan/transaksi'); ?>" type="" class="btn btn-primary mx-auto mb-5 mt-3">Simpan</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="v-caribarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="v-caribarang">Cari Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- /.card-header -->
                <div class="table-responsive">
                    <table class="datatable2 table table-bordered" data-link="<?= base_url('Transaksi/Penjualan/vcridatabarang') ?>" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Spesifikasi</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Kode Produksi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pelanggan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="pelangganvalid">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nma_pelanggan" name="nma_pelanggan" placeholder="Masukan Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Alamat Pelanggan</label>
                        <input type="text" class="form-control" id="alamat_pel" name="alamat_pel" placeholder="Masukan Alamat Pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Masukan Nomor Telepon">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btlpelanggan">Batal</button>
                        <button type="submit" class="btn btn-primary" id="simpan_pel">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="v-standart">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standartv-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-5 float-right mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cari_key" id="cari_key1" autocomplete="off" placeholder="Pencarian" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="vstandartBan">
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="v-jasa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="jasa-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-5 float-right mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cari_key" id="vjasac" placeholder="Jenis Jasa" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="list-tables">
                    </div>
                    <div class="pagelinks"></div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>