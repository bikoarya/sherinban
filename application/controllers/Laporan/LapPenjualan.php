<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapPenjualan extends CI_Controller
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
			$data['title'] = 'SHERIN BAN | Laporan Penjualan';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Laporan/LapPenjualan', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function vlapPenjualan()
	{
		$tgl = $this->input->post('tgllap');
		$keyword = $this->input->post('kategori');
		$keys = $this->input->post('pencarian');

		$select = "*, t_penjualan.harga_jual AS hrga_jual";
		$table = 't_penjualan';
		$column_order = [null, 'tgl_penjualan', 'no_nota', 'nama_mekanik', 'nama_barang', 'Jasa', 'jumlah_jual', 'potongan', 't_barang.spek', 'hrga_jual', 'id_jasa'];

		$order = '';

		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'left');
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik=t_penjualan.kode_mekanik', 'left');
		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan=t_penjualan.kode_pelanggan', 'left');
		$this->db->join('t_jasa', 't_jasa.id_jasa = t_penjualan.id_jasa', 'left');

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
			$where1 = '';
			$where2 = '';
		}

		$list = $this->m->get_datatables($select, $table, null, $column_order, null, $order, $where, $where1, $where2)->result_array();

		$data = [];
		$no   = $_POST['start'];
		$sub_total = 0;
		foreach ($list as $value) {
			if ($value['id_jasa'] != 0) {
				$spek = "-";
				$nmabrg = $value['Jasa'];
				$potsub = $value['hrga_jual'] - $value['potongan'];
				$harga = $value['hrga_jual'];
				$sub_total = $potsub * $value['jumlah_jual'];
			} else {
				# code...
				$nmabrg = $value['nama_barang'];
				$potsub = $value['hrga_jual'] - $value['potongan'];
				$harga = $value['hrga_jual'];
				$spek = $value['spek'];
				$sub_total = $potsub * $value['jumlah_jual'];
			}
			$no++;
			$row = [];
			$row[] = date("d-m-Y", strtotime($value['tgl_penjualan']));
			$row[] = $value['no_nota'];
			$row[] = $value['nama_mekanik'];
			$row[] = $nmabrg;
			$row[] = $spek;
			$row[] = $value['kode_produksi_pen'];
			$row[] = $value['nama_pelanggan'];
			$row[] = $value['jumlah_jual'];
			$row[] = '<p class="textright">' . number_format($harga, 0, ',', '.') . '</p>';
			$row[] = $value['potongan'];
			$row[] = '<p class="textright">' . number_format($sub_total, 0, ',', '.') . '</p>';
			$data[] = $row;
		}

		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'left');
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik=t_penjualan.kode_mekanik', 'left');
		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan=t_penjualan.kode_pelanggan', 'left');
		$this->db->join('t_jasa', 't_jasa.id_jasa = t_penjualan.id_jasa', 'left');
		$recordsFiltered  = $this->m->count_filtered($select, $table, null, $column_order, null, $order, $where, $where1, $where2);

		//footer total
		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'left');
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik=t_penjualan.kode_mekanik', 'left');
		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan=t_penjualan.kode_pelanggan', 'left');
		$this->db->join('t_jasa', 't_jasa.id_jasa = t_penjualan.id_jasa', 'left');
		$totalfooter = $this->m->get_datatablesfooter($select, $table, null, $column_order, null, $order, $where, $where1, $where2)->result_array();
		$subtotalfooter =  0;
		$totalfoot = 0;
		foreach ($totalfooter as $datafoot) {
			if ($datafoot['id_jasa'] != 0) {
				$potsubfooter = $datafoot['hrga_jual'] - $datafoot['potongan'];
				$subtotalfooter = $potsubfooter * $datafoot['jumlah_jual'];
			} else {
				$potsubfooter = $datafoot['hrga_jual'] - $datafoot['potongan'];
				$subtotalfooter = $potsubfooter * $datafoot['jumlah_jual'];
			}
			$totalfoot += $subtotalfooter;
		}
		// end

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

	function CetakPenjualan()
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
			if ($keys == 't_penjualan.no_nota') {
				$data['keys'] = 'No. Nota';
			} elseif ($keys == 't_barang.nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 't_jasa.Jasa') {
				# code...
				$data['keys'] = 'Jasa';
			} elseif ($keys == 't_pelanggan.nama_pelanggan') {
				# code...
				$data['keys'] = 'Nama Pelanggan';
			} elseif ($keys == 't_barang.spek') {
				# code...
				$data['keys'] = 'Spesifikasi';
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

			if ($keys == 't_penjualan.no_nota') {
				$data['keys'] = 'No. Nota';
			} elseif ($keys == 't_barang.nama_barang') {
				# code...
				$data['keys'] = 'Nama Barang';
			} elseif ($keys == 't_jasa.Jasa') {
				# code...
				$data['keys'] = 'Jasa';
			} elseif ($keys == 't_pelanggan.nama_pelanggan') {
				# code...
				$data['keys'] = 'Nama Pelanggan';
			} elseif ($keys == 't_barang.spek') {
				# code...
				$data['keys'] = 'Spesifikasi';
			}
		} else {
			$data['awal'] = '';
			$data['akhir'] = '';
			$data['keyword'] = '';
			$data['keys'] = '';
		}

		$this->db->select('*, t_penjualan.harga_jual AS hrga_jual');
		$this->db->join("t_barang", "t_barang.kode_barang = t_penjualan.kode_barang", "left");
		$this->db->join("t_mekanik", "t_mekanik.kode_mekanik=t_penjualan.kode_mekanik", "left");
		$this->db->join("t_pelanggan", "t_pelanggan.kode_pelanggan=t_penjualan.kode_pelanggan", "left");
		$this->db->join("t_jasa", "t_jasa.id_jasa = t_penjualan.id_jasa", "left");
		$this->db->order_by('t_penjualan.id_penjualan', 'DESC');
		$data['cetakJual'] = $this->db->get('t_penjualan')->result();

		$data['title'] = "Laporan Penjualan";
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$html = $this->load->view('Laporan/CetakPenjualan', $data, true);
		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
