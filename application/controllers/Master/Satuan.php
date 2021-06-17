<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN | Satuan';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Satuan/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "id_satuan,nama_satuan";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Satuan/index_ajax/');
		$config['total_rows'] = $this->m->getpage('t_satuan', '*', '', $limit, $offset, $count = true, $keydata, $cari_key);
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
		$data['satuan'] = $this->m->getpage('t_satuan', '*', '', $limit, $offset, $count = false, $keydata, $cari_key);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Master/Satuan/Index_ajax', $data);
	}

	public function viewSatuan()
	{
		echo $this->index_ajax();
	}

	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|is_unique[t_satuan.nama_satuan]');
			if ($this->form_validation->run() == true) {
				$insert = [
					'nama_satuan' => htmlspecialchars($this->input->post('nama_satuan'))
				];
				$this->m->insert('t_satuan', $insert);
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
			$kode = htmlspecialchars($this->input->post('edtid_satuan'));
			$where = ['id_satuan' => $kode];
			$data = [
				'nama_satuan' => htmlspecialchars($this->input->post('edtnama_satuan'))
			];
			$this->m->put('t_satuan', $data, $where);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function hapussatuan()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('id_satuan');
			$this->m->delete('t_satuan', ['id_satuan' => $kode]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}
}
