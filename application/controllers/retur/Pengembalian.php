<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
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
            $data['title'] = 'SHERIN BAN | Retur Pengembalian';
            $data['subtitle'] = 'Retur Pengembalian';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('retur/pengembalian/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    public function table()
    {
        $table = 'v_sisa_retur';
        $column_order = [null, 'v_sisa_retur.no_notapembelian', 'v_sisa_retur.kode_barang', 't_barang.nama_barang', 'v_sisa_retur.kode_produksi', 'jumlah_brg_retur', 'jumlah_brg_kembali', 'v_sisa_retur.Sisa', 't_barang.spek', 't_supplier.nama_supplier', 't_supplier.telepon'];
        $column_search = ['v_sisa_retur.no_notapembelian', 'v_sisa_retur.kode_barang', 't_barang.nama_barang', 'v_sisa_retur.kode_produksi', 'jumlah_brg_retur', 'jumlah_brg_kembali', 'v_sisa_retur.Sisa', 't_barang.spek', 't_supplier.nama_supplier', 't_supplier.telepon'];

        $order = ['v_sisa_retur.id_retur' => 'desc'];
        $join = [
            't_barang' => 't_barang.kode_barang = v_sisa_retur.kode_barang',
            't_supplier' => 't_supplier.kode_supplier = v_sisa_retur.kode_supplier'
        ];
        /**
         * Data Site Datatables
         */
        $list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order)->result_array();
        $data = [];
        $no   = $_POST['start'];
        foreach ($list as $field) {
            $en = $field['id_retur'];

            $no++;
            $row = [];
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field['tgl_pengembalian']));
            $row[] = $field['no_notapembelian'];
            $row[] = $field['nama_supplier'];
            $row[] = $field['telepon'];
            $row[] = $field['kode_barang'];
            $row[] = $field['nama_barang'];
            $row[] = $field['spek'];
            $row[] = $field['kode_produksi'];
            $row[] = $field['jumlah_brg_retur'];
            $row[] = $field['jumlah_brg_kembali'];
            $row[] = $field['Sisa'];
            $row[] = '<a class="text-danger remove" data-link = "' . base_url('returpengembalian/remove/') . $en . '" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;

            // <a href = "#" class="text-success ubah" data-link="' . base_url('returpengembalian/edit/') . $en . '" data-toggle="modal" data-target="#serverside" title="Edit"><i class="fas fa-pencil-alt"></i></a> |
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
        $select = '*, SUM(t_retur_pengembalian.jumlah_pembelian) AS jmlhkembali';
        $table = 't_retur_pengembalian';
        $column_order = [null, 't_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];
        $column_search = ['t_barang.kode_barang', 't_barang.nama_barang', 't_retur_pembelian.tgl_retur', 't_retur_pembelian.kode_barang', 't_retur_pembelian.kode_produksi_pem', 't_retur_pembelian.jumlah_retur', 't_retur_pembelian.catatan_retur', 't_retur_pembelian.no_faktur', 't_barang.spek'];
        $order = ['t_retur_pengembalian.id_retur_pembelian' => 'desc'];

        $this->db->join('t_retur_pembelian', 't_retur_pembelian.id_retur_pembelian = t_retur_pengembalian.id_retur_pembelian', 'right');
        $this->db->join('t_barang', 't_barang.kode_barang = t_retur_pembelian.kode_barang');
        $this->db->join('t_supplier', 't_supplier.kode_supplier = t_retur_pembelian.kode_supplier');

        $this->db->group_by('t_retur_pengembalian.id_retur_pembelian');
        /**
         * Data Site Datatables
         */
        $list = $this->m->get_datatables($select, $table, null, $column_order, $column_search, $order)->result_array();
        $data = [];
        $no   = $_POST['start'];
        $subsisa = null;
        $jmlhkembali = null;
        foreach ($list as $field) {
            $en = $field['id_retur_pembelian'];
            $subsisa = $field['jumlah_retur'] - $field['jmlhkembali'];
            if ($field['jmlhkembali'] == 0) {
                $jmlhkembali =  '-';
                $subsisabarang = $subsisa;
            } else {
                $jmlhkembali = $field['jmlhkembali'];
                $subsisabarang = $subsisa;
                # code...
            }
            if ($subsisa != null) {
                # code...
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
                $row[] = $field['catatan_retur'];
                $row[] = $field['jumlah_retur'];
                $row[] = $jmlhkembali;
                $row[] = $subsisabarang;
                $row[] = '<a href = "#" data-link="' . base_url('returpengembalian/copy/') . $en . '" class="text-success pilih" title="Pilih"><i class="far fa-check-circle"></i></a> ';
                $data[] = $row;
            }
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all($table),
            "recordsFiltered" => $this->m->count_filtered($select, $table, null, $column_order, $column_search, $order),
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
            $this->db->join('t_retur_pembelian', 't_retur_pengembalian.id_retur_pembelian = t_retur_pembelian.id_retur_pembelian', 'right');
            $this->db->where('t_retur_pembelian.id_retur_pembelian', $id);
            $datapembelian = $this->db->get('t_retur_pengembalian')->row_array();
            $input = [
                'id_retur_pembelian'    => $datapembelian['id_retur_pembelian'],
                'no_faktur'             => $datapembelian['no_faktur'],
                'kode_supplier'         => $datapembelian['kode_supplier'],
                'kode_barang'           => $datapembelian['kode_barang'],
                'kode_produksi_pem'     => $datapembelian['kode_produksi_pem'],
                'jmlhpengembalian'      => $datapembelian['jumlah_retur'] - $datapembelian['jumlah_pembelian'],
                'pembatasjumlah'      => $datapembelian['jumlah_retur'] - $datapembelian['jumlah_pembelian']
            ];
            $data = [
                'code'      => '200',
                'messsage'  => 'success',
                'data'      => $input,
            ];
        } else {
            # code...
            $input = [
                'id_retur_pembelian'    => '',
                'no_faktur'             => '',
                'kode_supplier'         => '',
                'kode_barang'           => '',
                'kode_produksi_pem'     => '',
                'jmlhpengembalian'      => ''
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
            $row[] = '<option value="' . $data['kode_supplier'] . '">' . $data['nama_supplier'] . ' - ' . $data['telepon'] . '</option>';
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
                            <label for="tggl_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tggl_pengembalian" class="form-control" id="tambah-tggl_pengembalian" autocomplete="off" value="' . date('Y-m-d') . '" readonly>
                            <div id="error"></div>
                        </div>

                        <input type="hidden" name="id_retur_pembelian" id="tambah-id_retur_pembelian" placeholder="id_retur_pembelian">

                        <label for="no_faktur" class="mb-1">No Faktur</label>
                        <div class="input-group">
                            <input type="text" name="no_faktur" id="tambah-no_faktur"
                            class="form-control" 
                            id="tambah-nofaktur" autocomplete="off" placeholder="No Faktur">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary searchdatatables" data-link ="' . base_url('returpengembalian/searchnota') . '" style="min-height:38px"><i class="fas fa-search"></i></button>
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
                             <input type="text" name="kode_barang" class="form-control" id="tambah-kode_barang" autocomplete="off" placeholder="Kode Barang">
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_produksi_pem">Kode Produksi</label>
                             <input type="text" name="kode_produksi_pem" class="form-control" id="tambah-kode_produksi_pem" autocomplete="off" placeholder="Kode Produksi">
                             <div id="error"></div>
                         </div>

                         <div class="form-group">
                         <label for="jmlhpengembalian">Jumlah Pengembalian</label>
                         <input type="number" name="jmlhpengembalian" class="form-control" id="tambah-jmlhpengembalian" min="0" autocomplete="off" placeholder="Jumlah Pengembalian">
                         <input type="hidden" name="pembatasjumlah" id="tambah-pembatasjumlah">
                         <div id="error"></div>
                     </div>

                     </div>
                     <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="submit" class="btn btn-primary simpan" data-link="' . base_url("returpengembalian/store") . '"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
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
            // $this->db->join('t_retur_pembelian', 't_retur_pengembalian.id_retur_pembelian = t_retur_pembelian.id_retur_pembelian', 'right');
            $this->db->where('id_retur', $id);
            $editdata = $this->db->get('v_sisa_retur')->row_array();

            // $this->db->where('id_retur_pembelian', $id);
            // $editdata = $this->db->get('t_retur_pembelian')->row_array();
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
                            <label for="tggl_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tggl_pengembalian" class="form-control" id="tambah-tggl_pengembalian" autocomplete="off" value="' . date('Y-m-d') . '" readonly>
                            <div id="error"></div>
                        </div>

                        <input type="hidden" name="id_retur_pembelian" id="tambah-id_retur_pembelian" placeholder="id_retur_pembelian">

                        <label for="no_faktur" class="mb-1">No Faktur</label>
                        <div class="input-group">
                            <input type="text" name="no_faktur" id="tambah-no_faktur"
                            class="form-control" 
                            id="tambah-nofaktur" autocomplete="off" placeholder="No Faktur" value="' . $editdata['no_notapembelian'] . '">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary searchdatatables" data-link ="' . base_url('returpengembalian/searchnota') . '" style="min-height:38px"><i class="fas fa-search"></i></button>
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
                             <input type="text" name="kode_barang" class="form-control" id="tambah-kode_barang" value="' . $editdata['kode_barang'] . '" autocomplete="off" placeholder="Kode Barang">
                             <div id="error"></div>
                         </div>
                         <div class="form-group">
                             <label for="kode_produksi_pem">Kode Produksi</label>
                             <input type="text" name="kode_produksi_pem" class="form-control" id="tambah-kode_produksi_pem" autocomplete="off" value="' . $editdata['kode_produksi'] . '" placeholder="Kode Barang">
                             <div id="error"></div>
                         </div>

                         <div class="form-group">
                         <label for="jmlhpengembalian">Jumlah Pengembalian</label>
                         <input type="number" name="jmlhpengembalian" class="form-control" id="tambah-jmlhpengembalian" min="0" autocomplete="off" value="' . $editdata['jumlah_brg_kembali'] . '" placeholder="Jumlah Pengembalian">
                         <div id="error"></div>
                     </div>

                     </div>
                     <div class="modal-footer justify-content-between tombol">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 <button type="button" class="btn btn-primary simpan" data-link="' . base_url("returpembelian/update/" . $editdata['id_retur']) . '"><i class="fa fa-spinner fa-spin loading" style="display:none"></i> Simpan</button>
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
        $tggl_pengembalian = date("Y-m-d", strtotime($this->input->post("tggl_pengembalian")));
        $kode_barang = htmlspecialchars($this->input->post("kode_barang"));
        $kode_produksi_pem = htmlspecialchars($this->input->post("kode_produksi_pem"));
        $jmlhpengembalian = htmlspecialchars($this->input->post("jmlhpengembalian"));
        $kode_supplier = htmlspecialchars($this->input->post("kode_supplier"));
        $id_retur_pembelian = htmlspecialchars($this->input->post("id_retur_pembelian"));
        $pembatasjumlah = htmlspecialchars($this->input->post('pembatasjumlah'), true);

        if ($pembatasjumlah < $jmlhpengembalian) {
            $error = validation_errors();
            $json = [
                'error'               => '101',
                'jmlhpengembalian'   => '<p class="text-danger">Jumlah Pengembalian Lebih dari ' . $pembatasjumlah . '</p>'
            ];
        } else {
            $this->form_validation->set_rules('no_faktur', 'No Faktur', 'required', [
                'required' => '%s Tidak Boleh Kosong'
            ]);
            $this->form_validation->set_rules('tggl_pengembalian', 'Tanggal', 'required', [
                'required' => '%s Tidak Boleh Kosong'
            ]);
            $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', [
                'required' => '%s Tidak Boleh Kosong'
            ]);
            $this->form_validation->set_rules('kode_produksi_pem', 'Kode Produksi', 'required|numeric', [
                'required' => '%s Tidak Boleh Kosong',
                'numeric'  => '%s Harus Angka'
            ]);
            $this->form_validation->set_rules('jmlhpengembalian', 'Jumlah Retur', 'required|numeric', [
                'required' => '%s Tidak Boleh Kosong',
                'numeric'  => '%s Harus angka'
            ]);
            $this->form_validation->set_rules('kode_supplier', 'Supplier', 'required', [
                'required' => '%s Tidak Boleh Kosong'
            ]);

            if ($this->form_validation->run() == FALSE) {
                # code...
                $error = validation_errors();
                $no_faktur = form_error('no_faktur', '<div class="text-danger">', '</div>');
                $tggl_pengembalian = form_error('tggl_pengembalian', '<div class="text-danger">', '</div>');
                $kode_barang = form_error('kode_barang', '<div class="text-danger">', '</div>');
                $kode_produksi_pem = form_error('kode_produksi_pem', '<div class="text-danger">', '</div>');
                $jmlhpengembalian = form_error('jmlhpengembalian', '<div class="text-danger">', '</div>');
                $kode_supplier = form_error('kode_supplier', '<div class="text-danger">', '</div>');

                $json = [
                    'error'                     => $error,
                    'no_faktur'                 => $no_faktur,
                    'tggl_pengembalian'         => $tggl_pengembalian,
                    'kode_barang'               => $kode_barang,
                    'kode_produksi_pem'         => $kode_produksi_pem,
                    'jmlhpengembalian'          => $jmlhpengembalian,
                    'kode_supplier'             => $kode_supplier
                ];
            } else {
                # code...
                $data = [
                    'no_notapembelian'          => $no_faktur,
                    'tgl_pengembalian'          => $tggl_pengembalian,
                    'kode_barang'               => $kode_barang,
                    'jumlah_pembelian'          => $jmlhpengembalian,
                    'kode_produksi'             => $kode_produksi_pem,
                    'kode_supplier'             => $kode_supplier,
                    'id_retur_pembelian'        => $id_retur_pembelian
                ];
                $this->m->insert('t_retur_pengembalian', $data);
                $json = [
                    'berhasil' => 'berhasil',
                    'no_faktur',
                    'tggl_pengembalian',
                    'kode_barang',
                    'kode_produksi_pem',
                    'jmlhpengembalian',
                    'kode_supplier'
                ];
            }
        }



        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }


    public function up($id = null)
    {
        $json = [];
        $no_faktur = htmlspecialchars($this->input->post("no_faktur"));
        $tggl_pengembalian = date("Y-m-d", strtotime($this->input->post("tggl_pengembalian")));
        $kode_barang = htmlspecialchars($this->input->post("kode_barang"));
        $kode_produksi_pem = htmlspecialchars($this->input->post("kode_produksi_pem"));
        $jmlhpengembalian = htmlspecialchars($this->input->post("jmlhpengembalian"));
        $kode_supplier = htmlspecialchars($this->input->post("kode_supplier"));
        $id_retur_pembelian = htmlspecialchars($this->input->post("id_retur_pembelian"));
        $pembatasjumlah = htmlspecialchars($this->input->post('pembatasjumlah'), true);

        $this->form_validation->set_rules('no_faktur', 'No Faktur', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('tggl_pengembalian', 'Tanggal', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('kode_produksi_pem', 'Kode Produksi', 'required|numeric', [
            'required' => '%s Tidak Boleh Kosong',
            'numeric'  => '%s Harus Angka'
        ]);
        $this->form_validation->set_rules('jmlhpengembalian', 'Jumlah Retur', 'required|numeric', [
            'required' => '%s Tidak Boleh Kosong',
            'numeric'  => '%s Harus angka'
        ]);
        $this->form_validation->set_rules('kode_supplier', 'Supplier', 'required', [
            'required' => '%s Tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            # code...
            $error = validation_errors();
            $no_faktur = form_error('no_faktur', '<div class="text-danger">', '</div>');
            $tggl_pengembalian = form_error('tggl_pengembalian', '<div class="text-danger">', '</div>');
            $kode_barang = form_error('kode_barang', '<div class="text-danger">', '</div>');
            $kode_produksi_pem = form_error('kode_produksi_pem', '<div class="text-danger">', '</div>');
            $jmlhpengembalian = form_error('jmlhpengembalian', '<div class="text-danger">', '</div>');
            $kode_supplier = form_error('kode_supplier', '<div class="text-danger">', '</div>');

            $json = [
                'error'                     => $error,
                'no_faktur'                 => $no_faktur,
                'tggl_pengembalian'         => $tggl_pengembalian,
                'kode_barang'               => $kode_barang,
                'kode_produksi_pem'         => $kode_produksi_pem,
                'jmlhpengembalian'          => $jmlhpengembalian,
                'kode_supplier'             => $kode_supplier
            ];
        } else {
            # code...
            $data = [
                'no_notapembelian'          => $no_faktur,
                'tgl_pengembalian'          => $tggl_pengembalian,
                'kode_barang'               => $kode_barang,
                'jumlah_pembelian'          => $jmlhpengembalian,
                'kode_produksi'             => $kode_produksi_pem,
                'kode_supplier'             => $kode_supplier
            ];
            $where = [
                'id_retur_pembelian' => $id
            ];
            $this->m->put('t_retur_pengembalian', $data, $where);
            $json = [
                'berhasil' => 'berhasil',
                'no_faktur',
                'tggl_pengembalian',
                'kode_barang',
                'kode_produksi_pem',
                'jmlhpengembalian',
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
        $this->m->delete('t_retur_pengembalian', $where);
        $json = [
            'berhasil' => 'berhasil'
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function laporanpengembalian()
    {
        $data['title'] = 'SHERIN BAN | Laporan Retur Pengembalian';
        $data['subtitle'] = 'Laporan Retur Pengembalian';
        $this->load->view('Templates/Meta', $data);
        $this->load->view('Templates/Navbar');
        $this->load->view('Templates/Menu', $data);
        $this->load->view('retur/pengembalian/Laporan', $data);
        $this->load->view('Templates/Footer');
        $this->load->view('Templates/Js');
    }

    public function lap_get_data()
    {

        $tgl = $this->input->post('tgllap');
        $keyword = $this->input->post('kategori');
        $keys = $this->input->post('pencarian');


        $table = 'v_sisa_retur';
        $column_order = [null, 'v_sisa_retur.no_notapembelian', 'v_sisa_retur.kode_barang', 't_barang.nama_barang', 'v_sisa_retur.kode_produksi', 'jumlah_brg_retur', 'jumlah_brg_kembali', 'v_sisa_retur.Sisa', 't_barang.spek', 't_supplier.nama_supplier', 't_supplier.telepon'];
        $column_search = ['v_sisa_retur.no_notapembelian', 'v_sisa_retur.kode_barang', 't_barang.nama_barang', 'v_sisa_retur.kode_produksi', 'jumlah_brg_retur', 'jumlah_brg_kembali', 'v_sisa_retur.Sisa', 't_barang.spek', 't_supplier.nama_supplier', 't_supplier.telepon'];

        $order = ['v_sisa_retur.tgl_pengembalian' => 'desc'];
        $join = [
            't_barang' => 't_barang.kode_barang = v_sisa_retur.kode_barang',
            't_supplier' => 't_supplier.kode_supplier = v_sisa_retur.kode_supplier'
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
                'tgl_pengembalian >=' => $awal,
                'tgl_pengembalian <=' => $akhir,
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
                'tgl_pengembalian >=' => $awal,
                'tgl_pengembalian <=' => $akhir
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
            $en = $field['id_retur'];
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field['tgl_pengembalian']));
            $row[] = $field['no_notapembelian'];
            $row[] = $field['nama_supplier'];
            $row[] = $field['telepon'];
            $row[] = $field['kode_barang'];
            $row[] = $field['nama_barang'];
            $row[] = $field['spek'];
            $row[] = $field['kode_produksi'];
            $row[] = $field['jumlah_brg_retur'];
            $row[] = $field['jumlah_brg_kembali'];
            $row[] = $field['Sisa'];
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
            $this->db->where(['tgl_pengembalian >=' => $awal]);
            $this->db->where(['tgl_pengembalian <=' => $akhir]);
            $pecahhuruf = str_replace(" ", "%", $keyword);
            $hasildata = $keys;
            $this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);

            $data['awal'] = date('d-m-Y', strtotime($awal));
            $data['akhir'] = date('d-m-Y', strtotime($akhir));
            $data['keyword'] = $keyword;
            if ($keys == 'no_notapembelian') {
                $data['keys'] = 'No Faktur';
            } elseif ($keys == 'nama_barang') {
                # code...
                $data['keys'] = 'Nama Barang';
            } elseif ($keys == 'spek') {
                # code...
                $data['keys'] = 'Spesifikasi';
            } elseif ($keys == 'kode_produksi') {
                # code...
                $data['keys'] = 'Kode Produksi';
            }
        } elseif ($tgl) {
            $tglpecah = explode(" - ", $tgl);
            $start = $tglpecah[0];
            $end = $tglpecah[1];
            $awal = date('Y-m-d', strtotime($start));
            $akhir = date('Y-m-d', strtotime($end));
            $this->db->where(['tgl_pengembalian >=' => $awal]);
            $this->db->where(['tgl_pengembalian <=' => $akhir]);

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

            if ($keys == 'no_notapembelian') {
                $data['keys'] = 'No Faktur';
            } elseif ($keys == 'nama_barang') {
                # code...
                $data['keys'] = 'Nama Barang';
            } elseif ($keys == 'spek') {
                # code...
                $data['keys'] = 'Spesifikasi';
            } elseif ($keys == 'kode_produksi') {
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
        $data['title'] = "Laporan Retur Pengembalian";

        $this->db->join('t_barang', 't_barang.kode_barang = v_sisa_retur.kode_barang');
        $this->db->join('t_supplier', 't_supplier.kode_supplier = v_sisa_retur.kode_supplier');
        $this->db->order_by('v_sisa_retur.tgl_pengembalian', "DESC");
        $data['cetakdata'] = $this->db->get('v_sisa_retur')->result_array();
        $html = $this->load->view('retur/pengembalian/Cetak', $data, true);
        $pdf->WriteHTML($html);
        $pdf->Output();
    }
}
