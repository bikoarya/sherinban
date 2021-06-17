<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
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
			$tmppembelian = $this->db->get('v_tmppembelian')->num_rows();
			if (!empty($tmppembelian)) {
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
				$this->db->empty_table('t_tmppembelian');
				redirect('Gudang/Pembelian');
			} else {
				# code...
				$data['sup'] = $this->m->get('t_supplier');
				$data['menu'] = 'Dash';
				$data['title'] = 'SHERIN BAN | Pembelian';
				$this->load->view('Templates/Meta', $data);
				$this->load->view('Templates/Navbar');
				$this->load->view('Templates/Menu', $data);
				$this->load->view('Pembelian/Index', $data);
				$this->load->view('Templates/Footer');
				$this->load->view('Templates/Js');
			}
		} else {
			redirect('Notfound');
		}
	}

	public function cribrng($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = "nama_barang,kode_barang,spek,harga_jual,harga_beli,stok_min,t_katagori.nama_katagori,t_satuan.nama_satuan";
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// config
		$config['base_url'] = site_url('Gudang/Pembelian/cribrng/');
		$config['total_rows'] = $this->m->getpage('t_barang', '*', '', $limit, $offset, $count = true, $keydata, $cari_key, 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan');
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
		$data['barang'] = $this->m->getpage('t_barang', '*', '', $limit, $offset, $count = false, $keydata, $cari_key, 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan');
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Pembelian/CriBrg', $data);
	}

	public function caribarang()
	{
		$dataBarang = $this->m->join('t_barang', 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan')->result_array();
		$output = '';
		foreach ($dataBarang as $key => $value) {
			if ($value['type_exp'] == '1') {
				$output .= '<tr>
				<td>' . ($key + 1) . '</td>
				<td>' . $value['kode_barang'] . '</td>
				<td>' . $value['nama_barang'] . '</td>
				<td>' . $value['nama_satuan'] . '</td>
				<td>' . $value['nama_katagori'] . '</td>
				<td>' . $value['spek'] . '</td>
				<td>Rp. ' . number_format($value['harga_beli'], 0, ',', '.') . '</td>
				<td>Rp. ' . number_format($value['harga_jual'], 0, ',', '.') . '</td>
				<td>
				<div class="color-palette-set">
                  <div class="bg-success color-palette"><span>Pakai</span></div>
                </div>
				</td>
				<td><a href="javascript:void(0);" class="btn btn-primary caribrg" data-kode_brg="' . $value['kode_barang'] . '"data-nama_barang="' . $value['nama_barang'] . '"data-harga_jual="' . $value['harga_jual'] . '"data-harga_beli="' . $value['harga_beli'] . '" data-nama_satuan="' . $value['nama_satuan'] . '" data-nama_katagori="' . $value['nama_katagori'] . '" data-type_exp="' . $value['type_exp'] . '" >Tambah</a></td>
				</tr>';
			} else {
				$output .= '<tr>
				<td>' . ($key + 1) . '</td>
				<td>' . $value['kode_barang'] . '</td>
				<td>' . $value['nama_barang'] . '</td>
				<td>' . $value['nama_satuan'] . '</td>
				<td>' . $value['nama_katagori'] . '</td>
				<td>' . $value['spek'] . '</td>
				<td>Rp. ' . number_format($value['harga_beli'], 0, ',', '.') . '</td>
				<td>Rp. ' . number_format($value['harga_jual'], 0, ',', '.') . '</td>
				<td>
				<div class="color-palette-set">
				<div class="bg-danger color-palette"><span>Tidak Pakai</span></div>
			  </div>
				</td>
				<td><a href="javascript:void(0);" class="btn btn-primary caribrg" data-kode_brg="' . $value['kode_barang'] . '"data-nama_barang="' . $value['nama_barang'] . '"data-harga_jual="' . $value['harga_jual'] . '"data-harga_beli="' . $value['harga_beli'] . '" data-nama_satuan="' . $value['nama_satuan'] . '" data-nama_katagori="' . $value['nama_katagori'] . '" data-type_exp="' . $value['type_exp'] . '" >Tambah</a></td>
				</tr>';
			}
		}
		return $output;
	}

	function cariVBar()
	{
		echo $this->caribarang();
	}

	function cartvbrg()
	{
		$table = 'v_tmppembelian';

		$order = ['v_tmppembelian.id_tmppembelian' => 'ASC'];
		$join = [
			't_barang' => 't_barang.kode_barang = v_tmppembelian.kode_barangtmp'
		];
		/**
		 * Data Site Datatables
		 */
		$list = $this->m->get_datatables(null, $table, $join, null, null, $order)->result_array();
		$data = [];
		$no   = $_POST['start'];
		$subtotal = 0;
		foreach ($list as $field) {
			$subtotal = $field['price'] * $field['jmlhqty'];
			$no++;
			$row = [];
			$row[] = $field['kode_barangtmp'];
			$row[] = $field['name'];
			$row[] = $field['satuan'];
			$row[] = $field['katagori'];
			$row[] = $field['spek'];
			$row[] = number_format($field['harga_jual'], 0, ',', '.');
			$row[] = number_format($field['price'], 0, ',', '.');
			$row[] = $field['kode_produksi'];
			$row[] = $field['masa_aktif'];
			$row[] = $field['jmlhqty'];
			$row[] =  number_format($subtotal, 0, ',', '.');
			$row[] = '<a class="hapus_cart" data-kode_barang="' . $field['kode_barangtmp'] . '" data-kode_produksi="' . $field['kode_produksi'] . '"><i class="far fa-trash-alt text-danger fa-fw" style="font-size: 20px"></i></a>';
			$data[] = $row;
		}

		$json = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m->count_all($table),
			"recordsFiltered" => $this->m->count_filtered(null, $table, $join, null, null, $order),
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

		$this->db->join('t_barang', 't_barang.kode_barang = v_tmppembelian.kode_barangtmp');
		$data = $this->db->get('v_tmppembelian')->result_array();
		$subtotal = 0;
		foreach ($data as $items) {
			$subtotal = $items['price'] * $items['jmlhqty'];
			# code...
			$baris .= '
			<tr>
			<td>' . $items['kode_barangtmp'] . '</td>
			<td>' . $items['name'] . '</td>
			<td>' . $items['satuan'] . '</td>
			<td>' . $items['katagori'] . '</td>
			<td>Rp. ' . number_format($items['harga_jual'], 0, ',', '.') . '</td>
			<td>Rp. ' . number_format($items['price'], 0, ',', '.') . '</td>
			<td>' . $items['kode_produksi'] . '</td>
			<td>' . $items['masa_aktif'] . '</td>
			<td>' . $items['jmlhqty'] . '</td>
			<td> Rp. ' . number_format($subtotal, 0, ',', '.') . '</td>
			<td><a class="hapus_cart" data-kode_barang="' . $items['kode_barangtmp'] . '" data-kode_produksi="' . $items['kode_produksi'] . '"><i class="far fa-trash-alt text-danger fa-fw" style="font-size: 20px"></i></a></td>
			</tr>
			';
		}
		return $baris;
	}

	function viewC()
	{
		echo $this->cartV();
	}


	function add_cart()
	{
		$kode_barang = htmlspecialchars($this->input->post('kode_barang'));
		$nama_barang = htmlspecialchars($this->input->post('nama_barang'));
		$kode_produksi = htmlspecialchars($this->input->post('kode_produksi'));
		$masa_aktif = htmlspecialchars($this->input->post('masa_aktif'));
		$harga_jual = htmlspecialchars($this->input->post('harga_jual'));
		$harga_beli = htmlspecialchars($this->input->post('harga_beli'));
		$qty = htmlspecialchars($this->input->post('qty'));
		$satuan = htmlspecialchars($this->input->post('satuan'));
		$katagori = htmlspecialchars($this->input->post('katagori'));
		$tandabaca = [
			'Rp. ',
			'Rp.',
			'.'
		];
		$hrg_jual = str_replace($tandabaca, '', $harga_jual);
		$hrg_beli = str_replace($tandabaca, '', $harga_beli);

		$data = [
			'kode_supplier' => $this->input->post('kode_supplier'),
			'txtno_faktur' => $this->input->post('txtno_faktur'),
			'txttgl_pembelian' => $this->input->post('txttgl_pembelian'),
		];
		$this->session->set_userdata($data);

		if ($masa_aktif) {
			$msa_aktf = $masa_aktif;
		} else {
			$msa_aktf = '0';
		}
		if ($kode_produksi) {
			$vi = $this->db->get('t_vi')->row_array();
			$lama = $msa_aktf;
			$varvi = $vi['vi'];
			$kd_prdksi = $kode_produksi;
			$sub_kalimat = str_split($kd_prdksi);
			$kode_prdksi = $sub_kalimat[0] . $sub_kalimat[1] . '-' . $sub_kalimat[2] . $sub_kalimat[3];
			$kp = explode('-', $kode_prdksi);
			$kpm = $kp[0];
			$kpt = $kp[1];

			$mi = $lama - $varvi;
			$cek = $mi * 52;
			$emi = explode('.', $mi);
			$div = $emi[0];
			$mod = $cek % 52;
			if ($mod == 0) {
				$hslm = $kpm;
			} else {
				$hslm = $kpm + $mod;
			}
			$hslt = $kpt + $div;
			$indikator = $hslt . $hslm;

			$cekexp = $lama * 52;

			$emiexp = explode('.', $lama);
			$divexp = $emiexp[0];

			$modexp = $cekexp % 52;

			if ($modexp == 0) {
				$hslmexp = $kpm;
			} else {
				$hslmexp = $kpm + $modexp;
			}

			$hsltexp = $kpt + $divexp;
			$exp = $hsltexp . $hslmexp;
		} else {
			# code...
			$kode_produksi = 0;
			$indikator = 0;
			$exp = 0;
		}

		$cart = [
			'kode_barangtmp' => $kode_barang,
			'name' => $nama_barang,
			'price' => $hrg_beli,
			'qty' => $qty,
			'kode_produksi' => $kode_produksi,
			'masa_aktif' => $msa_aktf,
			'harga_jual' => $hrg_jual,
			'satuan' => $satuan,
			'katagori' => $katagori,
			'indikator' => $indikator,
			'exp' => $exp
		];

		$this->db->insert('t_tmppembelian', $cart);
		echo json_encode('berhasil');
	}

	function simpan_pembelian()
	{
		$kode_supplier = $this->session->userdata('kode_supplier');
		$txtno_faktur = $this->session->userdata('txtno_faktur');
		$txttgl_pembelian = date('Y-m-d', strtotime($this->session->userdata('txttgl_pembelian')));
		$data = $this->db->get('v_tmppembelian')->num_rows();
		if (!empty($kode_supplier) && !empty($txtno_faktur)  && !empty($txttgl_pembelian)) {
			if (empty(count($data))) {
				$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
				redirect('Gudang/Pembelian');
			} else {
				$this->db->join('t_barang', 't_barang.kode_barang = v_tmppembelian.kode_barangtmp');
				$data = $this->db->get('v_tmppembelian')->result_array();
				$subtotal = 0;
				foreach ($data as $items) {
					$insertpembelian = [
						'tgl_pembelian' => $txttgl_pembelian,
						'no_faktur' => $txtno_faktur,
						'kode_supplier' => $kode_supplier,
						'kode_barang' => $items['kode_barangtmp'],
						'kode_produksi_pem' => $items['kode_produksi'],
						'indikator' => $items['indikator'],
						'exp' => $items['exp'],
						'masa_aktif' => $items['masa_aktif'],
						'qty' => $items['jmlhqty'],
						'hrg_jual' => $items['harga_jual'],
						'hrg_beli' => $items['price']
					];
					$barang = [
						'harga_jual' => $items['harga_jual'],
						'harga_beli' => $items['price'],
						'del' => 1
					];
					$kode_barang = ['kode_barang' => $items['kode_barangtmp']];
					$this->m->put('t_barang', $barang, $kode_barang);
					$this->m->insert('t_pembelian', $insertpembelian);
				}
				$unset_sess = [
					'kode_supplier',
					'txtno_faktur',
					'txttgl_pembelian'
				];
				$this->session->unset_userdata($unset_sess);
				$this->db->empty_table('t_tmppembelian');
				$this->session->set_flashdata('berhasil', 'Data Berhasil Di Simpan');
				redirect('Gudang/Pembelian');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Inputan Masih Ada Yang Kosong!! <br> Mohon Di Cek Untuk Inputan Anda');
			redirect('Gudang/Pembelian');
		}
	}

	function hapus_cart()
	{ //fungsi untuk menghapus item cart
		$kode_barang = $this->input->post('kode_barang');
		$kode_produksi = $this->input->post('kode_produksi');
		$this->db->where('kode_barangtmp', $kode_barang);
		$this->db->where('kode_produksi', $kode_produksi);
		$this->db->delete('t_tmppembelian');
		echo $this->cartV();
	}

	public function carikodebarang()
	{
		$kode = $this->input->post('kode_barang');
		$where = ['kode_barang' => $kode];
		$sql = $this->m->join('t_barang', 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan', '', '', '', '', $where, '', '');
		if ($sql->num_rows() > 0) {
			foreach ($sql->result_array() as $data) {
				# code...
				$data = [
					'kode_barang' => $data['kode_barang'],
					'nama_barang' => $data['nama_barang'],
					'harga_jual' => $data['harga_jual'],
					'harga_beli' => $data['harga_beli'],
					'id_satuan' => $data['id_satuan'],
					'id_katagori' => $data['id_kategori'],
					'type_exp' => $data['type_exp']
				];
			}
		} else {
			# code...
			$data = [
				'kode_barang' => '',
				'nama_barang' => '',
				'harga_jual' => '',
				'harga_beli' => '',
				'id_satuan' => '',
				'id_katagori' => '',
				'type_exp' => ''
			];
		}
		echo json_encode($data);
	}

	public function supplierdata()
	{
		$sup = $this->m->get('t_supplier');
		$suplier = $this->session->userdata('kode_supplier');
		foreach ($sup as $supp) {
			$datasup = [];
			if ($supp['kode_supplier'] == $suplier) {
				$datasup[] = '<option value=" ' . $supp['kode_supplier'] . ' " selected>' . $supp['nama_supplier'] . '</option>';
			} else {
				$datasup[] = '<option value="' . $supp['kode_supplier'] . '"> ' . $supp['nama_supplier'] . ' </option>';
			}
			$outsupdata[] = $datasup;
		}

		for ($i = 0; $i < count($outsupdata); $i++) {
			# code...
			$supl = [];
			$supl = $outsupdata[$i][0];
			$outsupl[] = $supl;
		}

		$output = '<option value=""></option>
		<option value="SupplierBaru">Supplier Baru</option>
		' . implode($outsupl) . '';
		echo json_encode($output);
	}

	public function viewpembelian()
	{
		$data['satuan'] = $this->m->get('t_satuan');
		$data['katagori'] = $this->m->get('t_katagori');
		$data['title'] = 'SHERIN BAN | Pembelian';
		$this->load->view('Templates/Meta', $data);
		$this->load->view('Templates/Navbar');
		$this->load->view('Templates/Menu', $data);
		$this->load->view('Pembelian/Tampil', $data);
		$this->load->view('Templates/Footer');
		$this->load->view('Templates/Js');
	}

	public function viewdata()
	{
		$table = 't_pembelian';
		$column_order = [null, 't_pembelian.tgl_pembelian', 't_pembelian.no_faktur', 't_pembelian.kode_supplier', 't_supplier.nama_supplier'];

		$column_search = ['t_pembelian.tgl_pembelian', 't_pembelian.no_faktur', 't_pembelian.kode_supplier', 't_supplier.nama_supplier', 'kode_produksi_pem'];

		$order = ['t_pembelian.tgl_pembelian' => 'DESC'];
		$join = [
			't_supplier' => 't_supplier.kode_supplier = t_pembelian.kode_supplier',
			't_barang'	 => 't_barang.kode_barang = t_pembelian.kode_barang'
		];
		/**
		 * Data Site Datatables
		 */

		$list = $this->m->get_datatables(null, $table, $join, $column_order, $column_search, $order)->result_array();
		$data = [];
		$no   = $_POST['start'];
		$sisa = 0;
		foreach ($list as $value) {
			$this->db->where('kode_barang', $value['kode_barang']);
			$this->db->where('kode_produksi_pem', $value['kode_produksi_pem']);
			$stok = $this->db->get('t_stok')->row_array();
			// $sisa = $value['qty'] - $stok['stok'];
			$sisa = $value['qty'] - $stok['stok'];
			if ($stok['stok'] == 0) {
				$aksi = '';
			} else {
				$aksi = '<a href="javascript:void(0);" class="text-danger hapuspembelian"  data-link="' . base_url('hapuspembelian') . '" data-kode_barang = "' . $value['kode_barang'] . '" data-kode_produksi_pem = "' . $value['kode_produksi_pem'] . '"><i class="far fa-trash-alt"></i></a>';
			}
			$no++;
			$row = [];
			$row[] = $no;
			$row[] = date("d-m-Y", strtotime($value['tgl_pembelian']));
			$row[] = $value['no_faktur'];
			$row[] = $value['kode_supplier'];
			$row[] = $value['nama_supplier'];
			$row[] = $value['kode_barang'];
			$row[] = $value['nama_barang'];
			$row[] = $value['kode_produksi_pem'];
			$row[] = $value['qty'];
			$row[] = $stok['stok'];
			$row[] = $sisa;
			$row[]	= $aksi;
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

	public function hapusdatapembelian()
	{
		$kode_barang = htmlspecialchars($this->input->post('kodebarang'));
		$kode_produksi = htmlspecialchars($this->input->post('kode_produksi'));

		$this->db->where('kode_barang', $kode_barang);
		$this->db->where('kode_produksi_pem', $kode_produksi);
		$stokbarang = $this->db->get('t_stok')->row_array();

		$this->db->where('kode_barang', $kode_barang);
		$this->db->where('kode_produksi_pem', $kode_produksi);
		$pembelianstok = $this->db->get('t_pembelian')->row_array();

		$sisa = $pembelianstok['qty'] - $stokbarang['stok'];

		if ($pembelianstok['qty'] == $stokbarang['stok']) {
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->delete('t_pembelian');
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->delete('t_stok');
		} elseif ($stokbarang['stok'] >= $pembelianstok['qty']) {
			$stokdatapembelian = $pembelianstok['qty'] - $sisa;

			$updatestok = [
				'stok' => $sisa - $sisa
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->update('t_stok', $updatestok);

			$updatepembelian = [
				'qty' => $sisa
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->update('t_pembelian', $updatepembelian);
		} else if ($stokbarang['stok'] <= $pembelianstok['qty']) {

			$updatestok = [
				'stok' => $sisa - $sisa
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->update('t_stok', $updatestok);

			$updatepembelian = [
				'qty' => $sisa
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->where('kode_produksi_pem', $kode_produksi);
			$this->db->update('t_pembelian', $updatepembelian);
		}

		$json = [
			'data' => 'berhasil di hapus'
		];
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}
}
