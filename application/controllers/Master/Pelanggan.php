<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN | Pelanggan';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Pelanggan/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);
		$keydata  = "nama_pelanggan,kode_pelanggan,alamat_pelanggan,telepon_pelanggan";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Pelanggan/index_ajax/');
		$config['total_rows'] = $this->m->getpage('t_pelanggan', '*', 'kode_pelanggan DESC', $limit, $offset, $count = true, $keydata, $cari_key);
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
		$data['pelanggan'] = $this->m->getpage('t_pelanggan', '*', 'kode_pelanggan DESC', $limit, $offset, $count = false, $keydata, $cari_key);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Master/Pelanggan/Index_ajax', $data);
	}

	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data = [
				'kode_pelanggan' => $this->m->pel(),
				'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan')),
				'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pelanggan')),
				'telepon_pelanggan' => htmlspecialchars($this->input->post('telepon_pelanggan'))
			];
			$insert = $this->m->insert('t_pelanggan', $data);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = htmlspecialchars($this->input->post('edtkode_pelanggan'));
			$where = ['kode_pelanggan' => $kode];
			$data = [
				'nama_pelanggan' => htmlspecialchars($this->input->post('edtnama_pelanggan')),
				'alamat_pelanggan' => htmlspecialchars($this->input->post('edtalamat_pelanggan')),
				'telepon_pelanggan' => htmlspecialchars($this->input->post('edttelepon_pelanggan'))
			];
			$this->m->put('t_pelanggan', $data, $where);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function hapus()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('kode_pelanggan');
			$this->m->delete('t_pelanggan', ['kode_pelanggan' => $kode]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}
}
