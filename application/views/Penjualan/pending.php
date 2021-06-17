 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1><?= $menu; ?></h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item active">Transaksi Penjualan</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>
     <div class="flash-berhasil" data-berhasil="<?= $this->session->flashdata('berhasil'); ?>"></div>
     <div class="flash-gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
     <!-- Main content -->
     <section class="content">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <!-- /.card-header -->
                     <div class="card-body">
                         <div class="form-group">
                             <div class="input-group">

                                 <a href="<?= base_url('Transaksi/Penjualan/') ?>" class="btn btn-primary"> <i class="fas fa-plus"></i>
                                     Tambah Transaksi
                                 </a>

                                 <div class="col-md-4" style="margin-left: 49.1%;">
                                     <div class="input-group">
                                         <input type="text" class="form-control" name="cari_key" id="cari_key" placeholder="Pencarian" />
                                         <div class="input-group-append">
                                             <span class="input-group-text"><i class="fas fa-search"></i></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="table-responsive">
                             <div class="tabelview" data-link="<?= base_url('Transaksi/penjualan/pendingview/'); ?>"></div>
                             <div class="pagelink"></div>
                         </div>
                     </div>
                     <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->
         </div>
         <!-- /.row -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->