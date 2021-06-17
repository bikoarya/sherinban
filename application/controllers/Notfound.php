<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notfound extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'SHERIN BAN | 404 Not Found';
		$this->load->view('pesaneror', $data);
	}
}
