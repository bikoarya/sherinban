<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mekanik extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN | Mekanik';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Mekanik/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "kode_mekanik,nama_mekanik,jabatan_mekanik";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Mekanik/index_ajax/');
		$where = [
			't_mekanik.kode_mekanik !=' => 'M0001'
		];
		$config['total_rows'] = $this->m->getpage('t_mekanik', '*', 'kode_mekanik DESC', $limit, $offset, $count = true, $keydata, $cari_key, '', '', '', '', '', '', '', '', $where);
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

		$data['Mekanik'] = $this->m->getpage('t_mekanik', '*', 'kode_mekanik DESC', $limit, $offset, $count = false, $keydata, $cari_key, '', '', '', '', '', '', '', '', $where);
		$data['pagelinks'] = $this->pagination->create_links();

		$this->load->view('Master/Mekanik/Index_ajax', $data);
	}


	public function vmekanik()
	{
		$table = 't_mekanik';
		$column_order = [null, 'kode_mekanik', 'nama_mekanik', 'jabatan_mekanik'];

		$column_search = ['kode_mekanik', 'nama_mekanik', 'jabatan_mekanik'];

		$order = ['t_mekanik.kode_mekanik' => 'DESC'];

		/**
		 * Data Site Datatables
		 */
		$this->db->where('kode_mekanik !=', 'M0001');
		$list = $this->m->get_datatables(null, $table, null, $column_order, $column_search, $order)->result_array();
		$data = [];
		$no   = $_POST['start'];
		foreach ($list as $mek) {
			$no++;
			$row = [];
			$row[] = $no;
			$row[] = $mek['kode_mekanik'];
			$row[] = $mek['nama_mekanik'];
			$row[] = $mek['jabatan_mekanik'];
			$row[]	= '<a href="#" class="text-success ubahmek" data-kode_mekanik="' . $mek['kode_mekanik'] . '" data-nama_mekanik="' . $mek['nama_mekanik'] . '" data-jabatan_mekanik="' . $mek['jabatan_mekanik'] . '"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapusmek" data-kode_mekanik="' . $mek['kode_mekanik'] . '"><i class="far fa-trash-alt"></i></a>';
			$data[] = $row;
		}

		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $this->m->count_filtered(null, $table, null, $column_order, $column_search, $order),
			"data" => $data
		];
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}


	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data = [
				'kode_mekanik' => $this->m->Mekanik(),
				'nama_mekanik' => htmlspecialchars($this->input->post('nama_mekanik')),
				'jabatan_mekanik' => htmlspecialchars($this->input->post('jabatan_mekanik'))
			];
			$this->m->insert('t_mekanik', $data);
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode('berhasil'));
		} else {
			redirect('Notfound');
		}
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = htmlspecialchars($this->input->post('edtkode_mekanik'));
			$where = ['kode_mekanik' => $kode];
			$data = [
				'nama_mekanik' => htmlspecialchars($this->input->post('edtnama_mekanik')),
				'jabatan_mekanik' => htmlspecialchars($this->input->post('edtjabatan_mekanik'))
			];
			$this->m->put('t_mekanik', $data, $where);
			$json = [
				'data' => 'berhasil'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
		} else {
			redirect('Notfound');
		}
	}

	function hapus()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('kode_mekanik');
			$this->m->delete('t_mekanik', ['kode_mekanik' => $kode]);
			$json = [
				'data' => 'berhasil'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
		} else {
			redirect('Notfound');
		}
	}
}
