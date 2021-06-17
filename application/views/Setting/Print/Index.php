 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>API Print</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item">Pengaturan</li>
                         <li class="breadcrumb-item active">Print</li>
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
                         <form role="form" id="cetakform">
                             <div class="card-body">
                                 <input type="hidden" id="id_cetak">
                                 <div class="form-group">
                                     <label for="apikey">API KEY</label>
                                     <input type="text" name="apikey" class="form-control" id="apikey" autocomplete="off" placeholder="API KEY">
                                 </div>
                                 <div class="form-group">
                                     <label for="port">Port</label>
                                     <input type="text" name="port" class="form-control" id="port" autocomplete="off" placeholder="PORT">
                                 </div>
                             </div>
                             <button type="submit" class="btn btn-primary float-right" id="cetak_simpan">Simpan</button>
                         </form>
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