<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPembelian extends CI_Controller
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
			$data['title'] = 'SHERIN BAN | Laporan Pembelian';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Laporan/LapPembelian', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function vlappembelian()
	{
		$tgl = $this->input->post('tgllap');
		$keyword = $this->input->post('kategori');
		$keys = $this->input->post('pencarian');

		$table = 't_pembelian';
		$column_order = [null, 'kode_barang', 'nama_barang', 'nama_satuan', 'nama_katagori', 'spek', 'qty', 'hrg_beli'];

		$order = '';

		$join = [
			't_barang' 	 => 't_barang.kode_barang = t_pembelian.kode_barang',
			't_satuan' 	 => 't_satuan.id_satuan=t_barang.id_satuan',
			't_katagori' => 't_katagori.id_katagori=t_barang.id_kategori',
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
				'tgl_pembelian >=' => $awal,
				'tgl_pembelian <=' => $akhir,
			];
			$where1 = $keyword;
			$where2 = $keys;
		} elseif ($tgl) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$kalStart = implode("", array($start));
			$kalEnd = implode("", array($end));
			$awal = date('Y-m-d', strtotime($kalStart));
			$akhir = date('Y-m-d', strtotime($kalEnd));
			$where = [
				'tgl_pembelian >=' => $awal,
				'tgl_pembelian <=' => $akhir
			];
			$where1 = '';
			$where2 = '';
		} elseif ($keyword) {
			# code...
			$where = '';
			$where1 = $keyword;
			$where2 = $keys;
		} else {
			$where  = '';
			$where1 = '';
			$where2 = '';
		}
		$this->db->order_by("t_pembelian.id_pembelian", "DESC");
		$list = $this->m->get_datatables(null, $table, $join, $column_order, null, $order, $where, $where1, $where2)->result_array();

		$data = [];
		$no   = $_POST['start'];
		$sub_total = 0;
		foreach ($list as $value) {
			$sub_total = $value['qty'] * $value['hrg_beli'];
			if ($value['kode_produksi_pem'] == 0) {
				$kode_produksi = '-';
			} else {
				$kode_produksi = $value['kode_produksi_pem'];
			}
			$no++;
			$row = [];
			$row[] = date('d-m-Y', strtotime($value['tgl_pembelian']));
			$row[] = $value['no_faktur'];
			$row[] = $value['nama_barang'];
			$row[] = $value['nama_satuan'];
			$row[] = $value['nama_katagori'];
			$row[] = $value['spek'];
			$row[] = $kode_produksi;
			$row[] = $value['qty'];
			$row[] = '<div class="text-right">' . number_format($value['hrg_beli'], 0, ',', '.') . '</div>';
			$row[] = '<p class="textright">' . number_format($sub_total, 0, ',', '.') . '</p>';
			$data[] = $row;
		}

		// footer total
		$footertotal = $this->m->get_datatablesfooter(null, $table, $join, $column_order, null, $order, $where, $where1, $where2)->result_array();
		$total = 0;
		$subtotalfooter = 0;
		foreach ($footertotal as $value) {
			$subtotalfooter = $value['qty'] * $value['hrg_beli'];
			$total += $subtotalfooter;
		}
		// end()

		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, null, $order, $where, $where1, $where2),
			"footerTotal" => $total,
			"data" => $data
		];
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}

	function CetakPembelian()
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
			$this->db->where(['tgl_pembelian >=' => $awal]);
			$this->db->where(['tgl_pembelian <=' => $akhir]);
			$pecahhuruf = str_replace(" ", "%", $keyword);
			$hasildata = $keys;
			$this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);

			$data['awal'] = date('d-m-Y', strtotime($awal));
			$data['akhir'] = date('d-m-Y', strtotime($akhir));
			$data['keyword'] = $keyword;
			if ($keys == 'no_faktur') {
				$data['keys'] = 'No Faktur';
			} elseif ($keys == 'nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 'nama_satuan') {
				# code...
				$data['keys'] = 'Satuan';
			} elseif ($keys == 'nama_katagori') {
				# code...
				$data['keys'] = 'Kategori';
			} elseif ($keys == 'spek') {
				# code...
				$data['keys'] = 'Spesifikasi';
			}
		} elseif ($tgl) {
			$tglpecah = explode(" - ", $tgl);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$awal = date('Y-m-d', strtotime($start));
			$akhir = date('Y-m-d', strtotime($end));
			$this->db->where(['tgl_pembelian >=' => $awal]);
			$this->db->where(['tgl_pembelian <=' => $akhir]);

			$data['awal'] = date('d-m-Y', strtotime($awal));
			$data['akhir'] = date('d-m-Y', strtotime($akhir));
			$data['keyword'] = '';
		} elseif ($keyword) {
			$pecahhuruf = str_replace(" ", "%", $keyword);
			$hasildata = $keys;
			$this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = $keyword;

			if ($keys == 'no_faktur') {
				$data['keys'] = 'No Faktur';
			} elseif ($keys == 'nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 'nama_satuan') {
				# code...
				$data['keys'] = 'Satuan';
			} elseif ($keys == 'nama_katagori') {
				# code...
				$data['keys'] = 'Kategori';
			} elseif ($keys == 'spek') {
				# code...
				$data['keys'] = 'Spesifikasi';
			}
		} else {
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = '';
			$data['keys'] = '';
		}
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$data['title'] = "Laporan Pembelian";

		$this->db->join('t_barang', 't_barang.kode_barang = t_pembelian.kode_barang');
		$this->db->join('t_satuan', 't_satuan.id_satuan=t_barang.id_satuan');
		$this->db->join('t_katagori', 't_katagori.id_katagori=t_barang.id_kategori');
		$this->db->order_by("t_pembelian.id_pembelian", "DESC");
		$data['cetakBeli'] = $this->db->get('t_pembelian')->result();
		$html = $this->load->view('Laporan/CetakPembelian', $data, true);

		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
