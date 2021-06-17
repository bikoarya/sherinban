<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Standart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN | Standart Ban';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Standart/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "nama_standart,ring_standart,bandepan,banbelakang";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Standart/index_ajax/');
		$config['total_rows'] = $this->m->getpage('t_standart', '*', 'id_standart DESC', $limit, $offset, $count = true, $keydata, $cari_key);
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
		$data['standart'] = $this->m->getpage('t_standart', '*', 'id_standart DESC', $limit, $offset, $count = false, $keydata, $cari_key);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Master/Standart/Index_ajax', $data);
	}

	public function vstandart($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);
		$keydata  = "nama_standart,ring_standart,bandepan,banbelakang";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Standart/vstandart/');
		$config['total_rows'] = $this->m->getpage('t_standart', '*', '', $limit, $offset, $count = true, $keydata, $cari_key);
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
		$data['standart'] = $this->m->getpage('t_standart', '*', '', $limit, $offset, $count = false, $keydata, $cari_key);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Penjualan/Stdartban', $data);
	}

	function view()
	{
		$data = $this->m->get('t_standart');
		$output = '';
		$Y = 'Y';
		foreach ($data as $row => $value) {
			# code...
			$output .= '
				<tr>
				<td>' . ($row + 1) . '</td>
				<td>' . $value['nama_standart'] . '</td>
				<td>' . $value['ring_standart'] . '</td>
				<td> <a href="javascript:void(0);" class="text-success ubahstandart" data-id_standart="' . $value['id_standart'] . '" data-nama_standart="' . $value['nama_standart'] . '" data-ring_standart="' . $value['ring_standart'] . '"><i class="far fa-edit"></i></a> <a href="javascript:void(0);" class="text-danger hapusstandart" data-id_standart="' . $value['id_standart'] . '"><i class="far fa-trash-alt"></i></a></td>
				</tr>';
		}

		return $output;
	}

	public function viewV()
	{
		echo $this->view();
	}

	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data = [
				'nama_standart' => htmlspecialchars($this->input->post('nama_standart')),
				'ring_standart' => htmlspecialchars($this->input->post('ring_standart')),
				'bandepan' => htmlspecialchars($this->input->post('bandepan')),
				'banbelakang' => htmlspecialchars($this->input->post('banbelakang'))
			];
			$this->m->insert('t_standart', $data);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = htmlspecialchars($this->input->post('edtid_standart'));
			$where = ['id_standart' => $kode];
			$data = [
				'nama_standart' => htmlspecialchars($this->input->post('edtnama_standart')),
				'ring_standart' => htmlspecialchars($this->input->post('edtring_standart')),
				'bandepan' => htmlspecialchars($this->input->post('edtbandepan')),
				'banbelakang' => htmlspecialchars($this->input->post('edtbanbelakang'))
			];
			$this->m->put('t_standart', $data, $where);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function hapus()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('id_standart');
			$this->m->delete('t_standart', ['id_standart' => $kode]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}
}
