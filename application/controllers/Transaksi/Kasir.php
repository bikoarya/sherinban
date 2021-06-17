<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('form_validation');
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 3 || $this->session->userdata('id_level') == 4) {
			$userdata = [
				'no_nota',
				'tanggal',
				'nama_pelanggan',
				'nama_mekanik'
			];
			$this->session->unset_userdata($userdata);
			$this->cart->destroy();
			$data['title'] = 'SHERIN BAN | Cetak Nota';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Kasir/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function notif_service()
	{
		$numrows = $this->db->get('t_notif_kasir')->num_rows();
		$datanotic = $this->db->get('t_notif_kasir')->result_array();
		$tglnow = date('Y-m-d H:i:s');
		$notifshow = '';
		// $tglnow = '2020-12-02 14:55:23';
		foreach ($datanotic as $key => $value) {
			if ($value['baca'] == '0') {
				if ($value['tanggal_exp'] <= $tglnow) {
					$notifshow = '1';
				} else {
					$notifshow = '0';
				}
				$baca = '0';
			} else {
				$baca = '1';
			}
		}

		$json = [
			'notif' => '<i class="fas fa-envelope mr-2"></i> ' . $numrows . ' Pesan Baru',
			'countnotif' => $numrows,
			'pesanshownotif' => $notifshow,
			'bacanotif'	=> $baca
		];
		echo json_encode($json);
	}

	public function listkasir()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 3 || $this->session->userdata('id_level') == 4) {
			$userdata = [
				'no_nota',
				'tanggal',
				'nama_pelanggan',
				'nama_mekanik'
			];
			$this->session->unset_userdata($userdata);
			$this->cart->destroy();
			$data['title'] = 'Sherin Bengkel | Cetak Nota';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Kasir/listkasir', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}


	function cariVKasir()
	{
		echo $this->cariKasir();
	}
	public function cariKasir()
	{
		$dataKasir = $this->m->join('v_kasir', 't_pelanggan', 'v_kasir.kode_pelanggan=t_pelanggan.kode_pelanggan', 't_mekanik', 'v_kasir.kode_mekanik=t_mekanik.kode_mekanik')->result_array();
		$output = '';
		foreach ($dataKasir as $key => $value) {
			if ($value['keterangan'] == 1) {
				# code...
			} else {
				# code...
				$output .= '<tr>
				<td>' . ($key + 1) . '</td>
				<td>' . $value['no_nota'] . '</td>
				<td>' . $value['tgl_penjualan'] . '</td>
				<td>' . $value['nama_pelanggan'] . '</td>
				<td>' . $value['nama_mekanik'] . '</td>
				<td>' . $value['no_polisi'] . '</td>
				
				<td><a href="javascript:void(0);" class="btn btn-primary cariksr" data-no_nota="' . $value['no_nota'] . '"data-tanggal="' . $value['tgl_penjualan'] . '"data-nama_pelanggan="' . $value['nama_pelanggan'] . '"data-nama_mekanik="' . $value['nama_mekanik'] . '" data-kode_pelanggan = "' . $value['kode_pelanggan'] . '" >Pilih</a></td>
				</tr>';
			}
		}
		// <td>
		// 			<div class="color-palette-set">
		//           <div class="bg-danger color-palette"><span>Belum Bayar</span></div>
		//         </div>
		// 		</td>
		return $output;
	}

	public function add_cart()
	{
		$no_nota = htmlspecialchars($this->input->post('no_nota'));
		$tanggal = htmlspecialchars($this->input->post('tanggal'));
		$nama_pelanggan = htmlspecialchars($this->input->post('nama_pelanggan'));
		$nama_mekanik = htmlspecialchars($this->input->post('nama_mekanik'));
		$kode_pelanggan = htmlspecialchars($this->input->post('kode_pelanggan'));

		$userdata = [
			'no_nota' => $no_nota,
			'tanggal' => $tanggal,
			'nama_pelanggan' => $nama_pelanggan,
			'nama_mekanik' => $nama_mekanik,
			'kode_pelanggan' => $kode_pelanggan
		];
		$this->session->set_userdata($userdata);

		$where = ['v_kasir.no_nota' => $no_nota];
		$this->db->join('t_penjualan', 't_penjualan.no_nota = v_kasir.no_nota');
		$this->db->join('t_barang', 't_penjualan.kode_barang = t_barang.kode_barang', 'left');
		$this->db->join('t_pelanggan', 'v_kasir.kode_pelanggan = t_pelanggan.kode_pelanggan');
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik = v_kasir.kode_mekanik');
		$this->db->join('t_satuan', 't_barang.id_satuan = t_satuan.id_satuan', 'left');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori', 'left');
		$this->db->join('t_jasa', 't_jasa.id_jasa = t_penjualan.id_jasa', 'left');
		$this->db->where($where);
		$dataKasir = $this->db->get('v_kasir')->result_array();

		$data = [
			'no_nota' => $this->input->post('no_nota'),
			'tanggal' => $this->input->post('tanggal'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'nama_mekanik' => $this->input->post('nama_mekanik')
		];
		$this->session->set_userdata($data);

		foreach ($dataKasir as $data) {
			if ($data['id_jasa'] != null) {
				# code...
				$this->db->where('id_jasa', $data['id_jasa']);
				$datajasa = $this->db->get('t_jasa')->row_array();
				$cart = [
					'id' => $data['id_jasa'],
					'name' => $data['Jasa'],
					'price' => $data['Harga_jasa'],
					'qty' => $data['jumlah_jual'],
					'nama_satuan' => '',
					'nama_katagori' => '',
					'no_nota' => $no_nota,
					'potongan' => $data['potongan'],
					'status'	=> 'Jasa',
					'jasaq_1'	=> $datajasa['q_1'],
					'jasapot_1' => $datajasa['pot_1'],
					'jasaq_2'	=> $datajasa['q_2'],
					'jasapot_2' => $datajasa['pot_2'],
					'id_jasa'	=> $datajasa['id_jasa']
				];
			} else {
				# code...
				$this->db->where('kode_barang', $data['kode_barang']);
				$databarang = $this->db->get('t_barang')->row_array();
				$cart = [
					'id' => $databarang['kode_barang'],
					'name' => $databarang['nama_barang'],
					'price' => $data['harga_jual'],
					'qty' => $data['jumlah_jual'],
					'nama_satuan' => $data['nama_satuan'],
					'nama_katagori' => $data['nama_katagori'],
					'no_nota' => $no_nota,
					'potongan' => $data['potongan'],
					'status' => 'Barang',
					'q_1'	=> $databarang['q_1'],
					'pot_1' => $databarang['pot_1'],
					'q_2'	=> $databarang['q_2'],
					'pot_2' => $databarang['pot_2'],
					'id_jasa'	=> ''
				];
			}
			// var_dump($cart);
			$this->cart->insert($cart);
			# code...
		}
	}


	public function viewP()
	{
		echo $this->cartV();
	}
	public function cartV()
	{
		$baris = '';
		$no = 1;
		$potsub = 0;
		foreach ($this->cart->contents() as $items) {
			# code...
			if ($items['id_jasa'] != null) {
				if ($items['jasaq_2'] == 0) {
					if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['jasaq_2']) {
						$potsub = $items['jasapot_2'];
					} else if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal = $items['qty'] * $potngan;
			} else {
				if ($items['q_2'] == 0) {
					if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['q_2']) {
						$potsub = $items['pot_2'];
					} else if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal = $items['qty'] * $potngan;
			}

			$baris .= '
			<tr>
			<td>' . $no++ . '</td>
			<td>' . $items['name'] . '</td>
			<td>' . $items['nama_satuan'] . '</td>
			<td>' . $items['nama_katagori'] . '</td>
			<td>' . $items['qty'] . '</td>
			<td>Rp. ' . number_format($items['price'], 0, ',', '.') . '</td>
			<td>Rp. ' . number_format($potsub, 0, ',', '.') . '</td>
			<td>Rp. ' . number_format($subtotal, 0, ',', '.') . '</td>
			<td>' . $items['status'] . '</td>
			</tr>';
		}
		return $baris;
	}

	public function total()
	{
		$subtotal = 0;
		$potsub = 0;
		foreach ($this->cart->contents() as $items) {
			# code...
			if ($items['id_jasa'] != null) {
				if ($items['jasaq_2'] == 0) {
					if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['jasaq_2']) {
						$potsub = $items['jasapot_2'];
					} else if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal += $items['qty'] * $potngan;
			} else {
				if ($items['q_2'] == 0) {
					if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['q_2']) {
						$potsub = $items['pot_2'];
					} else if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal += $items['qty'] * $potngan;
			}
		}
		echo '<input type="text" class="form-control" style="height: 50px; font-size:20px;font-weight: bold;" readonly value="' . number_format($subtotal, 0, ',', '.') . '" placeholder="Total Pembayaran" name="total_pembayaran" id="total_pembayaran">';
	}

	public function hidetotal()
	{
		$subtotal = 0;
		$potsub = 0;
		foreach ($this->cart->contents() as $items) {
			# code...
			if ($items['id_jasa'] != null) {
				if ($items['jasaq_2'] == 0) {
					if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['jasaq_2']) {
						$potsub = $items['jasapot_2'];
					} else if ($items['qty'] >= $items['jasaq_1']) {
						$potsub = $items['jasapot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal += $items['qty'] * $potngan;
			} else {
				if ($items['q_2'] == 0) {
					if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				} else {
					if ($items['qty'] >= $items['q_2']) {
						$potsub = $items['pot_2'];
					} else if ($items['qty'] >= $items['q_1']) {
						$potsub = $items['pot_1'];
					} else {
						$potsub = 0;
					}
				}

				$potngan = $items['price'] - $potsub;
				$subtotal += $items['qty'] * $potngan;
			}
		}
		echo '<input type="hidden" class="form-control" readonly id="hslbyr" value="' . $subtotal . '">';
	}

	public function printer()
	{
		foreach ($this->db->get('t_print')->result_array() as $cetak) {
			# code...
			$print = array();
			$print[] = $cetak['apikey'];
			$print[] = $cetak['port'];
			$api[]   = $print;
		}

		$output = array(
			"api" => $api
		);
		echo json_encode($output);
	}
	public function simkasirjasa()
	{
		$no_nota = htmlspecialchars($this->input->post('no_nota'));
		$tanggal = htmlspecialchars($this->input->post('tanggal'));
		$Jasa = htmlspecialchars($this->input->post('Jasa'));
		$Hjasa = htmlspecialchars($this->input->post('Hjasa'));
		$total_tunai = htmlspecialchars($this->input->post('total_tunai'));
		$kembalian = htmlspecialchars($this->input->post('kembalian'));
		$hslbyr = htmlspecialchars($this->input->post('hslbyr'));

		$insert = [
			'no_nota' => $no_nota,
			'total_pembayaran' => $hslbyr,
			'jumlah_uang' => str_replace(".", "", $total_tunai),
			'kembalian' => str_replace(".", "", $kembalian),
			'Jasa' => $Jasa
		];
		$this->db->insert('t_transjasa', $insert);
		foreach ($this->db->get('t_nota')->result_array() as $nota) {
			# code...
			$head = array();
			$head[] = $nota['nama_perusahan'];
			$head[] = $nota['alamat'];
			$head[] = $nota['notlpn'];
			$tnota[] = $head;
		}
		$output = array(
			"hslbyr" => $hslbyr,
			"total_tunai" => $total_tunai,
			"kembalian" => $kembalian,
			"tanggal" => date('d-m-Y', strtotime($tanggal)),
			"tnota" => $tnota,
			"Jasa" => $Jasa
		);


		echo json_encode($output);

		$userdata = [
			'no_nota',
			'tanggal',
			'nama_pelanggan',
			'nama_mekanik'
		];
		$this->session->unset_userdata($userdata);
		$this->cart->destroy();
	}

	public function simkasir()
	{
		$no_nota = htmlspecialchars($this->input->post('no_nota'));
		$tanggal = htmlspecialchars($this->input->post('tanggal'));
		$nama_pelanggan = htmlspecialchars($this->input->post('nama_pelanggan'));
		$total_tunai = htmlspecialchars($this->input->post('total_tunai'));
		$kembalian = htmlspecialchars(str_replace(".", "", $this->input->post('kembalian')));
		$hslbyr = htmlspecialchars($this->input->post('hslbyr'));
		$kode_pelanggan = htmlspecialchars($this->input->post('kode_pelanggan'));

		$notif = [
			'kode_pelanggan' => $kode_pelanggan,
			'keterangan'	 => 'Servis berkala',
			'tanggal_exp'	 => date("Y-m-d H:i:s", strtotime("+1 month")),
			'baca'			 => '0'
		];
		$this->db->insert('t_notif_kasir', $notif);

		$insert = [
			'no_nota' => $no_nota,
			'total_pembayaran' => $hslbyr,
			'jumlah_uang' => str_replace(".", "", $total_tunai),
			'kembalian' => str_replace(".", "", $kembalian),
			'keterangan' => '1',
			'kode_pelanggan' => $kode_pelanggan
		];
		$this->db->insert('t_kasir', $insert);

		echo json_encode('berhasil');

		$userdata = [
			'no_nota',
			'tanggal',
			'nama_pelanggan',
			'nama_mekanik'
		];
		$this->session->unset_userdata($userdata);
		$this->cart->destroy();
	}


	public function lock()
	{
		if (!empty($this->cart->total_items())) {
			$output = [
				'code' => 200
			];
			echo json_encode($output);
		} else {
			$output = [
				'code' => 500
			];
			echo json_encode($output);
		}
	}

	public function tampilkasirlist()
	{
		$tglawal =  $this->input->post('tglawal');

		$table = 'v_kasir';
		$column_order = [null, 'tgl_penjualan', 'no_nota', 'nama_pelanggan', 'nama_mekanik', 'no_polisi'];

		$column_search = ['tgl_penjualan', 'no_nota', 'nama_pelanggan', 'nama_mekanik', 'no_polisi'];
		$order = ['v_kasir.no_nota' => 'DESC', ' v_kasir.tgl_penjualan' => 'DESC'];
		$join = [
			't_pelanggan' => 'v_kasir.kode_pelanggan=t_pelanggan.kode_pelanggan',
			't_mekanik' => 'v_kasir.kode_mekanik=t_mekanik.kode_mekanik'
		];

		if ($tglawal != null) {
			$tglpecah = explode(" - ", $tglawal);
			$start = $tglpecah[0];
			$end = $tglpecah[1];
			$awal = date('Y-m-d', strtotime($start));
			$akhir = date('Y-m-d', strtotime($end));
			$where = [
				'tgl_penjualan >=' => $awal,
				'tgl_penjualan <=' => $akhir,
			];
		} else {
			$where = [
				'tgl_penjualan' => date('Y-m-d'),
			];
		}

		/**
		 * Data Site Datatables
		 */
		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order, $where)->result_array();
		$data = [];
		$no   = $_POST['start'];
		foreach ($list as $field) {
			if ($field['keterangan'] == null) {
				# code...
				$status = '<div class="color-palette-set">
				<div class="bg-danger color-palette"><span>Belum Bayar</span></div>';
				$cetak  = '<i class="fas fa-print text-danger" ></i></a>';
			} else {
				# code...
				$status = '<div class="color-palette-set">
				<div class="bg-success color-palette"><span>Lunas</span></div>';
				$cetak = '<i class="fas fa-print cetakulang text-primary" data-link=' . base_url('Transaksi/Kasir/cetakulg/') . ' data-nonota=' . $field['no_nota'] . '></i></a>';
			}
			$no++;
			$row = [];
			$row[] = $no;
			$row[] = date('d-m-Y', strtotime($field['tgl_penjualan']));
			$row[] = $field['no_nota'];
			$row[] = $field['nama_pelanggan'];
			$row[] = $field['nama_mekanik'];
			$row[] = $field['no_polisi'];
			// $row[] = $status;
			$row[]	= $cetak;
			$data[] = $row;
		}

		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table, $where),
			"recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order, $where),
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}

	public function vkasir()
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);
		$cari_key = [
			'no_nota' => $cari,
			'tgl_penjualan' => $cari,
			'nama_pelanggan' => $cari,
			'nama_mekanik' => $cari,
			'no_polisi' => $cari
		];

		$join = [
			't_pelanggan' => 'v_kasir.kode_pelanggan=t_pelanggan.kode_pelanggan',
			't_mekanik' => 'v_kasir.kode_mekanik=t_mekanik.kode_mekanik'
		];

		$ordeby = 'v_kasir.keterangan ASC, v_kasir.tgl_penjualan DESC';

		$select = '*';

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// config
		$config['base_url'] = site_url('Transaksi/Kasir/vkasir/');
		$config['total_rows'] = $this->m->getpages($select, 'v_kasir', $cari_key, '', $join, '', '', $ordeby, true, $limit, $offset);
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

		$total = $config['total_rows'];
		$start = $offset;
		$dataa = $this->m->getpages($select, 'v_kasir', $cari_key, '', $join, '', '', $ordeby, false, $limit, $offset);
		$pagelinks = $this->pagination->create_links();

		$template = [
			'table_open' => '<table class="table table-bordered table-striped">'
		];
		$this->table->set_template($template);
		$this->table->set_heading('#', 'Tanggal', 'No Nota', 'Nama Pelanggan', 'Nama Mekanik', 'No Polisi', 'Status', 'Aksi');
		foreach ($dataa as $key => $datas) :
			if ($datas['keterangan'] == null) {
				# code...
				$status = '<div class="color-palette-set">
				<div class="bg-danger color-palette"><span>Belum Bayar</span></div>';
				$cetak  = '<i class="fas fa-print text-danger" ></i></a>';
			} else {
				# code...
				$status = '<div class="color-palette-set">
				<div class="bg-success color-palette"><span>Lunas</span></div>';
				$cetak = '<i class="fas fa-print cetakulang text-primary" data-link=' . base_url('Transaksi/Kasir/notacetakulg/') . ' data-nonota=' . $datas['no_nota'] . '></i></a>';
			}
			$this->table->add_row(($key + 1), date('d-m-Y', strtotime($datas['tgl_penjualan'])), $datas['no_nota'], $datas['nama_pelanggan'], $datas['nama_mekanik'], $datas['no_polisi'], $status, $cetak);
		endforeach;
		$tabel = $this->table->generate();

		$data = [
			'table' => $tabel,
			'pagelinks' => $pagelinks
		];
		echo json_encode($data);
	}


	public function cetakulang()
	{
		$nota = $this->input->post('no_nota');

		foreach ($this->db->get('t_nota')->result_array() as $nocop) {
			# code...
			$head = array();
			$head[] = $nocop['nama_perusahan'];
			$head[] = $nocop['alamat'];
			$head[] = $nocop['notlpn'];
			$thead[] = $head;
		}

		foreach ($this->db->get('t_print')->result_array() as $cetak) {
			$print = array();
			$print[] = $cetak['apikey'];
			$print[] = $cetak['port'];
			$api[]   = $print;
		}

		$this->db->where(['t_penjualan.no_nota' => $nota]);
		$this->db->join("t_jasa", "t_jasa.id_jasa = t_penjualan.id_jasa", "left");
		$this->db->join("t_mekanik", "t_mekanik.kode_mekanik=t_penjualan.kode_mekanik", "left");
		$this->db->join("t_pelanggan", "t_pelanggan.kode_pelanggan=t_penjualan.kode_pelanggan", "left");
		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'LEFT');
		$penjualan = $this->db->get('t_penjualan')->result_array();

		foreach ($penjualan as $key => $value) {
			# code...
			$subjasa = $value['jumlah_jual'] * $value['Harga_jasa'];
			$subbrg = $value['jumlah_jual'] * $value['harga_jual'];
			$data = [];
			if ($value['id_jasa'] != 0) {
				$data[] = $value['Jasa'];
				$data[] = $value['jumlah_jual'];
				$data[] = number_format($value['Harga_jasa'], 0, ',', '.');
				$data[] = date('d-m-Y', strtotime($value['tgl_penjualan']));
				$data[] = $value['nama_pelanggan'];
				$data[] = number_format($subjasa, 0, ',', '.');
			} else {
				# code...
				$data[] = $value['nama_barang'];
				$data[] = $value['jumlah_jual'];
				$data[] = number_format($value['harga_jual'], 0, ',', '.');
				$data[] = date('d-m-Y', strtotime($value['tgl_penjualan']));
				$data[] = $value['nama_pelanggan'];
				$data[] = number_format($subbrg, 0, ',', '.');
			}

			$tdata[] = $data;
		}

		$this->db->where(['t_kasir.no_nota' => $nota]);
		$kasir = $this->db->get('t_kasir')->result_array();
		foreach ($kasir as $tkasir) {
			$ksir = [];
			$ksir[] = $tkasir['no_nota'];
			$ksir[] = number_format($tkasir['total_pembayaran'], 0, ',', '.');
			$ksir[] = number_format($tkasir['jumlah_uang'], 0, ',', '.');
			$ksir[] = number_format($tkasir['kembalian'], 0, ',', '.');
			$outkasir[] = $ksir;
		}
		redirect(base_url('Transaksi/Kasir/notacetak/' . $nota));
	}

	public function notacetakulg($nota = null)
	{
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 130], 'orientation' => 'P']);





		$this->db->join("t_pelanggan", "t_pelanggan.kode_pelanggan=t_kasir.kode_pelanggan", 'left');
		$this->db->where(['t_kasir.no_nota' => $nota]);
		$data['kasir'] = $this->db->get('t_kasir')->row_array();

		$this->db->select('*, SUM(t_penjualan.jumlah_jual) AS qty, t_penjualan.harga_jual AS hrga_jual,t_jasa.pot_1 AS jasapot_1, t_jasa.q_1 AS jasaq_1, t_jasa.q_2 AS jasaq_2, t_jasa.pot_2 AS jasapot_2');
		$this->db->where(['t_penjualan.no_nota' => $nota]);
		$this->db->order_by('t_penjualan.id_penjualan', 'DESC');
		$this->db->join("t_jasa", "t_jasa.id_jasa = t_penjualan.id_jasa", "left");
		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'LEFT');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'LEFT');
		$this->db->group_by('t_penjualan.kode_barang');
		$data['penjualan'] 	= $this->db->get('t_penjualan')->result_array();

		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik = t_penjualan.kode_mekanik');
		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan = t_penjualan.kode_pelanggan');
		$this->db->where(['t_penjualan.no_nota' => $nota]);
		$data['mekanik']	= $this->db->get('t_penjualan')->row_array();
		$data['no_nota']	= $nota;
		$data['title'] 		= 'Cetak Nota';

		$html = $this->load->view('Laporan/strukpenjualan', $data, true);

		$pdf->WriteHTML($html);
		$pdf->Output();
	}
	public function cetakulg($nota = null)
	{
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 130], 'orientation' => 'P']);

		$this->db->join("t_pelanggan", "t_pelanggan.kode_pelanggan=t_kasir.kode_pelanggan", 'left');
		$this->db->where(['t_kasir.no_nota' => $nota]);
		$data['kasir'] = $this->db->get('t_kasir')->row_array();

		$this->db->select('*, SUM(t_penjualan.jumlah_jual) AS qty, t_penjualan.harga_jual AS hrga_jual,t_jasa.pot_1 AS jasapot_1, t_jasa.q_1 AS jasaq_1, t_jasa.q_2 AS jasaq_2, t_jasa.pot_2 AS jasapot_2');
		$this->db->where(['t_penjualan.no_nota' => $nota]);
		$this->db->order_by('t_penjualan.id_penjualan', 'DESC');
		$this->db->join("t_jasa", "t_jasa.id_jasa = t_penjualan.id_jasa", "left");
		$this->db->join('t_barang', 't_barang.kode_barang = t_penjualan.kode_barang', 'LEFT');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'LEFT');
		$this->db->group_by('t_penjualan.kode_barang');
		$data['penjualan'] 	= $this->db->get('t_penjualan')->result_array();
		$this->db->join('t_mekanik', 't_mekanik.kode_mekanik = t_penjualan.kode_mekanik');
		$this->db->join('t_pelanggan', 't_pelanggan.kode_pelanggan = t_penjualan.kode_pelanggan');
		$this->db->where(['t_penjualan.no_nota' => $nota]);
		$data['mekanik']	= $this->db->get('t_penjualan')->row_array();
		$data['no_nota']	= $nota;
		$data['title'] 		= 'Cetak Nota';

		$html = $this->load->view('Laporan/struk', $data, true);

		$pdf->WriteHTML($html);
		$pdf->Output();
	}
}
