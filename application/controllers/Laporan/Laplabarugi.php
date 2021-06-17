<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laplabarugi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 3 || $this->session->userdata('id_level') == 4) {
            $data['menu'] = 'Dash';
            $data['title'] = 'SHERIN BAN | Laporan Laba Rugi';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('labarugi/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    public function vlabarugi()
    {
        $keyword = $this->input->post('kategori');
        $keys = $this->input->post('pencarian');

        $select = '*, SUM(t_penjualan.jumlah_jual) AS totaljaual, t_penjualan.harga_jual AS hrgapenjualan';
        $table = 't_penjualan';
        $column_order = [null, 'kode_barang', 'nama_barang', 'spek', 'qty', 'hrg_beli'];
        $order = '';

        $join = [
            't_barang'      => 't_barang.kode_barang = t_penjualan.kode_barang',
        ];

        /**
         * Data Site Datatables
         */
        if ($keyword) {
            # code...
            $where = '';
            $where1 = $keyword;
            $where2 = $keys;
        } else {
            $where  = '';
            $where1 = '';
            $where2 = '';
        }
        $this->db->group_by('t_penjualan.kode_barang');
        $list = $this->m->get_datatables($select, $table, $join, $column_order, null, $order, $where, $where1, $where2)->result_array();

        $data = [];
        $no   = $_POST['start'];
        $sub_total = 0;
        foreach ($list as $value) {
            $this->db->select('SUM(t_pembelian.qty) AS totalqtypembelian,t_pembelian.hrg_beli AS harga_belipembelian');
            $this->db->group_by('t_pembelian.kode_barang');
            $this->db->where('kode_barang', $value['kode_barang']);
            $datapembelian = $this->db->get('t_pembelian')->row_array();

            $jmlhbeli    = $datapembelian['totalqtypembelian'] * $datapembelian['harga_belipembelian'];
            $jmlhterjual = $value['totaljaual'] * $value['hrgapenjualan'];
            $totallaba = $jmlhterjual - $jmlhbeli;

            $no++;
            $row = [];
            $row[] = $value['kode_barang'];
            $row[] = $value['nama_barang'];
            $row[] = $value['totaljaual'];
            $row[] = '<p class="text-right">' . number_format($jmlhterjual, 0, ',', '.') . '</p>';
            $row[] = '<p class="text-right">' . number_format($jmlhbeli, 0, ',', '.') . '</p>';
            $row[] = '<p class="text-right">' . number_format($totallaba, 0, ',', '.') . '</p>';
            $data[] = $row;
        }

        // footer total
        $this->db->group_by('t_penjualan.kode_barang');
        $footertotal = $this->m->get_datatablesfooter($select, $table, $join, $column_order, null, $order, $where, $where1, $where2)->result_array();
        $total = 0;
        foreach ($footertotal as $value) {
            $this->db->select('SUM(t_pembelian.qty) AS totalqtypembelian,t_pembelian.hrg_beli AS harga_belipembelian');
            $this->db->group_by('t_pembelian.kode_barang');
            $this->db->where('kode_barang', $value['kode_barang']);
            $datapembelian = $this->db->get('t_pembelian')->row_array();

            $jmlhbeli    = $datapembelian['totalqtypembelian'] * $datapembelian['harga_belipembelian'];
            $jmlhterjual = $value['totaljaual'] * $value['hrgapenjualan'];
            $totallaba = $jmlhterjual - $jmlhbeli;
            $total += $totallaba;
        }


        $this->db->group_by('t_penjualan.kode_barang');
        $recordsTotal = $this->m->count_all($table);
        $this->db->group_by('t_penjualan.kode_barang');
        $recordsFiltered = $this->m->count_filtered($select, $table, $join, $column_order, null, $order, $where, $where1, $where2);

        $json = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "footerTotal" => $total,
            "data" => $data
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    function CetakPembelian()
    {
        $keys = $this->input->post('keys');
        $keyword = $this->input->post('textpencarian');
        if ($keyword) {
            $pecahhuruf = str_replace(" ", "%", $keyword);
            $hasildata = $keys;
            $this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
            $data['awal'] = '';
            $data['akhir'] = '';
            $data['keyword'] = $keyword;

            if ($keys == 't_penjualan.kode_barang') {
                $data['keys'] = 'Kode Barang';
            } elseif ($keys == 't_barang.nama_barang') {
                # code...
                $data['keys'] = 'Nama Barang';
            } else {
                # code...
                $data['keys'] = '';
            }
        } else {
            $data['awal'] = '';
            $data['akhir'] = '';
            $data['keyword'] = '';
            $data['keys'] = '';
        }
        $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $data['title'] = "Laporan Laba Rugi";

        $this->db->select('*, SUM(t_penjualan.jumlah_jual) AS totaljaual, t_penjualan.harga_jual AS hrgapenjualan');
        $this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang');
        $this->db->group_by('t_penjualan.kode_barang');
        $data['cetakBeli'] = $this->db->get('t_penjualan')->result();
        $html = $this->load->view('labarugi/Cetak', $data, true);

        $pdf->WriteHTML($html);
        $pdf->Output();
    }
}
