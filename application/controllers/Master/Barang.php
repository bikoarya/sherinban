<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
	}


	public function index()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$data['satuan'] = $this->m->get('t_satuan');
			$data['katagori'] = $this->m->get('t_katagori');
			$data['title'] = 'SHERIN BAN | Barang';
			$this->load->view('Templates/Meta', $data);
			$this->load->view('Templates/Navbar');
			$this->load->view('Templates/Menu', $data);
			$this->load->view('Master/Barang/Index', $data);
			$this->load->view('Templates/Footer');
			$this->load->view('Templates/Js');
		} else {
			redirect('Notfound');
		}
	}

	public function index_ajax($offset = null)
	{
		$cari =  htmlspecialchars($this->input->post('cari'), true);

		$keydata  = 'kode_barang,nama_barang,spek,harga_jual,harga_beli,stok_min,t_katagori.nama_katagori,t_satuan.nama_satuan';
		$cari_key = $cari;

		$limit = 10;
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// config
		$config['base_url'] = site_url('Master/Barang/index_ajax/');
		$config['total_rows'] = $this->m->getpage('t_barang', '*', 'kode_barang DESC', $limit, $offset, $count = true, $keydata, $cari_key, 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan');
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
		$data['barang'] = $this->m->getpage('t_barang', '*', 'kode_barang DESC', $limit, $offset, $count = false, $keydata, $cari_key, 't_katagori', 't_barang.id_kategori=t_katagori.id_katagori', 't_satuan', 't_barang.id_satuan=t_satuan.id_satuan');
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('Master/Barang/Index_ajax', $data);
	}

	function insert()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$hrjul = htmlspecialchars($this->input->post('harga_jual'));
			$pricejul = str_replace("Rp. ", "", $hrjul);
			$harga = str_replace(".", "", $pricejul);

			$hrbel = htmlspecialchars($this->input->post('harga_beli'));
			$pricebel = str_replace("Rp. ", "", $hrbel);
			$hargabel = str_replace(".", "", $pricebel);
			if (htmlspecialchars($this->input->post('type_exp')) == null) {
				$typeexp = '0';
			} else {
				$typeexp = htmlspecialchars($this->input->post('type_exp'));
			}
			$data = [
				'kode_barang' => htmlspecialchars($this->m->createKode()),
				'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
				'id_satuan' => htmlspecialchars($this->input->post('id_satuan')),
				'id_kategori' => htmlspecialchars($this->input->post('id_kategori')),
				'spek' => htmlspecialchars($this->input->post('spek')),
				'harga_jual' => $harga,
				'harga_beli' => $hargabel,
				'stok_min' => htmlspecialchars($this->input->post('stok_min')),
				'aktif' => htmlspecialchars($this->input->post('aktif')),
				'type_exp' => $typeexp,
				'q_1'	=> htmlentities($this->input->post('qty1'), true),
				'q_2'	=> htmlentities($this->input->post('qty2'), true),
				'pot_1'	=> htmlentities($this->input->post('pot1'), true),
				'pot_2'	=> htmlentities($this->input->post('pot2'), true),
			];
			$insert = $this->m->insert('t_barang', $data);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function update()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$hrjul = htmlspecialchars($this->input->post('txtharga_jual'));
			$pricejul = str_replace("Rp. ", "", $hrjul);
			$harga = str_replace(".", "", $pricejul);

			$hrbel = htmlspecialchars($this->input->post('txtharga_beli'));
			$pricebel = str_replace("Rp. ", "", $hrbel);
			$hargabel = str_replace(".", "", $pricebel);
			$kode = htmlspecialchars($this->input->post('txtkode_barang'));
			$where = ['kode_barang' => $kode];
			if (htmlspecialchars($this->input->post('type_exp')) == null) {
				$typeexp = '0';
			} else {
				$typeexp = htmlspecialchars($this->input->post('type_exp'));
			}
			$data = [
				'nama_barang' => htmlspecialchars($this->input->post('txtnama_barang')),
				'id_satuan' => htmlspecialchars($this->input->post('txtid_satuan')),
				'id_kategori' => htmlspecialchars($this->input->post('txtid_kategori')),
				'spek' => htmlspecialchars($this->input->post('txtspek')),
				'harga_jual' => $harga,
				'harga_beli' => $hargabel,
				'stok_min' => htmlspecialchars($this->input->post('txtstok_min')),
				'aktif' => htmlspecialchars($this->input->post('txtaktif')),
				'type_exp' => $typeexp,
				'q_1'	=> htmlentities($this->input->post('txtqty1'), true),
				'q_2'	=> htmlentities($this->input->post('txtqty2'), true),
				'pot_1'	=> htmlentities($this->input->post('txtpot1'), true),
				'pot_2'	=> htmlentities($this->input->post('txtpot2'), true),
			];
			$this->m->put('t_barang', $data, $where);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	function hapusbarang()
	{
		if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2) {
			$kode = $this->input->post('kode_barang');
			$this->m->delete('t_barang', ['kode_barang' => $kode]);
			echo $this->index_ajax();
		} else {
			redirect('Notfound');
		}
	}

	public function selectdata()
	{
		$satuan = $this->m->get('t_satuan');
		$katagori = $this->m->get('t_katagori');
		foreach ($satuan as $stn) {
			$sat = [];
			$sat[] = '<option value="' . $stn['id_satuan'] . '">' . $stn['nama_satuan'] . '</option>';
			$satdata[] = $sat;
		}
		for ($i = 0; $i < count($satdata); $i++) {
			# code...
			$satt = [];
			$satt = $satdata[$i][0];
			$outsat[] = $satt;
		}

		foreach ($katagori as $kategori) {
			$ktg = [];
			$ktg[] = '<option value="' . $kategori['id_katagori'] . '">' . $kategori['nama_katagori'] . '</option>';
			$ktgdata[] = $ktg;
		}
		for ($i = 0; $i < count($ktgdata); $i++) {
			# code...
			$ktgg = [];
			$ktgg = $ktgdata[$i][0];
			$outktg[] = $ktgg;
		}

		$dataout = [
			'satuan' => '<option value=""></option>
	<option value="SatuanBaru">Satuan Baru</option>' . implode($outsat) . '',
			'kategori' => '<option value=""></option>
	<option value="KategoriBaru">Kategori Baru</option>' . implode($outktg) . ''
		];
		echo json_encode($dataout);
	}


	public function selectdataedit()
	{
		$satuan = $this->m->get('t_satuan');
		$katagori = $this->m->get('t_katagori');
		foreach ($satuan as $stn) {
			$sat = [];
			$sat[] = '<option value="' . $stn['id_satuan'] . '">' . $stn['nama_satuan'] . '</option>';
			$satdata[] = $sat;
		}
		for ($i = 0; $i < count($satdata); $i++) {
			# code...
			$satt = [];
			$satt = $satdata[$i][0];
			$outsat[] = $satt;
		}

		foreach ($katagori as $kategori) {
			$ktg = [];
			$ktg[] = '<option value="' . $kategori['id_katagori'] . '">' . $kategori['nama_katagori'] . '</option>';
			$ktgdata[] = $ktg;
		}
		for ($i = 0; $i < count($ktgdata); $i++) {
			# code...
			$ktgg = [];
			$ktgg = $ktgdata[$i][0];
			$outktg[] = $ktgg;
		}

		$dataout = [
			'satuan' => '<option value=""></option>
	' . implode($outsat) . '',
			'kategori' => '<option value=""></option>
	' . implode($outktg) . ''
		];
		echo json_encode($dataout);
	}
}
