<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai extends CI_Model {

	var $table = 'nilai';
	var $column_order = array('nama','kelas','ruang','matkul','grade','sks','jml_sks','ipk',null);
	var $column_search = array('nama','kelas','ipk');
	var $order = array('nim' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		// $this->_get_datatables_query();
		// if($_POST['length'] != -1)
		// $this->db->limit($_POST['length'], $_POST['start']);
		// $query = $this->db->get();
		// return $query->result();
		$this->db->select('	mahasiswa.nama,
							matkul.kelas,
							matkul.ruang,
							matkul.matkul,
							grade.grade,
							matkul.sks,
							mahasiswa.jml_sks,
							mahasiswa.ipk');
		$this->db->from('nilai');
		$this->db->join('mahasiswa', 'nilai.nim = mahasiswa.nim', 'left');
		$this->db->join('matkul', 'nilai.id_matkul = matkul.id_matkul', 'left');
		$this->db->join('grade', 'nilai.id_grade = grade.id_grade', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($nim)
	{
		$this->db->from($this->table);
		$this->db->where('nim',$nim);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($nim)
	{
		$this->db->where('nim', $nim);
		$this->db->delete($this->table);
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function detail($nim)
	{
		$query = $this->db->query("
			select 
				mahasiswa.nama,
				matkul.kelas,
				matkul.ruang,
				matkul.matkul,
				grade.grade,
				matkul.sks,
				mahasiswa.jml_sks,
				mahasiswa.ipk
			from mahasiswa, grade, matkul, nilai
			where 
				nilai.nim 			= mahasiswa.nim and
				nilai.id_matkul 	= matkul.id_matkul and
				nilai.id_grade 		= grade.id_grade");
		return $query->result();
	}

}

/* End of file M_nilai.php */
/* Location: ./application/models/M_nilai.php */