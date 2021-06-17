<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN | Supplier';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Supplier/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}


	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "nama_supplier, kode_supplier,alamat_supplier, telepon ";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Supplier/index_ajax/');
		$config['total_rows'] = $this->m->getpage('t_supplier', '*', '', $limit, $offset, $count = true, $keydata, $cari_key);
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
		$data['supplier'] = $this->m->getpage('t_supplier', '*', '', $limit, $offset, $count = false, $keydata, $cari_key);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Master/Supplier/Index_ajax', $data);
	}


	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data = [
				'kode_supplier' => $this->m->supp(),
				'nama_supplier' => htmlspecialchars($this->input->post('nama_supplier')),
				'alamat_supplier' => htmlspecialchars($this->input->post('alamat_sup')),
				'telepon' => htmlspecialchars($this->input->post('telpon_sup'))
			];
			$insert = $this->m->insert('t_supplier', $data);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = htmlspecialchars($this->input->post('edtkode_supplier'));
			$where = ['kode_supplier' => $kode];
			$data = [
				'nama_supplier' => htmlspecialchars($this->input->post('edtnama_supplier')),
				'alamat_supplier' => htmlspecialchars($this->input->post('edtalamat_supplier')),
				'telepon' => htmlspecialchars($this->input->post('edttlp_supplier'))
			];
			$this->m->put('t_supplier', $data, $where);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function hapus()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('kode_supplier');
			$this->m->delete('t_supplier', ['kode_supplier' => $kode]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}
}
