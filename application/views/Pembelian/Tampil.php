 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Pembelian</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item">Transaksi</li>
                         <li class="breadcrumb-item active">Pembelian</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">

                         <div class="form-group">
                             <div class="input-group">
                                 <a href="<?= base_url('Gudang/Pembelian') ?>" class="btn btn-primary"> <i class="fas fa-plus"></i>
                                     Tambah
                                 </a>
                             </div>
                         </div>

                         <div class="table-responsive">
                             <table class="datatable2 table table-bordered table-striped" data-link="<?= base_url('viewdatapembelian') ?>" width="100%">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Tanggal Pembelian</th>
                                         <th>No Faktur</th>
                                         <th>Kode Supplier</th>
                                         <th>Nama Supplier</th>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Kode Produksi</th>
                                         <th>Pembelian Stok</th>
                                         <th>Penjualan Stok</th>
                                         <th>Stok Terpakai</th>
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