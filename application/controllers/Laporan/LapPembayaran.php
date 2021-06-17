<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPembayaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 3 || $this->session->userdata('id_level') == 4) {
			$data['menu'] = 'Dash';
			$data['title'] = 'SHERIN BAN | Laporan Pembayaran';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Laporan/LapPembayaran', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$tgl = $this->input->post('tglPembayaran');

		if ($tgl != null) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$awal = date('Y-m-d', strtotime($start));
			$akhir = date('Y-m-d', strtotime($end));
			$where1 = ['tgl_penjualan >=' => $awal];
			$where2 = ['tgl_penjualan <=' => $akhir];
		} else {

			$where1 = '';
			$where2 = '';
		}

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Laporan/LapPembayaran/index_ajax');
		$config['total_rows'] = $this->m->getpage('v_kasir', '*', '', $limit, $offset, $count = true, '', '', 't_pelanggan', 't_pelanggan.kode_pelanggan = v_kasir.kode_pelanggan', 't_mekanik', 't_mekanik.kode_mekanik=v_kasir.kode_mekanik', 't_kasir', 't_kasir.no_nota = v_kasir.no_nota', '', '', $where1, $where2);

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
		$data['pembayaran'] = $this->m->getpage('v_kasir', '*', '', $limit, $offset, $count = false, '', '', 't_pelanggan', 't_pelanggan.kode_pelanggan = v_kasir.kode_pelanggan', 't_mekanik', 't_mekanik.kode_mekanik=v_kasir.kode_mekanik', 't_kasir', 't_kasir.no_nota = v_kasir.no_nota',  '', '', $where1, $where2);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Laporan/LapPembayaranAjax', $data);
	}

	public function vpembayaran()
	{
		$tgl = $this->input->post('tgllap');
		$keyword = $this->input->post('kategori');
		$keys = $this->input->post('pencarian');

		$table = 'v_kasir';
		$column_order = [null];
		$column_search = [];
		$order = ['v_kasir.tgl_penjualan' => 'DESC'];

		$join = [
			't_pelanggan' => 't_pelanggan.kode_pelanggan = v_kasir.kode_pelanggan',
			't_mekanik' => 't_mekanik.kode_mekanik=v_kasir.kode_mekanik',
			't_kasir' => 't_kasir.no_nota = v_kasir.no_nota'
		];
		/**
		 * Data Site Datatables
		 */

		if ($tgl != null  &&  $keyword != null) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$kalStart = implode("", array($start));
			$kalEnd = implode("", array($end));
			$awal = date('Y-m-d', strtotime($kalStart));
			$akhir = date('Y-m-d', strtotime($kalEnd));
			$where = [
				'v_kasir.tgl_penjualan >=' => $awal,
				'v_kasir.tgl_penjualan <=' => $akhir

			];
			$where1 = [
				$keyword 		   => $keys
			];
		} elseif ($tgl != null) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$kalStart = implode("", array($start));
			$kalEnd = implode("", array($end));
			$awal = date('Y-m-d', strtotime($kalStart));
			$akhir = date('Y-m-d', strtotime($kalEnd));
			$where = [
				'v_kasir.tgl_penjualan >=' => $awal,
				'v_kasir.tgl_penjualan <=' => $akhir
			];
		} elseif ($keyword != null) {
			# code...
			$where1 = [
				$keyword 		   => $keys
			];
		} else {
			$where  = '';
			$where1 = '';
		}

		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order, $where)->result_array();
		$data = [];
		$no   = $_POST['start'];
		$sub_total = 0;
		$total = 0;
		foreach ($list as $value) {
			$sub_total = $value['total_pembayaran'];
			$no++;
			$row = [];
			$row[] = date("d-m-Y", strtotime($value['tgl_penjualan']));
			$row[] = $value['no_nota'];
			$row[] = $value['nama_mekanik'];
			$row[] = $value['nama_pelanggan'];
			$row[] = '<p class="text-right">' . number_format($sub_total, 0, ',', '.') . '</p>';
			$data[] = $row;
		}

		$foottotal = $this->m->get_datatablesfooter(null, $table, $join, $column_order, $column_search, $order, $where)->result_array();
		$totalfoot = 0;
		foreach ($foottotal as $valuedata) {
			$totalfoot += $valuedata['total_pembayaran'];
		}

		$recordsFiltered  = $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order, $where);
		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $recordsFiltered,
			"footerTotal" => $totalfoot,
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}

	function CetakPembayaran()
	{
		$tgl = $this->input->post('tglPem');
		$keys = $this->input->post('keys');
		$keyword = $this->input->post('textpencarian');
		if ($tgl != null && $keyword != null) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$awal = date('Y-m-d', strtotime($start));
			$akhir = date('Y-m-d', strtotime($end));

			$this->db->where(['tgl_penjualan >=' => $awal]);
			$this->db->where(['tgl_penjualan <=' => $akhir]);
			$this->db->where([$keys => $keyword]);
			$data['awal'] = date('d-m-Y', strtotime($awal));
			$data['akhir'] = date('d-m-Y', strtotime($akhir));
			$data['keyword'] = $keyword;
			if ($keys == 'kode_produksi_pem') {
				$data['keys'] = 'Kode Produksi';
			} elseif ($keys == 't_barang.kode_barang') {
				# code...
				$data['keys'] = 'Kode Barang';
			} elseif ($keys == 'nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 'nama_katagori') {
				# code...
				$data['keys'] = 'Kategori';
			}
		} elseif ($tgl) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$awal = date('Y-m-d', strtotime($start));
			$akhir = date('Y-m-d', strtotime($end));

			$data['awal'] = date('d-m-Y', strtotime($awal));
			$data['akhir'] = date('d-m-Y', strtotime($akhir));
			$data['keyword'] = '';
			$this->db->where(['tgl_penjualan >=' => $awal]);
			$this->db->where(['tgl_penjualan <=' => $akhir]);
		} elseif ($keyword) {
			# code...
			$this->db->where([$keys => $keyword]);
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = $keyword;

			if ($keys == 'kode_produksi_pem') {
				$data['keys'] = 'Kode Produksi';
			} elseif ($keys == 't_barang.kode_barang') {
				# code...
				$data['keys'] = 'Kode Barang';
			} elseif ($keys == 'nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 'nama_katagori') {
				# code...
				$data['keys'] = 'Kategori';
			}
		} else {
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = '';
			$data['keys'] = '';
		}

		$data['title'] = "Laporan Pembayaran";

		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan = v_kasir.kode_pelanggan');
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik=v_kasir.kode_mekanik');
		$this->db->join('t_kasir', 't_kasir.no_nota = v_kasir.no_nota');
		$data['cetakBayar'] = $this->db->get('v_kasir')->result();

		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$html = $this->load->view('Laporan/CetakPembayaran', $data, true);
		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
