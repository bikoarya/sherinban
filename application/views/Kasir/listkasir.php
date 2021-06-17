<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>
                        Cetak Nota
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cetak Nota</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="flash-berhasil" data-berhasil="<?= $this->session->flashdata('berhasil'); ?>"></div>
    <div class="flash-gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="col-md-3 mt-3">
                            <a href="<?= base_url("Transaksi/Kasir") ?>" class="btn btn-primary"> <i class="fas fa-list"></i>
                                Pilih Transaksi
                            </a>
                        </div>

                        <form id="form" class="form-cari form-horizontal">
                            <div class="tglKsr">
                                <div class="input-group" style="width: 400px">
                                    <label class="mt-1 dvc">Tanggal :</label>
                                    <div class="input-group-append ml-1 tgL">
                                        <span class="input-group-text"><i class="far fa-calendar-alt cal"></i></span>
                                    </div>
                                    <div class="cvb">
                                        <input type="text" class="form-control tanggalpicker tglawal" autocomplete="off" name="tglawal" id="reservation" readonly value="<?= date('d-m-Y') ?> - <?= date('d-m-Y') ?>">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary bt"><i class="fas fa-search sch"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="datatable2 table table-bordered" data-link="<?= base_url('Transaksi/Kasir/tampilkasirlist') ?>" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>No. Nota</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nama Mekanik</th>
                                        <th>No. Polisi</th>
                                        <!-- <th>Status</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Cari Penjualan -->