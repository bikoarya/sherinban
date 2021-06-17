<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Controller
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
            $data['title'] = 'SHERIN BAN | Notif';

            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('notif/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    public function datatables()
    {
        $table = 't_notif_kasir';
        $column_order = [null, 't_notif_kasir.kode_pelanggan', 't_notif_kasir.keterangan', 't_notif_kasir.tanggal_exp', 't_notif_kasir.baca', 't_pelanggan.telepon_pelanggan', 't_pelanggan.nama_pelanggan'];
        $column_search = ['t_notif_kasir.kode_pelanggan', 't_notif_kasir.keterangan', 't_notif_kasir.tanggal_exp', 't_notif_kasir.baca', 't_pelanggan.telepon_pelanggan', 't_pelanggan.nama_pelanggan'];
        $order = ['t_notif_kasir.id_notif_kasir' => 'desc'];
        $join = [
            't_pelanggan' => 't_notif_kasir.kode_pelanggan = t_pelanggan.kode_pelanggan'
        ];
        /**
         * Data Site Datatables
         */
        $list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order);
        $data = [];
        $no   = $_POST['start'];
        $tglnow = date('Y-m-d H:i:s');
        // $tglnow = '2020-12-02 14:55:23';
        foreach ($list as $field) {
            if ($field->baca == '0') {
                if ($field->tanggal_exp <= $tglnow) {
                    $data = [
                        'baca' => '1'
                    ];
                    $this->db->where('t_notif_kasir.id_notif_kasir', $field->id_notif_kasir);
                    $this->db->where('t_notif_kasir.tanggal_exp', $tglnow);
                    $this->db->update('t_notif_kasir', $data);
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $field->tanggal_exp;
                    $row[] = $field->kode_pelanggan;
                    $row[] = $field->nama_pelanggan;
                    $row[] = $field->telepon_pelanggan;
                    $row[] = $field->keterangan;
                    $data[] = $row;
                }
            } else {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $field->tanggal_exp;
                $row[] = $field->kode_pelanggan;
                $row[] = $field->nama_pelanggan;
                $row[] = $field->telepon_pelanggan;
                $row[] = $field->keterangan;
                $data[] = $row;
            }
        }

        $json = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all($table),
            "recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order),
            "data" => $data
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
