<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapStok extends CI_Controller
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
			$data['title'] = 'SHERIN BAN | Laporan Stok';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Laporan/LapStok', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function VLapstok()
	{
		$tgl = $this->input->post('tgllap');
		$keyword = $this->input->post('kategori');
		$keys = $this->input->post('pencarian');

		$table = 't_stok';
		$column_order = [null];
		$column_search = [null];
		$order = null;

		$join = [
			't_barang' => 't_barang.kode_barang = t_stok.kode_barang',
			't_satuan' => 't_satuan.id_satuan = t_barang.id_satuan',
			't_katagori' => 't_katagori.id_katagori = t_barang.id_kategori'
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
				'tgl_penjualan >=' => $awal,
				'tgl_penjualan <=' => $akhir
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
				'tgl_penjualan >=' => $awal,
				'tgl_penjualan <=' => $akhir
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
			$where1  = '';
			$where2  = '';
		}

		$this->db->order_by('t_stok.stok', 'ASC');
		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2)->result_array();
		$data = [];
		$no   = $_POST['start'];
		$tlstok = 0;
		foreach ($list as $value) {
			$no++;
			$row = [];
			$row[] = $value['kode_produksi_pem'];
			$row[] = $value['kode_barang'];
			$row[] = $value['nama_barang'];
			$row[] = $value['spek'];
			$row[] = $value['nama_katagori'];
			$row[] = $value['nama_satuan'];
			$row[] = '<p class="text-center">' . $value['stok'] . '</p>';
			$data[] = $row;
		}

		$totalfooter = $this->m->get_datatablesfooter(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2)->result_array();
		foreach ($totalfooter as $value) {
			$tlstok += $value['stok'];
		}

		$recordsFiltered  = $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2);
		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $recordsFiltered,
			"footerTotal" => $tlstok,
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}

	function CetakStok()
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
			$pecahhuruf = str_replace(" ", "%", $keyword);
			$hasildata = $keys;
			$this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
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
			} elseif ($keys == 't_katagori.nama_katagori') {
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
			$pecahhuruf = str_replace(" ", "%", $keyword);
			$hasildata = $keys;
			$this->db->where("CONCAT($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
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
			} elseif ($keys == 't_katagori.nama_katagori') {
				# code...
				$data['keys'] = 'Kategori';
			}
		} else {
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = '';
			$data['keys'] = '';
		}
		$data['title'] = "Laporan Stok Barang";
		$this->db->join('t_barang', 't_barang.kode_barang = t_stok.kode_barang');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori');
		$this->db->order_by('t_stok.stok ASC');
		$data['cetakStok'] = $this->db->get('t_stok')->result();
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$html = $this->load->view('Laporan/CetakStok', $data, true);

		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
