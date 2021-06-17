<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $data['satuan'] = $this->m->get('t_satuan');
            $data['katagori'] = $this->m->get('t_katagori');
            $data['title'] = 'SHERIN BAN | Retur Pembelian';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('retur/pembelian/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    public function table()
    {
        $table = 't_retur_pembelian';
        $column_order = [null, 't_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];
        $column_search = ['t_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];

        $order = ['t_retur_pembelian.id_retur_pembelian' => 'desc'];
        $join = [
            't_barang' => 't_barang.kode_barang = t_retur_pembelian.kode_barang',
            't_supplier' => 't_supplier.kode_supplier = t_retur_pembelian.kode_supplier'
        ];
        /**
         * Data Site Datatables
         */
        $list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order)->result_array();
        $data = [];
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $en = $field['id_retur_pembelian'];

            $no++;
            $row = [];
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field['tgl_retur']));
            $row[] = $field['no_faktur'];
            $row[] = $field['nama_supplier'];
            $row[] = $field['telepon'];
            $row[] = $field['kode_barang'];
            $row[] = $field['nama_barang'];
            $row[] = $field['spek'];
            $row[] = $field['kode_produksi_pem'];
            $row[] = $field['jumlah_retur'];
            $row[] = $field['catatan_retur'];
            $row[] = '<a href = "#" class="text-success ubah" data-link="' . base_url('returpembelian/edit/') . $en . '" data-toggle="modal" data-target="#serverside" title="Edit"><i class="fas fa-pencil-alt"></i></a> | <a class="text-danger remove" data-link = "' . base_url('returpembelian/remove/') . $en . '" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all($table),
            "recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order),
            "data" => $data
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function searchnota()
    {
        $table = 't_pembelian';

        $column_order = [null, 't_pembelian.tgl_pembelian', 't_pembelian.no_faktur', 't_pembelian.kode_supplier', 't_supplier.nama_supplier', 't_barang.kode_barang', 't_barang.nama_barang', 't_pembelian.kode_produksi_pem', 'hrg_beli', 'qty', 't_pembelian.hrg_beli', 't_supplier.telepon'];

        $column_search = ['t_pembelian.tgl_pembelian', 't_pembelian.no_faktur', 't_pembelian.kode_supplier', 't_supplier.nama_supplier', 't_barang.kode_barang', 't_barang.nama_barang', 't_pembelian.kode_produksi_pem', 'hrg_beli', 'qty', 't_pembelian.hrg_beli', 't_supplier.telepon'];

        $order = ['t_pembelian.tgl_pembelian' => 'desc'];
        $join = [
            't_barang' => 't_barang.kode_barang = t_pembelian.kode_barang',
            't_supplier' => 't_supplier.kode_supplier = t_pembelian.kode_supplier'
        ];
        /**
         * Data Site Datatables
         */
        $list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order)->result_array();
        $data = [];
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $en = $field['id_pembelian'];
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field['tgl_pembelian']));
            $row[] = $field['no_faktur'];
            $row[] = $field['nama_supplier'];
            $row[] = $field['telepon'];
            $row[] = $field['kode_barang'];
            $row[] = $field['nama_barang'];
            $row[] = $field['hrg_beli'];
            $row[] = $field['kode_produksi_pem'];
            $row[] = '<a href = "#" data-link="' . base_url('returpembelian/copy/') . $en . '" class="text-success pilih" title="Pilih"><i class="far fa-check-circle"></i></a> ';
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all($table),
            "recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order),
            "data" => $data
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function pindahtext($id = null)
    {
        if (!isset($_GET[$id])) {
            # code...
            $this->db->where('id_pembelian', $id);
            $pembelian = $this->db->get('t_pembelian')->row_array();
            $input = [
                'nofaktur'             => $pembelian['no_faktur'],
                'kode_supplier'        => $pembelian['kode_supplier'],
                'kodebarang'           => $pembelian['kode_barang'],
                'kode_produksi_pem'    => $pembelian['kode_produksi_pem'],
            ];
            $data = [
                'code'      => '200',
                'messsage'  => 'success',
                'data'      => $input,
            ];
        } else {
            # code...
            $input = [
                'nofaktur'      => '',
                'kode_supplier' => '',
                'kodebarang'    => '',
                'kode_produksi_pem' => ''
            ];
            $data = [
                'code'      => '500',
                'messsage'  => 'your data does not match the submitted type',
                'data'      => $input,
            ];
        }

        try {
            $json = $data;
        } catch (Exception $e) {
            $json = $e->getMessage();
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function viewtambah()
    {
        $supplier = $this->m->get('t_supplier');
        $select = [];
        $outselect = [];
        foreach ($supplier as $data) {
            $row = [];
            $row[] = '<option value="' . $data['kode_supplier'] . '">' . $data['nama_supplier'] . '</option>';
            $select[] = $row;
        }
        if (count($select) != null) {
            # code...
            for ($i = 0; $i < count($select); $i++) {
                # code...
                $select1 = [];
                $select1 = $select[$i][0];
                $outselect[] = $select1;
            }
        }

        $title = "Tambah Data";
        $datainput = '<form id="form" role="form">
        <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal_retur">Tanggal Retur</label>
                            <input type="date" name="tanggal_retur" class="form-control" id="tambah-tanggalretur" autocomplete="off" placeholder="Tanggal Retur" value="' . date('Y-m-d') . '">
                            <div id="error"></div>
                        </div>
                        <label for="no_faktur" class="mb-1">No Faktur</label>
                        <div class="input-group">
                            <input type="text" name="no_faktur" 
                            class="form-control" 
                            id="tambah-nofaktur" autocomplete="off" placeholder="No Faktur">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary searchdatatables" data-link ="' . base_url('retur/pembelian/searchnota') . '" style="min-height:38px"><i class="fas fa-search"></i></button>
                            </span>
                            <div id="error"></div>
                        </div>
                        <div class="form-group">
                             <label for="kode_supplier">Supplier</label>
                             <select name="kode_supplier" id="tambah-kode_supplier" class="form-control">
                                <option value="">PILIH</option>' . implode($outselect) . '
                             </select>
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_barang">Kode Barang</label>
                             <input type="text" name="kode_barang" class="form-control" id="tambah-kodebarang" autocomplete="off" placeholder="Kode Barang">
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_produksi_pem">Kode Produksi</label>
                             <input type="text" name="kode_produksi_pem" class="form-control" id="tambah-kode_produksi_pem" autocomplete="off" placeholder="Kode Barang">
                             <div id="error"></div>
                         </div>

                         <div class="form-group">
                         <label for="jumlah_retur">Jumlah Retur</label>
                         <input type="number" name="jumlah_retur" class="form-control" id="tambah-jumlahretur" min="1" autocomplete="off" placeholder="Jumlah Retur" value="1">
                         <div id="error"></div>
                     </div>

                        <div class="form-group">
                             <label for="ket_retur">Keterangan Retur</label>
                             <textarea name="ket_retur" class="form-control" id="tambah-ketretur" placeholder="Keterangan Retur"></textarea>
                             <div id="error"></div>
                         </div>

                     </div>
                     <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="submit" class="btn btn-primary simpan" data-link="' . base_url("returpembelian/store") . '"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
             </div>
        </form>';

        $dataoutput = [
            'title' => $title,
            'datainput' => $datainput
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($dataoutput));
    }


    public function edit($id = null)
    {
        if (!isset($_GET[$id])) {
            $this->db->where('id_retur_pembelian', $id);
            $editdata = $this->db->get('t_retur_pembelian')->row_array();
            $supplier = $this->m->get('t_supplier');
            $select = [];
            $outselect = [];
            foreach ($supplier as $data) {
                $row = [];
                if ($editdata['kode_supplier'] == $data['kode_supplier']) {
                    # code...
                    $row[] = '<option value="' . $data['kode_supplier'] . '" selected>' . $data['nama_supplier'] . '</option>';
                } else {
                    $row[] = '<option value="' . $data['kode_supplier'] . '">' . $data['nama_supplier'] . '</option>';
                }
                $select[] = $row;
            }
            if (count($select) != null) {
                # code...
                for ($i = 0; $i < count($select); $i++) {
                    # code...
                    $select1 = [];
                    $select1 = $select[$i][0];
                    $outselect[] = $select1;
                }
            }

            $title = "Edit Data";
            $datainput = '<form id="form" role="form">
        <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal_retur">Tanggal Retur</label>
                            <input type="date" name="tanggal_retur" class="form-control" id="tambah-tanggalretur" autocomplete="off" placeholder="Tanggal Retur" value="' . date('Y-m-d', strtotime($editdata['tgl_retur'])) . '">
                            <div id="error"></div>
                        </div>
                        <label for="no_faktur" class="mb-1">No Faktur</label>
                        <div class="input-group">
                            <input type="text" name="no_faktur" 
                            class="form-control" 
                            id="tambah-nofaktur" autocomplete="off" placeholder="No Faktur" value="' . $editdata['no_faktur'] . '">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary searchdatatables" data-link ="' . base_url('retur/pembelian/searchnota') . '" style="min-height:38px"><i class="fas fa-search"></i></button>
                            </span>
                            <div id="error"></div>
                        </div>
                        <div class="form-group">
                             <label for="kode_supplier">Supplier</label>
                             <select name="kode_supplier" id="tambah-kode_supplier" class="form-control">
                                <option value="">PILIH</option>' . implode($outselect) . '
                             </select>
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_barang">Kode Barang</label>
                             <input type="text" name="kode_barang" class="form-control" id="tambah-kodebarang" autocomplete="off" placeholder="Kode Barang" value="' . $editdata['kode_barang'] . '">
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_produksi_pem">Kode Produksi</label>
                             <input type="text" name="kode_produksi_pem" class="form-control" id="tambah-kode_produksi_pem" autocomplete="off" placeholder="Kode Barang" value="' . $editdata['kode_produksi_pem'] . '">
                             <div id="error"></div>
                         </div>

                         <div class="form-group">
                         <label for="jumlah_retur">Jumlah Retur</label>
                         <input type="number" name="jumlah_retur" class="form-control" id="tambah-jumlahretur" min="1" autocomplete="off" placeholder="Jumlah Retur" value="' . $editdata['jumlah_retur'] . '">
                         <div id="error"></div>
                     </div>

                        <div class="form-group">
                             <label for="ket_retur">Keterangan Retur</label>
                             <textarea name="ket_retur" class="form-control" id="tambah-ketretur" placeholder="Keterangan Retur">' . $editdata['catatan_retur'] . '</textarea>
                             <div id="error"></div>
                         </div>

                     </div>
                     <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="button" class="btn btn-primary simpan" data-link="' . base_url("returpengembalian/update/" . $editdata['id_retur_pembelian']) . '"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
             </div>
        </form>';
            $dataoutput = [
                'title' => $title,
                'code'      => '200',
                'messsage'  => 'success',
                'datainput' => $datainput
            ];
        } else {
            $title = "Edit Data";
            $dataoutput = [
                'title' => $title,
                'code'      => '500',
                'messsage'  => 'your data does not match the submitted type',
                'datainput' => ''
            ];
        }

        try {
            $json = $dataoutput;
        } catch (Exception $e) {
            $json = $e->getMessage();
        }


        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function store()
    {
        $json = [];
        $no_faktur = htmlspecialchars($this->input->post("no_faktur"));
        $tanggal_retur = date("Y-m-d", strtotime($this->input->post("tanggal_retur")));
        $kode_barang = htmlspecialchars($this->input->post("kode_barang"));
        $kode_produksi_pem = htmlspecialchars($this->input->post("kode_produksi_pem"));
        $ket_retur = htmlspecialchars($this->input->post("ket_retur"));
        $jumlah_retur = htmlspecialchars($this->input->post("jumlah_retur"));
        $kodesupplier = htmlspecialchars($this->input->post("kode_supplier"));

        $this->form_validation->set_rules('no_faktur', 'No Faktur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('tanggal_retur', 'Tanggal', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_produksi_pem', 'Kode Produksi', 'required|numeric', [
            'required' => '%s Tidak Boleh Kosong',
            'numeric'  => '%s Harus Angka'
        ]);
        $this->form_validation->set_rules('ket_retur', 'Keterangan Retur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('jumlah_retur', 'Jumlah Retur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_supplier', 'Supplier', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            # code...
            $error = validation_errors();
            $nofaktur = form_error('no_faktur', '<div class="text-danger">', '</div>');
            $tanggalretur = form_error('tanggal_retur', '<div class="text-danger">', '</div>');
            $kodebarang = form_error('kode_barang', '<div class="text-danger">', '</div>');
            $kodeproduksi_pem = form_error('kode_produksi_pem', '<div class="text-danger">', '</div>');
            $ketretur = form_error('ket_retur', '<div class="text-danger">', '</div>');
            $jumlahretur = form_error('jumlah_retur', '<div class="text-danger">', '</div>');
            $kode_supplier = form_error('kode_supplier', '<div class="text-danger">', '</div>');

            $json = [
                'error'    => $error,
                'nofaktur' => $nofaktur,
                'tanggalretur' => $tanggalretur,
                'kodebarang' => $kodebarang,
                'kode_produksi_pem'  => $kodeproduksi_pem,
                'ketretur' => $ketretur,
                'jumlahretur' => $jumlahretur,
                'kode_supplier' => $kode_supplier
            ];
        } else {
            # code...
            $data = [
                'no_faktur'   => $no_faktur,
                'tgl_retur'     => $tanggal_retur,
                'kode_barang' => $kode_barang,
                'catatan_retur'  => $ket_retur,
                'jumlah_retur'      => $jumlah_retur,
                'kode_produksi_pem' => $kode_produksi_pem,
                'kode_supplier'     => $kodesupplier
            ];
            $this->m->insert('t_retur_pembelian', $data);
            $json = [
                'berhasil' => 'berhasil',
                'nofaktur',
                'tanggalretur',
                'kodebarang',
                'hargaretur',
                'ketretur',
                'jumlahretur',
                'kode_supplier'
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }


    public function up($id = null)
    {
        $json = [];
        $no_faktur = htmlspecialchars($this->input->post("no_faktur"));
        $tanggal_retur = date("Y-m-d", strtotime($this->input->post("tanggal_retur")));
        $kode_barang = htmlspecialchars($this->input->post("kode_barang"));
        $kode_produksi_pem = htmlspecialchars($this->input->post("kode_produksi_pem"));
        $ket_retur = htmlspecialchars($this->input->post("ket_retur"));
        $jumlah_retur = htmlspecialchars($this->input->post("jumlah_retur"));
        $kodesupplier = htmlspecialchars($this->input->post("kode_supplier"));

        $this->form_validation->set_rules('no_faktur', 'No Faktur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('tanggal_retur', 'Tanggal', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_produksi_pem', 'Kode Produksi', 'required|numeric', [
            'required' => '%s Tidak Boleh Kosong',
            'numeric'  => '%s Harus Angka'
        ]);
        $this->form_validation->set_rules('ket_retur', 'Keterangan Retur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('jumlah_retur', 'Jumlah Retur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_supplier', 'Supplier', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            # code...
            $error = validation_errors();
            $nofaktur = form_error('no_faktur', '<div class="text-danger">', '</div>');
            $tanggalretur = form_error('tanggal_retur', '<div class="text-danger">', '</div>');
            $kodebarang = form_error('kode_barang', '<div class="text-danger">', '</div>');
            $kodeproduksi_pem = form_error('kode_produksi_pem', '<div class="text-danger">', '</div>');
            $ketretur = form_error('ket_retur', '<div class="text-danger">', '</div>');
            $jumlahretur = form_error('jumlah_retur', '<div class="text-danger">', '</div>');
            $kode_supplier = form_error('kode_supplier', '<div class="text-danger">', '</div>');

            $json = [
                'error'    => $error,
                'nofaktur' => $nofaktur,
                'tanggalretur' => $tanggalretur,
                'kodebarang' => $kodebarang,
                'kode_produksi_pem'  => $kodeproduksi_pem,
                'ketretur' => $ketretur,
                'jumlahretur' => $jumlahretur,
                'kode_supplier' => $kode_supplier
            ];
        } else {
            # code...
            $data = [
                'no_faktur'   => $no_faktur,
                'tgl_retur'     => $tanggal_retur,
                'kode_barang' => $kode_barang,
                'catatan_retur'  => $ket_retur,
                'jumlah_retur'      => $jumlah_retur,
                'kode_produksi_pem' => $kode_produksi_pem,
                'kode_supplier'     => $kodesupplier
            ];
            $where = [
                'id_retur_pembelian' => $id
            ];
            $this->m->put('t_retur_pembelian', $data, $where);
            $json = [
                'berhasil' => 'berhasil',
                'nofaktur',
                'tanggalretur',
                'kodebarang',
                'hargaretur',
                'ketretur',
                'jumlahretur',
                'kode_supplier'
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function hapus($id = null)
    {
        $json = [];
        $where = [
            'id_retur_pembelian' => $id
        ];
        $this->m->delete('t_retur_pembelian', $where);
        $json = [
            'berhasil' => 'berhasil'
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function laporanpembelian()
    {
        $data['title'] = 'SHERIN BAN | Laporan Retur Pembelian';
        $data['subtitle'] = 'Laporan Retur Pembelian';
        $this->load->view('Templates/Meta', $data);
        $this->load->view('Templates/Navbar');
        $this->load->view('Templates/Menu', $data);
        $this->load->view('retur/pembelian/Laporan', $data);
        $this->load->view('Templates/Footer');
        $this->load->view('Templates/Js');
    }

    public function lap_get_data()
    {
        $tgl = $this->input->post('tgllap');
        $keyword = $this->input->post('kategori');
        $keys = $this->input->post('pencarian');


        $table = 't_retur_pembelian';
        $column_order = [null, 't_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];
        $column_search = ['t_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];

        $order = ['t_retur_pembelian.id_retur_pembelian' => 'desc'];
        $join = [
            't_barang' => 't_barang.kode_barang = t_retur_pembelian.kode_barang',
            't_supplier' => 't_supplier.kode_supplier = t_retur_pembelian.kode_supplier'
        ];
        /**
         * Data Site Datatables
         */
        if ($tgl != null  &&  $keyword != null) {
            $tglpecah = explode(" - ", $tgl);
            $start = $tglpecah[0];
            $end = $tglpecah[1];
            $kalStart = implode("", array($start));
            $kalEnd = implode("", array($end));
            $awal = date('Y-m-d', strtotime($kalStart));
            $akhir = date('Y-m-d', strtotime($kalEnd));
            $where = [
                'tgl_retur >=' => $awal,
                'tgl_retur <=' => $akhir,
            ];
            $where1 = $keyword;
            $where2 = $keys;
        } elseif ($tgl) {
            $tglpecah = explode(" - ", $tgl);
            $start = $tglpecah[0];
            $end = $tglpecah[1];
            $kalStart = implode("", array($start));
            $kalEnd = implode("", array($end));
            $awal = date('Y-m-d', strtotime($kalStart));
            $akhir = date('Y-m-d', strtotime($kalEnd));
            $where = [
                'tgl_retur >=' => $awal,
                'tgl_retur <=' => $akhir
            ];
            $where1 = '';
            $where2 = '';
        } elseif ($keyword) {
            # code...
            $where = '';
            $where1 = $keyword;
            $where2 = $keys;
        } else {
            $where  = '';
            $where1 = '';
            $where2 = '';
        }

        $list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2)->result_array();
        $data = [];
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field['tgl_retur']));
            $row[] = $field['no_faktur'];
            $row[] = $field['nama_supplier'];
            $row[] = $field['telepon'];
            $row[] = $field['kode_barang'];
            $row[] = $field['nama_barang'];
            $row[] = $field['spek'];
            $row[] = $field['kode_produksi_pem'];
            $row[] = $field['jumlah_retur'];
            $row[] = $field['catatan_retur'];
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all($table),
            "recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order),
            "data" => $data
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function cetakdata()
    {
        $tgl = $this->input->post('tglPem');
        $keys = $this->input->post('keys');
        $keyword = $this->input->post('textpencarian');

        if ($tgl != null && $keyword != null) {
            $tglpecah = explode(" - ", $tgl);
            $start = $tglpecah[0];
            $end = $tglpecah[1];
            $awal = date('Y-m-d', strtotime($start));
            $akhir = date('Y-m-d', strtotime($end));
            $this->db->where(['tgl_retur >=' => $awal]);
            $this->db->where(['tgl_retur <=' => $akhir]);
            $pecahhuruf = str_replace(" ", "%", $keyword);
            $hasildata = $keys;
            $this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);

            $data['awal'] = date('d-m-Y', strtotime($awal));
            $data['akhir'] = date('d-m-Y', strtotime($akhir));
            $data['keyword'] = $keyword;
            if ($keys == 'no_faktur') {
                $data['keys'] = 'No Faktur';
            } elseif ($keys == 'nama_barang') {
                # code...
                $data['keys'] = 'Nama Barang';
            } elseif ($keys == 'spek') {
                # code...
                $data['keys'] = 'Spesifikasi';
            } elseif ($keys == 'kode_produksi_pem') {
                # code...
                $data['keys'] = 'Kode Produksi';
            }
        } elseif ($tgl) {
            $tglpecah = explode(" - ", $tgl);
            $start = $tglpecah[0];
            $end = $tglpecah[1];
            $awal = date('Y-m-d', strtotime($start));
            $akhir = date('Y-m-d', strtotime($end));
            $this->db->where(['tgl_retur >=' => $awal]);
            $this->db->where(['tgl_retur <=' => $akhir]);

            $data['awal'] = date('d-m-Y', strtotime($awal));
            $data['akhir'] = date('d-m-Y', strtotime($akhir));
            $data['keyword'] = '';
        } elseif ($keyword) {
            $pecahhuruf = str_replace(" ", "%", $keyword);
            $hasildata = $keys;
            $this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
            $data['awal'] = '';
            $data['akhir'] = '';
            $data['keyword'] = $keyword;

            if ($keys == 'no_faktur') {
                $data['keys'] = 'No Faktur';
            } elseif ($keys == 'nama_barang') {
                # code...
                $data['keys'] = 'Nama Barang';
            } elseif ($keys == 'spek') {
                # code...
                $data['keys'] = 'Spesifikasi';
            } elseif ($keys == 'kode_produksi_pem') {
                # code...
                $data['keys'] = 'Kode Produksi';
            }
        } else {
            $data['awal'] = '';
            $data['akhir'] = '';
            $data['keyword'] = '';
            $data['keys'] = '';
        }
        $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $data['title'] = "Laporan Retur Pembelian";

        $this->db->join('t_barang', 't_barang.kode_barang = t_retur_pembelian.kode_barang');
        $this->db->join('t_supplier', 't_supplier.kode_supplier = t_retur_pembelian.kode_supplier');
        $this->db->order_by('t_retur_pembelian.id_retur_pembelian', "DESC");

        $data['cetakdata'] = $this->db->get('t_retur_pembelian')->result_array();
        $html = $this->load->view('retur/pembelian/Cetak', $data, true);
        $pdf->WriteHTML($html);
        $pdf->Output();
    }
}
