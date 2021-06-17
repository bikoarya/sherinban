 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1><?= $subtitle; ?></h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item">Retur Barang</li>
                         <li class="breadcrumb-item active"><?= $subtitle; ?></li>
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
                         <button type="button" class="btn btn-primary mb-1 tambah" data-toggle="modal" data-target="#serverside" data-link="<?= base_url("returpengembalian/tambah") ?>"> <i class="fas fa-plus"></i>
                             Tambah
                         </button>
                         <div class="table-responsive">
                             <table class="table table-bordered display responsive nowrap datatable2" data-link="<?= base_url('returpengembalian/table'); ?>" cellspacing="0" width="100%">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Tanggal Pengembalian</th>
                                         <th>No. Faktur</th>
                                         <th>Nama Supplier</th>
                                         <th>No. Supplier</th>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Spesifikasi</th>
                                         <th>Kode Produksi</th>
                                         <th>Jumlah Retur</th>
                                         <th>Jumlah Pengembalian</th>
                                         <th>Sisa Barang Kembali</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
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


 <div class="modal fade" id="serverside" role="dialog" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-scrollable modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="modal-title"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body datainput"></div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->


 <div class="modal fade" id="searchdatatables" role="dialog" data-title="Pencarian Data Retur" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-scrollable modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="modal-title2"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <table id="datatable3" class="table table-bordered display responsive nowrap " data-link="<?= base_url('returpengembalian/searchnota'); ?>" cellspacing="0" width="100%">
                     <thead>
                         <tr>
                             <th>#</th>
                             <th>Tanggal Retur</th>
                             <th>No Faktur</th>
                             <th>Nama Supplier</th>
                             <th>No. Supplier</th>
                             <th>Kode Barang</th>
                             <th>Nama Barang</th>
                             <th>Spesifikasi</th>
                             <th>Kode Produksi</th>
                             <th>Keterangan Retur</th>
                             <th>Jumlah Retur</th>
                             <th>Jumlah Pengembalian</th>
                             <th>Sisa</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>

             </div>
         </div>
     </div>
 </div>
 <!-- /.modal -->