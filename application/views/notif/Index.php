 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Pemberitahuan</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item active">Pemberitahuan</li>
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

                         <div class="table-responsive ">
                             <table class="table table-bordered display responsive nowrap" data-link="<?= base_url('Notif/Notif/datatables') ?>" cellspacing="0" width="100%">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Tanggal</th>
                                         <th>Kode Pelanggan</th>
                                         <th>Nama Pelanggan</th>
                                         <th>No. Handphone</th>
                                         <th>Keterangan</th>
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