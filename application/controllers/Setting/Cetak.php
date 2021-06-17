<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_login();
    }

    public function index()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $data['title'] = 'SHERIN BAN | Cetak';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('Setting/Print/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    function tmpilcetak()
    {
        $print = $this->m->get('t_print');
        foreach ($print as $printt) {
            # code...
            $row = array();
            $row[] = $printt['id_print'];
            $row[] = $printt['apikey'];
            $row[] = $printt['port'];
            $data[] = $row;
        }
        $output = [
            'data' => $data
        ];
        echo json_encode($output);
    }

    function update()
    {
        if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
            $id_cetak = htmlspecialchars($this->input->post('id_cetak'));
            $apikey = htmlspecialchars($this->input->post('apikey'));
            $port = htmlspecialchars($this->input->post('port'));
            $where = ['id_print' => $id_cetak];
            $data = [
                'apikey' => $apikey,
                'port' => $port
            ];
            $this->m->put('t_print', $data, $where);
        } else {
            redirect('Notfound');
        }
    }
}
