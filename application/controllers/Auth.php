<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['title'] = 'SHERIN BAN';
			$data['level'] = $this->db->where(['id_level != ' => 1]);
			$data['level'] = $this->m->get('t_level');
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Auth/Daftar', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('');
		}
	}
	public function insert()
	{

		$data = [
			'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap')),
			'username' => htmlspecialchars($this->input->post('username')),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'id_level' => htmlspecialchars($this->input->post('level'))
		];

		$this->db->insert('t_user', $data);
		echo $this->index_ajax();
	}
	public function viewAkun()
	{
		echo $this->view();
	}
	function view()
	{
		$dp = $this->m->join('t_user', 't_level', 't_user.id_level=t_level.id_level')->result_array();
		$output = '';
		foreach ($dp as $row => $value) {
			$output .= '
				<tr>
				<td>' . ($row + 1) . '</td>
				<td>' . $value['nama_lengkap'] . '</td>
				<td>' . $value['username'] . '</td>
				<td>' . $value['nama_level'] . '</td>
				<td> <a href="javascript:void(0);" class="text-success ubahbarang" data-iduser="' . $value['id_user'] . '" data-nm_lengkap="' . $value['nama_lengkap'] . '" data-usrnm="' . $value['username'] . '" data-pass1="' . $value['password'] . '" data-level="' . $value['id_level'] . '"><i class="far fa-edit"></i></a> <a href="#" class="text-danger hapusakun" data-id_user="' . $value['id_user'] . '"><i class="far fa-trash-alt"></i></a></td>
				</tr>';
		}

		return $output;
	}
	public function Login()
	{
		if ($this->session->userdata('username')) {
			# code...
			redirect('Dash');
		} else {
			# code...
			$this->form_validation->set_rules('username', 'Username', 'trim|required', [
				'required' => 'Masukkan Username anda!'
			]);
			$this->form_validation->set_rules('password', 'Password', 'trim|required', [
				'required' => 'Masukkan Password anda!'
			]);

			if ($this->form_validation->run() == false) {
				$data['title'] = 'Sherin Bengkel | Pembelian';
				$this->load->view('Auth/Login', $data);
			} else {
				$this->_login();
			}
		}
	}
	private function _Login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('t_user', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'nama_lengkap' => $user['nama_lengkap'],
					'username' => $user['username'],
					'id_level' => $user['id_level']
				];
				$this->session->set_userdata($data);
				redirect('Dash');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
				redirect('Auth/Login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Akun tidak terdaftar
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
			redirect('Auth/Login');
		}
	}
	public function Keluar()
	{
		$this->session->sess_destroy();

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Anda telah keluar!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
		redirect('Auth/Login');
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data = [
				'nama_lengkap' => htmlspecialchars($this->input->post('nm_lengkap')),
				'username' => htmlspecialchars($this->input->post('usrnm')),
				'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
				'id_level' => htmlspecialchars($this->input->post('level2'))
			];
			$idakun = $this->input->post('iduser');
			$this->db->update('t_user', $data, ['id_user' => $idakun]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}


	function hapusakun()
	{
		$id_user = $this->input->post('id_user');
		$this->m->delete('t_user', ['id_user' => $id_user]);
		echo $this->index_ajax();
	}

	function blocked()
	{
		echo 'access blocked';
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "nama_lengkap,username";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Auth/index_ajax/');

		$config['total_rows'] = $this->m->getpage('t_user', '*', '', $limit, $offset, $count = true, $keydata, $cari_key, 't_level', 't_user.id_level=t_level.id_level');

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
		$data['data'] = $this->m->getpage('t_user', '*', '', $limit, $offset, $count = false, $keydata, $cari_key, 't_level', 't_user.id_level=t_level.id_level');
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Auth/Index_ajax', $data);
	}
}
