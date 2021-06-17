<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('username') != null) {
			$data['menu'] = 'Dash';
			$data['ijmlhpnjualan'] = $this->m->jmlhpnjualan();
			$data['ihampir'] = $this->m->barangmauhabis();
			$data['ikosong'] = $this->m->barangkosong();
			$data['ilimitexp'] = $this->m->limitexp();
			$data['iexp'] = $this->m->exp();
			$data['title'] = 'SHERIN BAN | Dashboard';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Dash/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}
}
