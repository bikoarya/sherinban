<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota extends CI_Controller
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
            $data['title'] = 'SHERIN BAN | Nota';
            $this->load->view('Templates/Meta', $data);
            $this->load->view('Templates/Navbar');
            $this->load->view('Templates/Menu', $data);
            $this->load->view('Setting/Nota/Index', $data);
            $this->load->view('Templates/Footer');
            $this->load->view('Templates/Js');
        } else {
            redirect('Notfound');
        }
    }

    function tmpilnota()
    {
        $nota = $this->m->get('t_nota');
        foreach ($nota as $notat) {
            # code...
            $row = array();
            $row[] = $notat['id_nota'];
            $row[] = $notat['nama_perusahan'];
            $row[] = $notat['alamat'];
            $row[] = $notat['notlpn'];
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
            $id_nota = htmlspecialchars($this->input->post('id_nota'));
            $nama_perusahaan = htmlspecialchars($this->input->post('nama_perusahaan'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $no_hp = htmlspecialchars($this->input->post('no_hp'));
            $where = ['id_nota' => $id_nota];
            $data = [
                'nama_perusahan' => $nama_perusahaan,
                'alamat' => $alamat,
                'notlpn' => $no_hp,
            ];
            $this->m->put('t_nota', $data, $where);
        } else {
            redirect('Notfound');
        }
    }
}
