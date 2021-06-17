 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Nota</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item">Pengaturan</li>
                         <li class="breadcrumb-item active">Nota</li>
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
                         <form role="form" id="notaform">
                             <div class="card-body">
                                 <input type="hidden" id="id_nota">
                                 <div class="form-group">
                                     <label for="nama_perusahaan">Nama Perusahaan</label>
                                     <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" autocomplete="off" placeholder="Nama Perusahaan">
                                 </div>
                                 <div class="form-group">
                                     <label for="alamat">Alamat</label>
                                     <input type="text" name="alamat" class="form-control" id="alamat" autocomplete="off" placeholder="Alamat">
                                 </div>
                                 <div class="form-group">
                                     <label for="no/hp">No telephone</label>
                                     <input type="text" name="no_hp" class="form-control" id="no_hp" autocomplete="off" placeholder="No. Telephone">
                                 </div>
                             </div>
                             <button type="submit" class="btn btn-primary float-right" id="nota_simpan">Simpan</button>
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