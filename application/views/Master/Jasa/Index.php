 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Jasa</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?php print base_url('Dash') ?>">Dashboard</a></li>
                         <li class="breadcrumb-item">Master</li>
                         <li class="breadcrumb-item active">Jasa</li>
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
                                 <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#form-jasa" id="jasa-tambah"> <i class="fas fa-plus"></i>
                                     Tambah
                                 </button>
                                 <div class="col-md-4" style="margin-left: 56%;">
                                     <div class="input-group">
                                         <input type="text" class="form-control" name="cari_key" id="vjasac" placeholder="Pencarian" />
                                         <div class="input-group-append">
                                             <span class="input-group-text"><i class="fas fa-search"></i></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="tmpJasa">

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


 <div class="modal fade" id="form-jasa" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="jasa-title"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form role="form" id="qjasatambah">
                     <div class="card-body">
                         <div class="form-group">
                             <label for="Jasa">Jenis Jasa</label>
                             <input type="text" name="Jasa" id="Jasa" class="form-control" autocomplete="off" placeholder="Jenis Jasa" autofocus>
                         </div>
                         <div class="form-group">
                             <label for="Jasa">Harga</label>
                             <input type="text" name="harga" id="harga" class="form-control" autocomplete="off" placeholder="Harga Jasa" autofocus>
                         </div>
                         <div class="form-group">
                             <label>Pot 1</label><br>
                             <label> Min. Qty</label>
                             <input type="number" name="qty_1" id="qty_1" class="form-control" autocomplete="off" placeholder="Min. Qty">
                         </div>
                         <div class="form-group">
                             <label>Pot</label>
                             <input type="text" name="pot_1" id="pot_1" class="form-control" autocomplete="off" placeholder="Pot">
                         </div>

                         <div class="form-group">
                             <label>Pot 2</label><br>
                             <label> Min. Qty</label>
                             <input type="number" name="qty_2" id="qty_2" class="form-control" autocomplete="off" placeholder="Min. Qty">
                         </div>
                         <div class="form-group">
                             <label>Pot</label>
                             <input type="text" name="pot_2" id="pot_2" class="form-control" autocomplete="off" placeholder="Pot">
                         </div>
                     </div>
             </div>
             <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="submit" class="btn btn-primary" id="simpanjasa">Simpan</button>
             </div>
             </form>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->



 <div class="modal fade" id="form-jasaedit" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="jasa-title">Ubah Data Jasa</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form role="form" id="qjasaedit">
                     <div class="card-body">
                         <div class="form-group">
                             <input type="hidden" name="edtid_jasa" id="edtid_jasa" class="form-control">
                         </div>
                         <div class="form-group">
                             <label for="Jasa">Jenis Jasa</label>
                             <input type="text" name="edtJasa" id="edtJasa" class="form-control" autocomplete="off" placeholder="Jenis Jasa" autofocus>
                         </div>
                         <div class="form-group">
                             <label for="Jasa">Harga</label>
                             <input type="text" name="edtharga" id="edtharga" class="form-control" autocomplete="off" placeholder="Harga Jasa" autofocus>
                         </div>
                         <div class="form-group">
                             <label>Pot 1</label><br>
                             <label>Min. Qty</label>
                             <input type="text" name="edtqty_1" id="edtqty_1" autocomplete="off" class="form-control" placeholder="Min. Qty">
                         </div>
                         <div class="form-group">
                             <label>Pot</label>
                             <input type="text" name="edtpot" id="edtpot" autocomplete="off" class="form-control" placeholder="Pot">
                         </div>

                         <div class="form-group">
                             <label>Pot 2</label><br>
                             <label>Min. Qty</label>
                             <input type="text" name="edtqty_2" id="edtqty_2" autocomplete="off" class="form-control" placeholder="Min. Qty">
                         </div>
                         <div class="form-group">
                             <label>Pot</label>
                             <input type="text" name="edtpot_2" id="edtpot_2" autocomplete="off" class="form-control" placeholder="Pot">
                         </div>
                     </div>
             </div>
             <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="submit" class="btn btn-primary" id="ubahjasa">Simpan</button>
             </div>
             </form>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->