<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Cetak Laporan';
		$this->load->library('dompdf_gen');
		$this->load->view('Print/Index', $data);

		$this->load->library('cart');
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan.pdf", array('Attachment' => 0));
	}
}