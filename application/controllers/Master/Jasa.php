<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $data['title'] = 'SHERIN BAN | Jasa';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('Master/Jasa/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    public function index_ajax($offset = null)
    {
        $cari =  htmlspecialchars($this->input->post('cari'), true);

        $keydata  = "t_jasa.Jasa, t_jasa.Harga_jasa, q_1, pot_1, q_2, pot_2";
        $cari_key = $cari;

        $limit = 10;
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // config
        $config['base_url'] = site_url('Master/Jasa/index_ajax/');
        $config['total_rows'] = $this->m->getpage('t_jasa', '*', 'id_jasa DESC', $limit, $offset, $count = true, $keydata, $cari_key);
        $config['per_page'] = $limit;
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Utama';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Terakhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] =  array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data['total'] = $config['total_rows'];
        $data['start'] = $offset;
        $data['jasa'] = $this->m->getpage('t_jasa', '*', 'id_jasa DESC', $limit, $offset, $count = false, $keydata, $cari_key);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('Master/Jasa/Index_ajax', $data);
    }

    public function vjasa()
    {
        echo $this->index_ajax();
    }

    function insert()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('Jasa', 'Jasa', 'required|is_unique[t_jasa.Jasa]');
            $this->form_validation->set_rules('harga', 'Harga', 'required');
            if ($this->form_validation->run() == true) {
                $hrg = str_replace(".", "", htmlspecialchars($this->input->post('harga')));
                $insert = [
                    'Jasa'       => htmlspecialchars($this->input->post('Jasa')),
                    'Harga_jasa' => $hrg,
                    'q_1'        => htmlspecialchars($this->input->post('qty_1')),
                    'pot_1'      => htmlspecialchars($this->input->post('pot_1')),
                    'q_2'        => htmlspecialchars($this->input->post('qty_2')),
                    'pot_2'      => htmlspecialchars($this->input->post('pot_2')),
                ];
                $this->m->insert('t_jasa', $insert);
                $data = [
                    'code' => 200
                ];
                echo json_encode($data);
            } else {
                # code...
                $data = [
                    'val'  => validation_errors(),
                    'code' => 500
                ];
                echo json_encode($data);
            }
        } else {
            redirect('Notfound');
        }
    }

    function update()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $kode = htmlspecialchars($this->input->post('edtid_jasa'));
            $hrg = str_replace(".", "", htmlspecialchars($this->input->post('edtharga')));
            $where = ['id_jasa' => $kode];
            $data = [
                'Jasa' => htmlspecialchars($this->input->post('edtJasa')),
                'Harga_jasa' => $hrg,
                'q_1'        => htmlspecialchars($this->input->post('edtqty_1')),
                'pot_1'      => htmlspecialchars($this->input->post('edtpot')),
                'q_2'        => htmlspecialchars($this->input->post('edtqty_2')),
                'pot_2'      => htmlspecialchars($this->input->post('edtpot_2')),
            ];
            $this->m->put('t_jasa', $data, $where);
            echo $this->index_ajax();
        } else {
            redirect('Notfound');
        }
    }

    function cariVJasa()
    {
        echo $this->cariJasa();
    }

    public function cariJasa()
    {
        $dataJasa = $this->m->get('t_jasa');
        $output = '';
        foreach ($dataJasa as $key => $value) {
            # code...
            $output .= '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $value['Jasa'] . '</td>
                <td>' . $value['Harga_jasa'] . '</td>
                <td><a href="javascript:void(0);" class="btn btn-primary carijs" data-harga_jasa="' . $value['Harga_jasa'] . '" data-nonota="' . $this->m->Nota() . '" data-tgl="' . date("d-m-Y") . '" data-jasa="' . $value['Jasa'] . '" data-qty2="' . $value['q_2'] . '" data-pot2="' . $value['pot_2'] . '">Pilih</a></td>
                </tr>';
        }
        return $output;
    }

    function hapus()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $kode = $this->input->post('id_jasa');
            $this->m->delete('t_jasa', ['id_jasa' => $kode]);
            echo $this->index_ajax();
        } else {
            redirect('Notfound');
        }
    }

    function listjasa()
    {
        $cari =  htmlspecialchars($this->input->post('cari'), true);
        // $cari_key = [
        //     'Jasa' => $cari,
        //     'Harga_jasa' => $cari
        // ];

        $keydata  = "t_jasa.Jasa, t_jasa.Harga_jasa, q_1, pot_1, q_2, pot_2";
        $cari_key = $cari;

        $limit = 10;
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // config
        $config['base_url'] = site_url('Master/Jasa/listjasa/');
        $config['total_rows'] = $this->m->getpage('t_jasa', '*', '', $limit, $offset, $count = true, $keydata, $cari_key);
        $config['per_page'] = $limit;
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Utama';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Terakhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] =  array('class' => 'page-link');

        $this->pagination->initialize($config);

        $total = $config['total_rows'];
        $start = $offset;
        $jasa = $this->m->getpage('t_jasa', '*', '', $limit, $offset, $count = false, $keydata, $cari_key);
        $pagelinks = $this->pagination->create_links();

        $template = [
            'table_open' => '<table class="table table-bordered table-striped">'
        ];
        $this->table->set_template($template);
        $this->table->set_heading('#', 'Jenis Jasa', 'Harga', 'Aksi');
        foreach ($jasa as $key => $dtajsa) :
            $this->table->add_row($key + 1, $dtajsa['Jasa'], number_format($dtajsa['Harga_jasa'], 0, ',', '.'), '<a class="btn btn-success text-white jasapilih" data-id="' . $dtajsa['id_jasa'] . '" data-jasa="' . $dtajsa['Jasa'] . '" data-harga="' . $dtajsa['Harga_jasa'] . '" data-qty="' . $dtajsa['q_1'] . '" data-pot="' . $dtajsa['pot_1'] . '"  data-qty2="' . $dtajsa['q_2'] . '" data-pot2="' . $dtajsa['pot_2'] . '">Pilih</a>');
        endforeach;

        $data = [
            'table' => $this->table->generate(),
            'pagelinks' => $pagelinks
        ];
        echo json_encode($data);
    }
}
