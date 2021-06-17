
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models extends CI_Model
{

	function get($tabel = null, $where = null, $join = null)
	{
		if ($join != null) {
			# code...
			foreach ($join as $keyj => $valuej) {
				# code...
				$this->db->join($keyj, $valuej);
			}
		}
		if ($where != null) {
			foreach ($where as $keyw => $valuew) {
				# code...
				$this->db->where($keyw, $valuew);
			}
		}
		return $this->db->get($tabel)->result_array();
	}

	function get_id($tabel, $where)
	{
		return $this->db->get_where($tabel, $where);
	}

	function insert($tabel, $data)
	{
		$this->db->insert($tabel, $data);
	}

	function put($tabel, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($tabel, $data);
	}

	function delete($table = null, $where = null)
	{
		$this->db->delete($table, $where);
	}

	public function createKode() // digunakan untuk membuat kode
	{
		# code...
		$this->db->SELECT('RIGHT(t_barang.kode_barang,4) as kode', FALSE);
		$this->db->order_by('kode_barang', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_barang');
		if ($query->num_rows() <> 0) {
			// jika kodesudah ada
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "BR" . $kodemax;

		return $kodejadi;
	}

	public function supp() // digunakan untuk membuat kode
	{
		# code...
		$this->db->SELECT('RIGHT(t_supplier.kode_supplier,4) as kode', FALSE);
		$this->db->order_by('kode_supplier', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_supplier');
		if ($query->num_rows() <> 0) {
			// jika kodesudah ada
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "SUP" . $kodemax;

		return $kodejadi;
	}

	public function pel() // digunakan untuk membuat kode
	{
		# code...
		$this->db->SELECT('RIGHT(t_pelanggan.kode_pelanggan,4) as kode', FALSE);
		$this->db->order_by('kode_pelanggan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_pelanggan');
		if ($query->num_rows() <> 0) {
			// jika kodesudah ada
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "PEL" . $kodemax;

		return $kodejadi;
	}

	public function Mekanik() // digunakan untuk membuat kode
	{
		# code...
		$this->db->SELECT('RIGHT(t_mekanik.kode_mekanik,4) as kode', FALSE);
		$this->db->order_by('kode_mekanik', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_mekanik');
		if ($query->num_rows() <> 0) {
			// jika kodesudah ada
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "M" . $kodemax;

		return $kodejadi;
	}

	public function Nota() // digunakan untuk membuat kode
	{
		# code...
		$this->db->SELECT('RIGHT(t_penjualan.no_nota,4) as kode', FALSE);
		$this->db->order_by('no_nota', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_penjualan');
		if ($query->num_rows() <> 0) {
			// jika kodesudah ada
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = date("ymd") . $kodemax;

		return $kodejadi;
	}

	function join($table, $tabel2 = null, $kondisi2 = null, $tabel3 = null, $kondisi3 = null, $tabel4 = null, $kondisi4 = null, $tabel5 = null, $kondisi5 = null, $tabel6 = null, $kondisi6 = null, $where = null, $where2 = null, $where3 = null)
	{
		if ($tabel2 != null && $tabel3 != null && $tabel4 != null && $tabel5 != null && $tabel6 != null) {
			$this->db->join($tabel2, $kondisi2);
			$this->db->join($tabel3, $kondisi3);
			$this->db->join($tabel4, $kondisi4);
			$this->db->join($tabel5, $kondisi5);
			$this->db->join($tabel6, $kondisi6);
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} elseif ($tabel2 != null && $tabel3 != null && $tabel4 != null) {
			$this->db->join($tabel2, $kondisi2);
			$this->db->join($tabel3, $kondisi3);
			$this->db->join($tabel4, $kondisi4);
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} elseif ($tabel2 != null && $tabel3 != null) {
			$this->db->join($tabel2, $kondisi2);
			$this->db->join($tabel3, $kondisi3);
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3);
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} else {
			$this->db->join($tabel2, $kondisi2);
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		}

		return $this->db->GET($table);
	}


	function joinleft($table, $tabel2 = null, $kondisi2 = null, $tabel3 = null, $kondisi3 = null, $tabel4 = null, $kondisi4 = null, $tabel5 = null, $kondisi5 = null, $tabel6 = null, $kondisi6 = null, $where = null, $where2 = null, $where3 = null)
	{
		if ($tabel2 != null && $tabel3 != null && $tabel4 != null && $tabel5 != null && $tabel6 != null) {
			$this->db->join($tabel2, $kondisi2, 'left');
			$this->db->join($tabel3, $kondisi3, 'left');
			$this->db->join($tabel4, $kondisi4, 'left');
			$this->db->join($tabel5, $kondisi5, 'left');
			$this->db->join($tabel6, $kondisi6, 'left');
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3);
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} elseif ($tabel2 != null && $tabel3 != null && $tabel4 != null) {
			$this->db->join($tabel2, $kondisi2, 'left');
			$this->db->join($tabel3, $kondisi3, 'left');
			$this->db->join($tabel4, $kondisi4, 'left');
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3);
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} elseif ($tabel2 != null && $tabel3 != null) {
			$this->db->join($tabel2, $kondisi2, 'left');
			$this->db->join($tabel3, $kondisi3, 'left');
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3);
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		} else {
			$this->db->join($tabel2, $kondisi2, 'left');
			if ($where != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where != null && $where2 != null) {
				$this->db->where($where);
				$this->db->where($where2);
			} elseif ($where != null) {
				$this->db->where($where);
			} elseif ($where2 != null) {
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
			} else {
			}
		}

		return $this->db->GET($table);
	}


	public function getpage($table = null, $select = null, $orderby = null, $limit = null, $offset = null, $count = true, $keycari = null, $cari = null, $join = null, $kondisi = null, $join1 = null, $kondisi1 = null, $join2 = null, $kondisi2 = null, $join3 = null, $kondisi3 = null, $where1 = null, $where2 = null, $where3 = null)
	{
		$this->db->select($select);
		$this->db->from($table);
		if ($join != null && $join1 != null && $join2 != null && $join3 != null) {
			$this->db->join($join, $kondisi);
			$this->db->join($join1, $kondisi1);
			$this->db->join($join2, $kondisi2);
			$this->db->join($join3, $kondisi3);
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, false);
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, false);
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null && $join1 != null && $join2 != null) {
			$this->db->join($join, $kondisi);
			$this->db->join($join1, $kondisi1);
			$this->db->join($join2, $kondisi2);
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, false);
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, false);
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null && $join1 != null) {
			# code...
			$this->db->join($join, $kondisi);
			$this->db->join($join1, $kondisi1);
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, false);
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, false);
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null) {
			# code...
			$this->db->join($join, $kondisi);
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, false);
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, false);
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} else {
		}
		if ($keycari != null) {
			# code...
			$pecahhuruf = str_replace(" ", "%", $cari);
			$hasildata = $keycari;
			$this->db->where("CONCAT_WS($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
		}


		if ($orderby != null) {
			# code...
			$this->db->order_by($orderby);
		} else {
			# code...
		}

		if ($count) {
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}
		return array();
	}


	public function getpagess($table = null, $select = null, $orderby = null, $limit = null, $offset = null, $count = true, $cari = null, $join = null, $kondisi = null, $join1 = null, $kondisi1 = null, $join2 = null, $kondisi2 = null, $join3 = null, $kondisi3 = null, $where1 = null, $where2 = null, $where3 = null)
	{
		$this->db->select($select);
		$this->db->from($table);
		if ($join != null && $join1 != null && $join2 != null && $join3 != null) {
			$this->db->join($join, $kondisi, 'left');
			$this->db->join($join1, $kondisi1, 'left');
			$this->db->join($join2, $kondisi2, 'left');
			$this->db->join($join3, $kondisi3, 'left');
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null && $join1 != null && $join2 != null) {
			$this->db->join($join, $kondisi, 'left');
			$this->db->join($join1, $kondisi1, 'left');
			$this->db->join($join2, $kondisi2, 'left');
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null && $join1 != null) {
			# code...
			$this->db->join($join, $kondisi, 'left');
			$this->db->join($join1, $kondisi1, 'left');
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3);
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} elseif ($join != null) {
			# code...
			$this->db->join($join, $kondisi);
			if ($where1 != null && $where2 != null && $where3 != null) {
				# code...
				$this->db->where($where1);
				$this->db->where($where2);
				$this->db->like($where3, 'both');
			} elseif ($where1 != null && $where2 != null) {
				$this->db->where($where1);
				$this->db->where($where2);
			} elseif ($where3 != null) {
				$this->db->like($where3, 'both');
				# code...
			} elseif ($where1 != null) {
				$this->db->where($where1);
				# code...
			} elseif ($where2 != null) {
				$this->db->where($where2);
				# code...
			} else {
				# code...
			}
		} else {
		}

		if ($cari != null) {
			foreach ($cari as $keyc => $valuec) {
				# code...
				$this->db->or_like($keyc, $valuec, 'both');
			}
		}

		if ($orderby != null) {
			# code...
			$this->db->order_by($orderby);
		} else {
			# code...
		}

		if ($count) {
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}
		return array();
	}


	public function getpages($select = null, $tabel = null, $carilike = null, $where = null, $join = null, $leftjoin = null, $groupb = null, $orderby = null, $count = null, $limit = null, $offset = null)
	{
		if ($select != null) {
			# code...
			$this->db->select($select);
		}
		if ($tabel != null) {
			# code...
			$this->db->from($tabel);
		}
		if ($join != null) {
			# code...
			foreach ($join as $keyj => $valuej) {
				# code...
				$this->db->join($keyj, $valuej);
			}
		}

		if ($leftjoin != null) {
			# code...
			foreach ($leftjoin as $keylj => $valuejlj) {
				# code...
				$this->db->join($keylj, $valuejlj, 'left');
			}
		}

		if ($where != null) {
			# code...
			foreach ($where as $keyw => $valuew) {
				# code...
				$this->db->or_where($keyw, $valuew);
			}
		}

		if ($carilike != null) {
			# code...
			foreach ($carilike as $keycl => $valuecl) {
				# code...
				$this->db->or_like($keycl, $valuecl, 'both');
			}
		}

		if ($groupb != null) {
			# code...
			$this->db->group_by($groupb);
		}
		if ($orderby != null) {
			# code...
			$this->db->order_by($orderby);
		}

		if ($count) {
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}

		return array();
	}

	public function jmlhpnjualan()
	{
		$this->db->select('*');
		$this->db->where('tgl_penjualan', date('Y-m-d'));
		return $this->db->get('t_penjualan')->num_rows();
	}

	public function barangtersedia()
	{
		$this->db->select('*');
		$this->db->where('stok !=', 0);
		return $this->db->get('t_stok')->num_rows();
	}
	public function barangmauhabis()
	{

		$query = $this->db->query('SELECT * FROM t_stok JOIN t_barang ON t_barang.kode_barang=t_stok.kode_barang WHERE t_stok.stok<= t_barang.stok_min AND t_stok.stok!=0');

		return $query->num_rows();
	}
	public function barangkosong()
	{
		$this->db->select('*');
		$this->db->where('stok =', 0);
		return $this->db->get('t_stok')->num_rows();
	}

	public function limitexp()
	{
		$mingguskrng = date('yW');
		return $this->db->query("SELECT * FROM v_kdprduksihsl WHERE indikator <=$mingguskrng AND exp >= $mingguskrng")->num_rows();
	}

	public function exp()
	{
		$mingguskrng = date('yW');
		return $this->db->query("SELECT * FROM v_kdprduksihsl WHERE exp <= $mingguskrng")->num_rows();
	}


	private function _get_datatables_query($select, $table, $join, $column_order, $column_search, $order, $wheredata = null, $wheredata1 = null, $wheredata2 = null, $joinleft = null)
	{
		if ($select != null) {
			# code...
			$this->db->select($select);
		} else {
			# code...
			$this->db->select();
		}

		$this->db->from($table);
		if ($join != null) {
			# code...
			foreach ($join as $joinkey => $key) {
				# code...
				$this->db->join($joinkey, $key);
			}
		}

		if ($joinleft != null) {
			foreach ($joinleft as $leftjoin => $data) {
				$this->db->join($leftjoin, $data, 'left');
			}
		}

		$i = 0;
		if ($column_search != null) {
			# code...
			foreach ($column_search as $items) {
				# code...
				if ($_POST['search']['value']) {
					# code...
					if ($i === 0) {
						# code...
						$this->db->group_start();
						$pecahhuruf = str_replace(" ", "%", $_POST['search']['value']);
						$hasildata = $items;
						$this->db->where("concat($hasildata) LIKE('%$pecahhuruf%')");
					} else {
						# code...
						$pecahhuruf = str_replace(" ", "%", $_POST['search']['value']);
						$hasildata = $items;
						$this->db->or_where("concat($hasildata) LIKE('%$pecahhuruf%')");
					}
					if (count($column_search) - 1 == $i) {
						# code...
						$this->db->group_end();
					}
					$i++;
				}

				if (isset($_POST['order'])) {
					$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} elseif (isset($order)) {
					# code...
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}
		}

		$a = 0;
		if ($wheredata != null) {
			# code...
			foreach ($wheredata as $keywhere => $valuewhere) {
				# code...
				$this->db->where($keywhere, $valuewhere);
			}
		}

		if ($wheredata1 != null) {
			$pecahhuruf = str_replace(" ", "%", $wheredata2);
			$hasildata = $wheredata1;
			$this->db->where("concat($hasildata) LIKE('%$pecahhuruf%')", NULL, false);
		}
	}

	function get_datatables($select = null, $table = null, $join = null, $column_order = null, $column_search = null, $order = null, $wheredata = null, $wheredata1 = null, $wheredata2 = null, $joinleft = null)
	{
		$this->_get_datatables_query($select, $table, $join, $column_order, $column_search, $order, $wheredata, $wheredata1, $wheredata2, $joinleft);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query;
		}
	}

	function get_datatablesfooter($select = null, $table = null, $join = null, $column_order = null, $column_search = null, $order = null, $wheredata = null, $wheredata1 = null, $wheredata2 = null, $joinleft = null)
	{
		$this->_get_datatables_query($select, $table, $join, $column_order, $column_search, $order, $wheredata, $wheredata1, $wheredata2, $joinleft);
		$query = $this->db->get();
		return $query;
	}

	function count_filtered($select = null, $table = null, $join = null, $column_order, $column_search = null, $order = null, $wheredata = null, $wheredata1 = null, $wheredata2 = null, $joinleft = null)
	{
		$this->_get_datatables_query($select, $table, $join, $column_order, $column_search, $order, $wheredata, $wheredata1, $wheredata2, $joinleft);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($table = null, $where = null)
	{
		$this->db->from($table);
		if ($where != null) {
			foreach ($where as $keywhere => $valuewhere) {
				$this->db->where($keywhere, $valuewhere);
			}
		}
		return $this->db->count_all_results();
	}


	function kode_urut($select = null, $table = null)
	{
		if ($select != null) {
			# code...
			$this->db->select($select);
		} else {
			# code...
			$this->db->select();
		}
		$this->db->where('CURDATE()');
		$q = $this->db->get($table);
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%04s", $tmp);
			}
		} else {
			$kd = "001";
		}
		return date('dmy') . $kd;
	}
}

/* End of file ModelName.php */
