<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LapMasaAktif extends CI_Controller
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
			$data['title'] = 'SHERIN BAN | Laporan Masa Kadaluarsa';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Laporan/LapMasaAktif', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$keyword = $this->input->post('cariBarang');
		$keys = $this->input->post('keys');

		if ($keyword) {
			# code...
			$cariBarang = [$keys => $keyword];
		} else {
			$cariBarang = '';
		}

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// config
		$config['base_url'] = site_url('Laporan/LapMasaAktif/index_ajax');
		$config['total_rows'] = $this->m->getpage('v_kdprduksihsl', '*', 'v_kdprduksihsl.exp ASC', $limit, $offset, $count = true, '', $cariBarang, 't_barang', 't_barang.kode_barang = v_kdprduksihsl.kode_barang', 't_katagori', 't_katagori.id_katagori=t_barang.id_kategori');

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
		$data['masaaktif'] = $this->m->getpage('v_kdprduksihsl', '*', 'v_kdprduksihsl.exp ASC', $limit, $offset, $count = false, '', $cariBarang, 't_barang', 't_barang.kode_barang = v_kdprduksihsl.kode_barang', 't_katagori', 't_katagori.id_katagori=t_barang.id_kategori');

		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Laporan/LapMasaAktifAjax', $data);
	}

	public function vMasaaktif()
	{
		$tgl = $this->input->post('tgllap');
		$keyword = $this->input->post('kategori');
		$keys = $this->input->post('pencarian');

		$table = 'v_kdprduksihsl';
		$column_order = [null,];
		$column_search = [];
		$order = ['v_kdprduksihsl.exp' => 'ASC'];

		$join = [
			't_barang' => 't_barang.kode_barang = v_kdprduksihsl.kode_barang',
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
				'tgl_penjualan <=' => $akhir,
				'kode_produksi_pem !=' => 0
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
				'tgl_penjualan <=' => $akhir,
				'kode_produksi_pem !=' => 0
			];
			$where1 = '';
			$where2 = '';
		} elseif ($keyword) {
			# code...
			$where = [
				'kode_produksi_pem !=' => 0
			];
			$where1 = $keyword;
			$where2 = $keys;
		} else {
			$where  = [
				'kode_produksi_pem !=' => 0
			];
			$where1 = '';
			$where2 = '';
		}

		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2)->result_array();
		$data = [];
		$no   = $_POST['start'];
		$sub_total = 0;
		$total = 0;
		foreach ($list as $value) {
			$mingguskrng = date('yW');
			$no++;
			$row = [];
			if (!$value['kode_produksi_pem']) {
			} else {
				$row[] = $value['kode_barang'];
				$row[] = $value['nama_barang'];
				$row[] = $value['spek'];
				$row[] = $value['nama_katagori'];
				$row[] = $value['Stok'];
				$row[] = $value['kode_produksi_pem'];
				if ($value['exp'] <= $mingguskrng) {
					$row[] = '<span class="badge badge-pill badge-danger">Expired</span>';
				} elseif ($value['indikator'] <= $mingguskrng) {
					$row[] = '<span class="badge badge-pill badge-warning">Warning</span>';
				} else {
					$row[] = '<span class="badge badge-pill badge-success">Ready</span>';
				}
			}
			$data[] = $row;
		}
		$this->db->where('kode_produksi_pem !=', 0);
		$recordsTotal =  $this->m->count_all($table);
		$recordsFiltered  = $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order, $where, $where1, $where2);
		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}

	function CetakMasaAktif()
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

		$data['title'] = "Laporan Masa Kadaluarsa";
		$this->db->join('t_barang', 't_barang.kode_barang = v_kdprduksihsl.kode_barang');
		$this->db->join('t_katagori', 't_katagori.id_katagori=t_barang.id_kategori');
		$this->db->order_by('v_kdprduksihsl.exp ASC');
		$data['cetakMasaAktif'] = $this->db->get('v_kdprduksihsl')->result();

		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$html = $this->load->view('Laporan/CetakMasaAktif', $data, true);

		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
