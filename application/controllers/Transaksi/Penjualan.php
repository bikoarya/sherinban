<?php

use Mpdf\Tag\Div;

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		is_login();
	}

	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2 || $this->session->userdata('id_level') == 3 || $this->session->userdata('id_level') == 4) {
			$data['nota'] = $this->m->Nota();
			$data['meka'] = $this->m->get('t_mekanik');
			$data['plgn'] = $this->m->get('t_pelanggan');
			$data['menu'] = 'Dash';
			$data['title'] = 'SHERIN BAN | Penjualan';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Penjualan/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}


	public function transaksi()
	{
		$unset_sess = [
			'txtmekanik',
			'kode_pelanggan',
			'no_polisi'
		];
		$this->session->unset_userdata($unset_sess);
		$unset_sess = [
			'kode_supplier',
			'txtno_faktur',
			'txttgl_pembelian'
		];
		$this->session->unset_userdata($unset_sess);
		$this->cart->destroy();
		$this->db->delete('t_tmppenjualan', ['id_tmppenjualan']);

		$data['pending'] = $this->m->get('t_penjualanpending');
		$data['menu'] = 'Transaksi Penjualan';
		$data['title'] = 'Sherin Bengkel | Transaksi Penjualan';
		$this->load->view('Templates/Meta', $data);
		$this->load->view('Templates/Navbar');
		$this->load->view('Templates/Menu', $data);
		$this->load->view('Penjualan/pending', $data);
		$this->load->view('Templates/Footer');
		$this->load->view('Templates/Js');
	}

	public function edittransaksi($id = null)
	{

		$data['meka'] = $this->m->get('t_mekanik');
		$data['plgn'] = $this->m->get('t_pelanggan');
		$data['menu'] = 'Dash';
		$data['title'] = 'Sherin Bengkel | Penjualan';
		$where = [
			'no_nota' => $id
		];
		$this->session->set_userdata($where);
		$this->db->where($where);
		$data['penjualanedt'] = $this->db->get('t_penjualan')->row_array();
		$this->load->view('Templates/Meta', $data);
		$this->load->view('Templates/Navbar');
		$this->load->view('Templates/Menu', $data);
		$this->load->view('Penjualan/edittrans', $data);
		$this->load->view('Templates/Footer');
		$this->load->view('Templates/Js');
	}

	public function cartisi()
	{
		$this->db->select('*,v_tmppenjualan.harga_jual AS hrgjual');
		$this->db->join('t_barang', 'v_tmppenjualan.kode_barang = t_barang.kode_barang', 'left');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'left');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori', 'left');
		$this->db->join('t_jasa', 'v_tmppenjualan.id_jasa = t_jasa.id_jasa', 'left');
		$data = $this->db->get('v_tmppenjualan')->num_rows();
		$lock = [];

		if ($data != 0) {
			$lock[] = 'buka';
		} else {
			$lock[] = 'kunci';
		}
		$datajson[] = $lock;
		$json = [
			'lock' => $datajson
		];
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}


	public function pendingview()
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);
		$cari_key = [
			't_mekanik.nama_mekanik' => $cari,
			't_pelanggan.nama_pelanggan' => $cari,
			'v_listpenjualan.no_nota' => $cari,
			'v_listpenjualan.no_polisi' => $cari
		];
		$tglnow = '';

		$join = [
			't_mekanik' => 't_mekanik.kode_mekanik = v_listpenjualan.kode_mekanik',
			't_pelanggan' => 't_pelanggan.kode_pelanggan = v_listpenjualan.kode_pelanggan'
		];

		$leftjoin = [
			't_kasir' => 'v_listpenjualan.no_nota = t_kasir.no_nota', 't_jasa' => 't_jasa.id_jasa = v_listpenjualan.id_jasa'
		];

		$select = 't_mekanik.nama_mekanik AS nama_mekanik, t_pelanggan.nama_pelanggan AS nama_pelanggan,v_listpenjualan.tgl_penjualan AS tgl_penjualan,v_listpenjualan.no_nota AS tno_nota,v_listpenjualan.no_polisi AS no_polisi,t_jasa.Jasa AS Jasa,t_kasir.no_nota AS kno_nota,t_kasir.keterangan AS ket';

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Transaksi/Penjualan/pendingview/');
		$config['total_rows'] = $this->m->getpages($select, 'v_listpenjualan', $cari_key, $tglnow, $join, $leftjoin, 'v_listpenjualan.no_nota', 'v_listpenjualan.no_nota DESC', true, $limit, $offset);
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
		$pending = $this->m->getpages($select, 'v_listpenjualan', $cari_key, $tglnow, $join, $leftjoin, 'v_listpenjualan.no_nota', 'v_listpenjualan.no_nota DESC', false, $limit, $offset);
		$pagelinks = $this->pagination->create_links();


		$template = [
			'table_open' => '<table class="table table-bordered table-striped">'
		];
		$this->table->set_template($template);
		$this->table->set_heading('#', 'Tanggal', 'No Nota', 'No Polisi', 'Pelanggan', 'Nama Mekanik', 'Status', 'Aksi');
		foreach ($pending as $key => $dtapending) :
			if ($dtapending['ket'] != null) {
				# code...
				$ket = '<span class="badge badge-success	">Selesai</span>';
				// $aksi = '<a class="text-success aksestolak" data-ket="Mohon Maaf Data Tidak Bisa Di Akses" data-title="Sudah Melakukan Transaksi"><i class="fas fa-user-edit"></i></a> <a class="text-danger aksestolak" data-ket="Mohon Maaf Data Tidak Bisa Di Akses" data-title="Sudah Melakukan Transaksi"><i class="far fa-trash-alt"></i></a>';
				$aksi = '';
			} else {
				# code...
				$ket = '<span class="badge badge-warning">Progress</span>';
				$aksi = '<a href="' . base_url("Transaksi/Penjualan/edittransaksi/") . $dtapending['tno_nota'] . '"  class="text-success"><i class="fas fa-user-edit"></i></a> <a class="text-danger hpsjual" data-no_nota="' . $dtapending['tno_nota'] . '" data-link="' . base_url('Transaksi/Penjualan/hpsjual') . '"><i class="far fa-trash-alt"></i></a> ';
				// <a class="text-primary cetakulang" data-nonota="' . $dtapending['tno_nota'] . '" data-link="' . base_url('Transaksi/Penjualan/notacetakulgjual/') . '"><i class="fas fa-print"></i></a>
			}

			$this->table->add_row($key + 1, date('d-m-Y', strtotime($dtapending['tgl_penjualan'])), $dtapending['tno_nota'], $dtapending['no_polisi'], $dtapending['nama_pelanggan'], $dtapending['nama_mekanik'], $ket, $aksi);
		endforeach;
		$tabel = $this->table->generate();

		$data = [
			'table' => $tabel,
			'pagelinks' => $pagelinks
		];
		echo json_encode($data);
	}

	public function hpsjual()
	{
		$id = htmlspecialchars($this->input->post('no_nota'));
		if ($id != null) {
			# code...
			$where = [
				'no_nota' => $id
			];
			$this->m->delete('t_penjualan', $where);
		}
	}


	public function vcridatabarang()
	{
		$table = 'v_kdprduksihsl';
		$column_order = [null, 'v_kdprduksihsl.kode_barang', 't_barang.nama_barang', 't_satuan.nama_satuan', 't_katagori.nama_katagori', 't_barang.spek', 'v_kdprduksihsl.Stok', 'v_kdprduksihsl.hrg_jual'];

		$column_search = ['v_kdprduksihsl.kode_barang', 't_barang.nama_barang', 't_satuan.nama_satuan', 't_katagori.nama_katagori', 't_barang.spek', 'v_kdprduksihsl.Stok', 'v_kdprduksihsl.hrg_jual', 'v_kdprduksihsl.kode_produksi_pem'];

		$order = ['v_kdprduksihsl.exp' => 'ASC'];
		$join = [
			't_barang' 	 => 't_barang.kode_barang = v_kdprduksihsl.kode_barang',
			't_satuan' 	 => 't_satuan.id_satuan = t_barang.id_satuan',
			't_katagori' => 't_katagori.id_katagori = t_barang.id_kategori',
		];
		/**
		 * Data Site Datatables
		 */
		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order)->result_array();
		$data = [];
		$no   = $_POST['start'];
		foreach ($list as $field) {
			$mingguskrng = date('yW');
			$no++;
			$row = [];
			$row[] = $no;
			$row[] = $field['kode_barang'];
			$row[] = $field['nama_barang'];
			$row[] = $field['nama_satuan'];
			$row[] = $field['nama_katagori'];
			$row[] = $field['spek'];
			if ($field['Stok'] <= $field['stok_min']) {
				$row[] = '<div class="bg-warning color-palette text-center"><span>' . $field['Stok'] . '</span></div>';
			} else {
				$row[] = '<div class="text-center">' . $field['Stok'] . '</div>';
			}
			$row[]	= '<div class="text-right">Rp. ' . number_format($field['harga_jual'], 0, ',', '.') . '</div>';
			if ($field['kode_produksi_pem'] == 0) {
				$row[] = 'Tidak';
			} else {
				if ($field['exp'] <= $mingguskrng) {
					$row[] = '<divRp. class="color-palette-set">
						<div class="bg-danger color-palette"><span>' . $field['kode_produksi_pem'] . '</span></div>
					</divRp.>';
				} elseif ($field['indikator'] <= $mingguskrng) {
					$row[] = '<div class="color-palette-set">
						<div class="bg-warning color-palette"><span>' . $field['kode_produksi_pem'] . '</span></div>
					</div>';
				} else {
					$row[] = $field['kode_produksi_pem'];
				}
			}

			if ($field['Stok'] <= $field['stok_min']) {
				$row[] = '<a href="javascript:void(0);" class="btn btn-primary stkkurang" data-kode_brg="' . $field['kode_barang'] . '" data-nama_barang="' . $field['nama_barang'] . '" data-harga_jual="' . $field['harga_jual'] . '" data-harga_beli="' . $field['harga_beli'] . '" data-satuan="' . $field['nama_satuan'] . '" data-kategori="' . $field['nama_katagori'] . '" data-kode_produksi="' . $field['kode_produksi_pem'] . '" data-nofaktur="' . $field['no_faktur'] . '" data-qty="' . $field['Stok'] . '" data-qty1="' . $field['q_1'] . '" data-pot1="' . $field['pot_1'] . '" data-pot2="' . $field['pot_2'] . '" data-qty2="' . $field['q_2'] . '">Pilih</a>';
			} else {
				$row[] = '<a href="javascript:void(0);" class="btn btn-primary caripenjualan" data-kode_brg="' . $field['kode_barang'] . '" data-nama_barang="' . $field['nama_barang'] . '" data-harga_jual="' . $field['harga_jual'] . '" data-harga_beli="' . $field['harga_beli'] . '" data-satuan="' . $field['nama_satuan'] . '" data-kategori="' . $field['nama_katagori'] . '" data-kode_produksi="' . $field['kode_produksi_pem'] . '" data-nofaktur="' . $field['no_faktur'] . '" data-qty="' . $field['Stok'] . '" data-qty1="' . $field['q_1'] . '" data-pot1="' . $field['pot_1'] . '" data-pot2="' . $field['pot_2'] . '" data-qty2="' . $field['q_2'] . '">Pilih</a>';
			}
			$data[] = $row;
		}

		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $this->m->count_filtered(null, $table, $join, $column_order, $column_search, $order),
			"data" => $data
		];
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}


	function cartV()
	{
		$baris = '';
		$no = 1;
		$subtotal = 0;
		$this->db->select('*,v_tmppenjualpot.harga_jual AS hrgjual');
		$this->db->join('t_barang', 'v_tmppenjualpot.kode_barang = t_barang.kode_barang', 'left');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'left');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori', 'left');
		$this->db->join('t_jasa', 'v_tmppenjualpot.id_jasa = t_jasa.id_jasa', 'left');
		$data = $this->db->get('v_tmppenjualpot')->result_array();
		foreach ($data as $items) {
			if ($items['id_jasa'] != 0) {
				# code...
				$kdbrg = $items['id_jasa'];
				$nmbrg = $items['Jasa'];
				$nmastuan = '';
				$nmaktg = '';
			} else {
				# code...
				$kdbrg = $items['kode_barang'];
				$nmbrg = $items['nama_barang'];
				$nmastuan = $items['nama_satuan'];
				$nmaktg = $items['nama_katagori'];
			}
			# code...
			$pot = $items['hrgjual'] - $items['potongan'];
			$subtotal = $items['qty'] * $pot;
			$baris .= '
			<tr>
			<td>' . $kdbrg . '</td>
			<td>' . $nmbrg . '</td>
			<td>' .  $nmastuan . '</td>
			<td>' . $nmaktg . '</td>
			<td>' . $items['spek'] . '</td>
			<td>' . $items['kode_produksi'] . '</td>
			<td>' . $items['qty'] . '</td>
			<td>Rp. ' . number_format($items['hrgjual'], 0, ',', '.') . '</td>
			<td>Rp. ' . number_format($items['potongan'], 0, ',', '.') . '</td>
			<td>Rp. ' . number_format($subtotal, 0, ',', '.') . '</td>

			<td><a class="hapuscart" data-id="' . $kdbrg . '" data-prds="' . $items['kode_produksi'] . '"><i class="far fa-trash-alt text-danger fa-fw" style="font-size: 20px"></i></a></td>
			</tr>';
		}
		return $baris;
	}

	function viewP()
	{
		echo $this->cartV();
	}

	public function subtotal()
	{
		$subtotal = 0;
		$this->db->select('*,v_tmppenjualpot.harga_jual AS hrgjual');
		$this->db->join('t_barang', 'v_tmppenjualpot.kode_barang = t_barang.kode_barang', 'left');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'left');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori', 'left');
		$this->db->join('t_jasa', 'v_tmppenjualpot.id_jasa = t_jasa.id_jasa', 'left');
		$data = $this->db->get('v_tmppenjualpot')->result_array();
		foreach ($data as $items) {
			$pot = $items['hrgjual'] - $items['potongan'];
			$subtotal += $items['qty'] * $pot;
		}
		echo 'Rp. ' . number_format($subtotal, 0, ',', '.');
	}

	function add_cart()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$kode_barang = htmlspecialchars($this->input->post('kode_barang'));
		$nama_barang = htmlspecialchars($this->input->post('nm_brg'));
		$satuan = htmlspecialchars($this->input->post('satuan'));
		$kategori = htmlspecialchars($this->input->post('kategori'));
		$harga_jual = htmlspecialchars($this->input->post('hrg_jual'));
		$kode_produksi = htmlspecialchars($this->input->post('kode_produksi'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$nofaktur = htmlspecialchars($this->input->post('nofaktur'));

		$txtidjasa = htmlspecialchars($this->input->post('txtidjasa'));


		$qty1 = htmlspecialchars($this->input->post('qty1'));
		$qty2 = htmlspecialchars($this->input->post('qty2'));
		$pot1 = htmlspecialchars($this->input->post('pot1'));
		$pot2 = htmlspecialchars($this->input->post('pot2'));

		$data = [
			'txtmekanik' => $this->input->post('txtmekanik'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_polisi' => $this->input->post('no_polisi')
		];
		$this->session->set_userdata($data);


		$this->db->select('SUM(t_tmppenjualan.qty) AS jmlqty,potongan,kode_barang,q_1,q_2,pot_1,pot_2,kode_produksi');
		// $this->db->where('t_tmppenjualan.kode_produksi', $kode_produksi);
		$this->db->where('t_tmppenjualan.kode_barang', $kode_barang);
		$this->db->group_by('t_tmppenjualan.kode_barang');
		$vdatapot = $this->db->get('t_tmppenjualan')->row_array();


		$this->db->select('SUM(t_tmppenjualan.qty) AS jmlqty,potongan,kode_barang,q_1,q_2,pot_1,pot_2,kode_produksi');
		// $this->db->where('t_tmppenjualan.kode_produksi', $kode_produksi);
		$this->db->where('t_tmppenjualan.kode_barang', $kode_barang);
		$this->db->group_by('t_tmppenjualan.kode_barang');
		$tmppenjualan = $this->db->get('t_tmppenjualan')->result_array();

		if ($id != null) {

			$this->db->where('no_nota', $id);
			$penjul = $this->db->get('t_penjualan')->result_array();
			foreach ($penjul as $key => $penjualan) {
				# code...
				$cart = [
					'kode_barang' => $penjualan['kode_barang'],
					'harga_jual' => $penjualan['harga_jual'],
					'qty' => $penjualan['jumlah_jual'],
					'nofaktur' => $penjualan['no_faktur'],
					'kode_produksi' => $penjualan['kode_produksi_pen'],
					'id_jasa' => $penjualan['id_jasa'],
				];
				$this->db->insert('t_tmppenjualan', $cart);
			}
		} else {
			# code...
			if ($txtidjasa != null) {
				$cart = [
					'id_jasa' => $txtidjasa,
					'kode_barang' => $txtidjasa,
					'nama_barang' => $nama_barang,
					'harga_jual'  => $harga_jual,
					'nofaktur' => $nofaktur,
					'qty' => $jumlah,
					'q_1'	=> $qty1,
					'pot_1'	=> $pot1,
					'q_2'	=> $qty2,
					'pot_2'	=> $pot2,
					'kode_produksi' => 0,
				];
				$datajasa =
					[
						'del' => 1
					];
				$this->db->update('t_jasa', $datajasa, ['id_jasa' => $txtidjasa]);
				$this->m->insert('t_tmppenjualan', $cart);
			} else {
				$qtypotongan = 0;
				$potongan = 0;

				if ($vdatapot['kode_barang'] != null) {
					if ($vdatapot['kode_produksi'] == $kode_produksi) {
						$cart = [
							'nama_barang' => $nama_barang,
							'harga_jual' => $harga_jual,
							'qty' => $jumlah,
							'satuan' => $satuan,
							'kategori' => $kategori,
							'kode_barang' => $kode_barang,
							'nofaktur' => $nofaktur,
							'kode_produksi' => $kode_produksi,
							'q_1'	=> $qty1,
							'q_2'	=> $qty2,
							'pot_1'	=> $pot1,
							'pot_2'	=> $pot2
						];
						$this->m->insert('t_tmppenjualan', $cart);

						$qtypotongan =  $vdatapot['jmlqty'] + $jumlah;
						foreach ($tmppenjualan as $key => $valdata) {
							if ($valdata['q_2'] == 0) {
								if ($qtypotongan >= $valdata['q_1']) {
									$potongan = $valdata['pot_1'];
								}
							} else {
								if ($qtypotongan >= $valdata['q_2']) {
									$potongan = $valdata['pot_2'];
								} else if ($qtypotongan >= $valdata['q_1']) {
									$potongan = $valdata['pot_1'];
								}
							}
							$cart = [
								'potongan' => $potongan
							];
							$this->db->where('t_tmppenjualan.kode_barang', $kode_barang);
							$this->db->update('t_tmppenjualan', $cart);
						}
					} else {
						$cart = [
							'nama_barang' => $nama_barang,
							'harga_jual' => $harga_jual,
							'qty' => $jumlah,
							'satuan' => $satuan,
							'kategori' => $kategori,
							'kode_barang' => $kode_barang,
							'nofaktur' => $nofaktur,
							'kode_produksi' => $kode_produksi,
							'q_1'	=> $qty1,
							'q_2'	=> $qty2,
							'pot_1'	=> $pot1,
							'pot_2'	=> $pot2
						];
						$this->m->insert('t_tmppenjualan', $cart);

						$qtypotongan =  $vdatapot['jmlqty'] + $jumlah;

						foreach ($tmppenjualan as $key => $valdata) {
							if ($valdata['q_2'] == 0) {
								if ($qtypotongan >= $valdata['q_1']) {
									$potongan = $valdata['pot_1'];
								}
							} else {
								if ($qtypotongan >= $valdata['q_2']) {
									$potongan = $valdata['pot_2'];
								} else if ($qtypotongan >= $valdata['q_1']) {
									$potongan = $valdata['pot_1'];
								}
							}
							$cart = [
								'potongan' => $potongan
							];
							$this->db->where('t_tmppenjualan.kode_barang', $kode_barang);
							$this->db->update('t_tmppenjualan', $cart);
						}
					}
				} else {
					$cart = [
						'nama_barang' => $nama_barang,
						'harga_jual' => $harga_jual,
						'qty' => $jumlah,
						'satuan' => $satuan,
						'kategori' => $kategori,
						'kode_barang' => $kode_barang,
						'nofaktur' => $nofaktur,
						'kode_produksi' => $kode_produksi,
						'q_1'	=> $qty1,
						'q_2'	=> $qty2,
						'pot_1'	=> $pot1,
						'pot_2'	=> $pot2
					];
					$this->m->insert('t_tmppenjualan', $cart);
				}

				// if ($vdatapot['kode_barang'] != null) {
				// 	$qtypotongan =  $vdatapot['jmlqty'] + $jumlah;

				// 	if ($vdatapot['jmlqty'] <= $qtypotongan) {
				// 		$potongan = 0;
				// 		foreach ($tmppenjualan as $key => $valdata) {
				// 			var_dump('potongan');
				// 			if ($valdata['q_2'] == 0) {
				// 				if ($qtypotongan >= $valdata['q_1']) {
				// 					$potongan = $valdata['pot_1'];
				// 				}
				// 			} else {
				// 				if ($qtypotongan >= $valdata['q_2']) {
				// 					$potongan = $valdata['pot_2'];
				// 				} else if ($qtypotongan >= $valdata['q_1']) {
				// 					$potongan = $valdata['pot_1'];
				// 				}
				// 			}
				// 			$cart = [
				// 				'potongan' => $potongan
				// 			];
				// 			$this->db->where('t_tmppenjualan.kode_barang', $kode_barang);
				// 			$this->db->update('t_tmppenjualan', $cart);
				// 		}
				// 	} else {
				// 		$cart = [
				// 			'nama_barang' => $nama_barang,
				// 			'harga_jual' => $harga_jual,
				// 			'qty' => $jumlah,
				// 			'satuan' => $satuan,
				// 			'kategori' => $kategori,
				// 			'kode_barang' => $kode_barang,
				// 			'nofaktur' => $nofaktur,
				// 			'kode_produksi' => $kode_produksi,
				// 			'q_1'	=> $qty1,
				// 			'q_2'	=> $qty2,
				// 			'pot_1'	=> $pot1,
				// 			'pot_2'	=> $pot2
				// 		];
				// 		$this->m->insert('t_tmppenjualan', $cart);
				// 	}
				// } else {
				// 	$cart = [
				// 		'nama_barang' => $nama_barang,
				// 		'harga_jual' => $harga_jual,
				// 		'qty' => $jumlah,
				// 		'satuan' => $satuan,
				// 		'kategori' => $kategori,
				// 		'kode_barang' => $kode_barang,
				// 		'nofaktur' => $nofaktur,
				// 		'kode_produksi' => $kode_produksi,
				// 		'q_1'	=> $qty1,
				// 		'q_2'	=> $qty2,
				// 		'pot_1'	=> $pot1,
				// 		'pot_2'	=> $pot2
				// 	];
				// 	$this->m->insert('t_tmppenjualan', $cart);
				// }
			}
		}

		echo $this->viewP();
	}

	function addjasa()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$jasa = htmlspecialchars($this->input->post('jasa'));
		$harga = htmlspecialchars($this->input->post('harga'));
		$nofaktur = htmlspecialchars($this->input->post('nofaktur'));
		$data = [
			'txtmekanik' => $this->input->post('txtmekanik'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_polisi' => $this->input->post('no_polisi')
		];
		$this->session->set_userdata($data);
		$cart = [
			'id_jasa' => $id,
			'kode_barang' => $id,
			'nama_barang' => $jasa,
			'harga_jual'  => $harga,
			'nofaktur' => $nofaktur,
			'qty' => 1,
		];
		$this->m->insert('t_tmppenjualan', $cart);
		echo $this->viewP();
	}

	function rowid()
	{
		foreach ($this->cart->contents() as $items) {
			# code...
			$kdbarang = $items['kode_barang'];
			$kdprdski = $items['kode_produksi'];
			$rowid = $items['rowid'];
			$qty = $items['qty'];
			var_dump($rowid);
		}
	}

	function hapuscart()
	{ //fungsi untuk menghapus item cart
		$data = array(
			'kode_barang' => $this->input->post('id'),
			'kode_produksi' => $this->input->post('kdprd')
		);
		$this->m->delete('t_tmppenjualan', $data);
		echo $this->cartV();
	}

	function insertPelanggan()
	{
		$data = [
			'kode_pelanggan' => $this->m->pel(),
			'nama_pelanggan' => htmlspecialchars($this->input->post('nma_pelanggan')),
			'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pel')),
			'telepon_pelanggan' => htmlspecialchars($this->input->post('no_tlp'))
		];
		$this->m->insert('t_pelanggan', $data);
	}

	function simpan_penjualan()
	{
		$txtmekanik = $this->session->userdata('txtmekanik');
		$kode_pelanggan = $this->session->userdata('kode_pelanggan');
		$no_polisi = $this->session->userdata('no_polisi');
		$this->session->set_userdata('nota', $this->m->Nota());
		$database = $this->m->get('v_tmppenjualpot');
		if (!empty($txtmekanik)  && !empty($kode_pelanggan) && !empty($no_polisi)) {
			if (empty(count($database))) {
				$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
			} else {
				foreach ($database as $items) {
					if ($items['id_jasa'] != null) {
						# code...
						$data = [
							'no_nota' 			=> $this->session->userdata('nota'),
							'tgl_penjualan' 	=> date('Y-m-d'),
							'kode_pelanggan' 	=> $kode_pelanggan,
							'no_polisi' 		=> $no_polisi,
							'kode_barang' 		=> $items['kode_barang'],
							'id_jasa' 			=> $items['id_jasa'],
							'kode_produksi_pen' => $items['kode_produksi'],
							'jumlah_jual' 		=> $items['qty'],
							'harga_jual' 		=> $items['harga_jual'],
							'no_faktur'		 	=> $items['nofaktur'],
							'kode_mekanik' 		=> $txtmekanik,
							'potongan'			=> $items['potongan']
						];
					} else {
						# code...
						$data = [
							'no_nota' 			=> $this->session->userdata('nota'),
							'tgl_penjualan'		=> date('Y-m-d'),
							'kode_pelanggan' 	=> $kode_pelanggan,
							'no_polisi' 		=> $no_polisi,
							'kode_barang' 		=> $items['kode_barang'],
							'kode_produksi_pen' => $items['kode_produksi'],
							'jumlah_jual' 		=> $items['qty'],
							'harga_jual' 		=> $items['harga_jual'],
							'no_faktur' 		=> $items['nofaktur'],
							'kode_mekanik' 		=> $txtmekanik,
							'potongan'			=> $items['potongan']
						];
					}
					$this->db->insert('t_penjualan', $data);
				}
				$unset_sess = [
					'txtmekanik',
					'kode_pelanggan',
					'no_polisi',
					'nota'
				];
				$this->session->unset_userdata($unset_sess);
				$this->cart->destroy();
				$this->db->delete('t_tmppenjualan', ['id_tmppenjualan']);
				$this->session->set_flashdata('berhasil', 'Data Berhasil Di Simpan');
				redirect('Transaksi/Penjualan/transaksi');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
			redirect('Transaksi/Penjualan');
		}
	}

	function smpanedit()
	{
		$txtmekanik = $this->session->userdata('txtmekanik');
		$kode_pelanggan = $this->session->userdata('kode_pelanggan');
		$no_polisi = $this->session->userdata('no_polisi');
		$this->session->set_userdata('nota', $this->m->Nota());
		$database = $this->m->get('v_tmppenjualan');
		if (!empty($txtmekanik)  && !empty($kode_pelanggan) && !empty($no_polisi)) {
			if (empty(count($database))) {
				$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
				// redirect('Transaksi/Penjualan');

			} else {
				foreach ($database as $items) {
					if ($items['id_jasa'] != null) {
						# code...
						$data = [
							'no_nota' => $this->session->userdata('nota'),
							'tgl_penjualan' => date('Y-m-d'),
							'kode_pelanggan' => $kode_pelanggan,
							'no_polisi' => $no_polisi,
							'kode_barang' => $items['kode_barang'],
							'id_jasa' => $items['id_jasa'],
							'kode_produksi_pen' => 0,
							'jumlah_jual' => $items['qty'],
							'harga_jual' => $items['harga_jual'],
							'no_faktur' => $items['nofaktur'],
							'kode_mekanik' => $txtmekanik
						];
					} else {
						# code...
						$data = [
							'no_nota' => $this->session->userdata('nota'),
							'tgl_penjualan' => date('Y-m-d'),
							'kode_pelanggan' => $kode_pelanggan,
							'no_polisi' => $no_polisi,
							'kode_barang' => $items['kode_barang'],
							'kode_produksi_pen' => $items['kode_produksi'],
							'jumlah_jual' => $items['qty'],
							'harga_jual' => $items['harga_jual'],
							'no_faktur' => $items['nofaktur'],
							'kode_mekanik' => $txtmekanik
						];
					}
					$this->db->insert('t_penjualan', $data);
				}
				$unset_sess = [
					'txtmekanik',
					'kode_pelanggan',
					'no_polisi',
					'nota'
				];
				$this->session->unset_userdata($unset_sess);
				$this->cart->destroy();
				$this->db->delete('t_tmppenjualan', ['id_tmppenjualan']);
				$this->session->set_flashdata('berhasil', 'Data Berhasil Di Simpan');
				redirect('Transaksi/Penjualan/transaksi');
			}
		} else {

			$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
			redirect('Transaksi/Penjualan');
		}
	}



	function edittable($id = null)
	{
		$this->db->select('*,t_penjualan.harga_jual AS hrgjual,SUM(t_penjualan.jumlah_jual) AS stok');
		$this->db->join('t_barang', 't_penjualan.kode_barang = t_barang.kode_barang', 'left');
		$this->db->join('t_satuan', 't_satuan.id_satuan = t_barang.id_satuan', 'left');
		$this->db->join('t_katagori', 't_katagori.id_katagori = t_barang.id_kategori', 'left');
		$this->db->join('t_jasa', 't_penjualan.id_jasa = t_jasa.id_jasa', 'left');
		$this->db->where("no_nota", $id);
		$this->db->group_by("t_penjualan.kode_barang");
		$this->db->group_by("t_penjualan.kode_produksi_pen");
		$data = $this->db->get("t_penjualan")->result_array();
		$template = [
			'table_open' => '<table id="transpembelian" class="table table-bordered table-hover">'
		];
		$this->table->set_template($template);
		$this->table->set_heading('#', 'no_nota', 'Kode Barang', 'Nama Barang', 'Satuan', 'Kategori', 'Kode Produksi', 'Qty', 'Harga', 'Pot',  'Total', 'Aksi');
		$subttl = 0;
		foreach ($data as $key => $dtaedt) :


			if ($dtaedt['id_jasa'] != 0) {
				# code...
				$kdbrg = $dtaedt['id_jasa'];
				$nmbrg = $dtaedt['Jasa'];
				$nmastuan = '';
				$nmaktg = '';
			} else {
				# code...
				$kdbrg = $dtaedt['kode_barang'];
				$nmbrg = $dtaedt['nama_barang'];
				$nmastuan = $dtaedt['nama_satuan'];
				$nmaktg = $dtaedt['nama_katagori'];
			}
			$potsub = $dtaedt['hrgjual'] - $dtaedt['potongan'];
			$subttl = $dtaedt['stok'] * $potsub;
			$this->table->add_row($key + 1, $dtaedt['no_nota'], $kdbrg, $nmbrg, $nmastuan, $nmaktg,  $dtaedt['kode_produksi_pen'], $dtaedt['stok'], number_format($dtaedt['hrgjual'], 0, ',', '.'), number_format($dtaedt['potongan'], 0, ',', '.'),  number_format($subttl, 0, ",", "."), '<a class="hpsedt" data-link="' . base_url("Transaksi/Penjualan/hpsedt/") . '" data-id = "' . $dtaedt['id_penjualan'] . '" data-kdbrg = "' . $dtaedt['kode_barang'] . '"  data-kdprd = "' . $dtaedt['kode_produksi_pen'] . '" data-id_jasa="' . $dtaedt['id_jasa'] . '" data-no_nota="' . $dtaedt['no_nota'] . '"><i class="far fa-trash-alt text-danger fa-fw" style="font-size: 20px"></i></a>');
		endforeach;
		$tabel = $this->table->generate();

		$output = [
			'tabel' => $tabel
		];
		echo json_encode($output);
	}

	public function hpsedt()
	{
		$kdbrg = $this->input->post("kdbrg");
		$kdprd = $this->input->post("kdprd");
		$id_jasa = $this->input->post("id_jasa");
		$id = $this->input->post("id");
		$no_nota = $this->input->post("no_nota");
		if ($id_jasa != null) {
			$this->db->where('id_jasa', $id_jasa);
			$this->db->where('no_nota', $no_nota);
		} else {
			# code...
			$this->db->where('kode_barang', $kdbrg);
			$this->db->where('kode_produksi_pen', $kdprd);
			$this->db->where('no_nota', $no_nota);
		}

		$hps = $this->db->delete("t_penjualan");
		echo json_encode($hps);
	}


	public function edittambah()
	{
		$id = $this->session->userdata("no_nota");
		$kode_barang = htmlspecialchars($this->input->post('kode_barang'));
		$harga_jual = htmlspecialchars($this->input->post('hrg_jual'));
		$kode_produksi = htmlspecialchars($this->input->post('kode_produksi'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$nofaktur = htmlspecialchars($this->input->post('nofaktur'));
		$kode_pelanggan = htmlspecialchars($this->input->post('kode_pelanggan1'));
		$no_polisi = htmlspecialchars($this->input->post('no_polisi'));
		$kode_mekanik = htmlspecialchars($this->input->post('txtmekanik1'));

		$txtidjasa = htmlspecialchars($this->input->post('txtidjasa'));

		$qty1 = htmlspecialchars($this->input->post('qty1'), true);
		$qty2 = htmlspecialchars($this->input->post('qty2'), true);
		$pot2 = htmlspecialchars($this->input->post('pot2'), true);
		$pot1 = htmlspecialchars($this->input->post('pot1'), true);

		$data = [
			'txtmekanik' => $this->input->post('txtmekanik'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_polisi' => $this->input->post('no_polisi')
		];
		$this->session->set_userdata($data);
		# code...
		$this->db->where('kode_barang', $kode_barang);
		$this->db->where('kode_produksi_pen', $kode_produksi);
		$this->db->where('no_nota', $id);
		$editdata = $this->db->get('t_penjualan')->row_array();
		$jmlh = $editdata['jumlah_jual'] + $jumlah;

		if (!$qty2) {
			if ($jmlh >= $qty1) {
				$potedt = $pot1;
			} elseif ($jmlh >= $qty2) {
				$potedt = $pot2;
			} else {
				$potedt = 0;
			}
		} else {
			if ($jmlh >= $qty2) {
				$potedt = $pot2;
			} elseif ($jmlh >= $qty1) {
				$potedt = $pot1;
			} else {
				$potedt = 0;
			}
		}


		if ($editdata['kode_barang'] == $kode_barang && $editdata['kode_produksi_pen'] == $kode_produksi) {

			$this->db->where('no_nota', $id);
			$this->db->where('id_jasa', $txtidjasa);
			$searcing = $this->db->get('t_penjualan')->row_array();
			$jmlhjasa = $searcing['jumlah_jual'] + $jumlah;
			if (!$qty2) {
				if ($jmlhjasa >= $qty1) {
					$potjasa = $pot1;
				} else {
					$potjasa = 0;
				}
			} else {
				if ($jmlhjasa >= $qty2) {
					$potjasa = $pot2;
				} elseif ($jmlhjasa >= $qty1) {
					# code...
					$potjasa = $pot1;
				} else {
					$potjasa = 0;
				}
			}

			if ($txtidjasa != null) {
				if ($searcing['id_jasa'] == null) {
					$cart = [
						'no_nota'			=> $id,
						'tgl_penjualan' 	=> date("Y-m-d"),
						'kode_barang' 		=> $kode_barang,
						'kode_produksi_pen' => 0,
						'jumlah_jual' 		=> $jumlah,
						'harga_jual' 		=> $harga_jual,
						'no_faktur' 		=> $nofaktur,
						'no_polisi' 		=> $no_polisi,
						'kode_pelanggan' 	=> $kode_pelanggan,
						'kode_mekanik'		=> $kode_mekanik,
						'potongan'			=> $potjasa,
						'id_jasa'			=> $txtidjasa
					];
					$this->m->insert('t_penjualan', $cart);
				} else {
					$cart = [
						'id_jasa'		 => $txtidjasa,
						'no_nota' 		 => $id,
						'kode_barang' 	 => $txtidjasa,
						'harga_jual'  	 => $harga_jual,
						'no_faktur' 	 => $nofaktur,
						'jumlah_jual'	 => $jmlhjasa,
						'no_polisi' 	 => $no_polisi,
						'potongan'		 => $potjasa
					];
					$this->db->where('no_nota', $id);
					$this->db->where('id_jasa', $txtidjasa);
					$this->db->update('t_penjualan', $cart);
				}
			} else {
				$this->db->where('kode_barang', $kode_barang);
				$this->db->where('kode_produksi_pem', $kode_produksi);
				$stkupdate = $this->db->get('t_stok')->row_array();
				$stok = [
					'stok' => $stkupdate['stok'] - $jumlah
				];
				$this->db->where('kode_barang', $kode_barang);
				$this->db->where('kode_produksi_pem', $kode_produksi);
				$this->db->update('t_stok', $stok);

				$edtcart = [
					'kode_barang' 		=> $kode_barang,
					'kode_produksi_pen' => $kode_produksi,
					'jumlah_jual' 		=> $jmlh,
					'potongan'			=> $potedt
				];
				$this->db->where('no_nota', $id);
				$this->db->where('kode_barang', $kode_barang);
				$this->db->where('kode_produksi_pen', $kode_produksi);
				$this->db->update('t_penjualan', $edtcart);
			}
		} else {

			$cart = [
				'no_nota'			=> $id,
				'tgl_penjualan' 	=> date("Y-m-d"),
				'kode_barang' 		=> $kode_barang,
				'kode_produksi_pen' => $kode_produksi,
				'jumlah_jual' 		=> $jumlah,
				'harga_jual' 		=> $harga_jual,
				'no_faktur' 		=> $nofaktur,
				'no_polisi' 		=> $no_polisi,
				'kode_pelanggan' 	=> $kode_pelanggan,
				'kode_mekanik'		=> $kode_mekanik,
				'potongan'			=> $potedt
			];

			$this->m->insert('t_penjualan', $cart);
		}
	}

	function editjasa()
	{
		$nota = $this->session->userdata('no_nota');
		$id = htmlspecialchars($this->input->post('id'));
		$harga = htmlspecialchars($this->input->post('harga'));
		$nofaktur = htmlspecialchars($this->input->post('nofaktur'));
		$no_polisi = htmlspecialchars($this->input->post('no_polisi'));
		$txtmekanik = htmlspecialchars($this->input->post('txtmekanik'));
		$kode_pelanggan = htmlspecialchars($this->input->post('kode_pelanggan'));

		$data = [
			'txtmekanik' => $txtmekanik,
			'kode_pelanggan' => $kode_pelanggan,
			'no_polisi' => $no_polisi
		];
		$this->session->set_userdata($data);

		$cart = [
			'no_nota' => $nota,
			'tgl_penjualan' => date("Y-m-d"),
			'id_jasa' => $id,
			'kode_barang' => $id,
			'harga_jual'  => $harga,
			'no_faktur' => $nofaktur,
			'jumlah_jual' => 1,
			'no_polisi' => $no_polisi,
			'kode_pelanggan' => $kode_pelanggan,
			'kode_mekanik'	=> $txtmekanik
		];
		$this->m->insert('t_penjualan', $cart);
	}


	function listjasa()
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);
		$cari_key = [
			'Jasa' => $cari,
			'Harga_jasa' => $cari
		];

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Jasa/listjasa/');
		$config['total_rows'] = $this->m->getpage('t_jasa', '*', '', $limit, $offset, $count = true, $cari_key);
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
		$jasa = $this->m->getpage('t_jasa', '*', '', $limit, $offset, $count = false, $cari_key);
		$pagelinks = $this->pagination->create_links();

		$template = [
			'table_open' => '<table class="table table-bordered table-striped">'
		];
		$this->table->set_template($template);
		$this->table->set_heading('#', 'Jenis Jasa', 'Harga', 'Aksi');
		foreach ($jasa as $key => $dtajsa) :
			$this->table->add_row($key + 1, $dtajsa['Jasa'], number_format($dtajsa['Harga_jasa'], 0, ',', '.'), '<a class="btn btn-success text-white jasapilih" data-id="' . $dtajsa['id_jasa'] . '" data-jasa="' . $dtajsa['Jasa'] . '" data-harga="' . $dtajsa['Harga_jasa'] . '" data-qty="' . $dtajsa['q_1'] . '" data-pot="' . $dtajsa['pot_1'] . '" data-qty2="' . $dtajsa['q_2'] . '" data-pot2="' . $dtajsa['pot_2'] . '">Pilih</a>');
		endforeach;

		$data = [
			'table' => $this->table->generate(),
			'pagelinks' => $pagelinks
		];
		echo json_encode($data);
	}


	public function selectpelanggan()
	{
		$plgn = $this->m->get('t_pelanggan');
		$plgan = $this->session->userdata('kode_pelanggan');
		foreach ($plgn as $pel) {
			# code...
			$datapel = [];
			if ($plgan == $pel['kode_pelanggan']) {
				$datapel[] = '<option value="' . $pel['kode_pelanggan'] . '" selected> ' . $pel['nama_pelanggan'] . '</option>';
			} else {
				# code...
				if ($pel['kode_pelanggan'] == 'PEL0001') {
					# code...
					$datapel[] = '<option value="' . $pel['kode_pelanggan'] . '" selected> ' . $pel['nama_pelanggan'] . '</option>';
				} else {
					# code...
					$datapel[] = '<option value="' . $pel['kode_pelanggan'] . '"> ' . $pel['nama_pelanggan'] . '</option>';
				}
			}

			$outpel[] = $datapel;
		}
		for ($i = 0; $i < count($outpel); $i++) {
			# code...
			$planggan = [];
			$planggan = $outpel[$i][0];
			$outplanggan[] = $planggan;
		}
		$output = '	<option value=""></option>
		<option value="PelangganBaru">Pelanggan Baru</option>' . implode($outplanggan) . '';
		echo json_encode($output);
	}


	public function notacetakulgjual($nota = null)
	{
		$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 130], 'orientation' => 'P']);
		// $pdf->AddPage();
		$this->db->join("t_pelanggan", "t_pelanggan.kode_pelanggan=t_kasir.kode_pelanggan", 'left');
		$this->db->where(['t_kasir.no_nota' => $nota]);
		$data['kasir'] = $this->db->get('t_kasir')->row_array();
		$this->db->select('*, SUM(t_penjualan.jumlah_jual) AS qty');
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
}
