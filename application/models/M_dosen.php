<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dosen extends CI_Model {

	var $table = 'dosen';
	var $column_order = array('nama','jenkel','tgl_lahir','alamat',null);
	var $column_search = array('nama','alamat');
	var $order = array('nip' => 'desc'); // default order 

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

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($nip)
	{
		$this->db->from($this->table);
		$this->db->where('nip',$nip);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($nip)
	{
		$this->db->where('nip', $nip);
		$this->db->delete($this->table);
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function detail($nip)
	{
		$this->db->select('	dosen.nama,
							matkul.matkul,
							matkul.kelas,
							matkul.ruang,
							matkul.sks');
		$this->db->from('dosen');
		$this->db->join('matkul', 'matkul.nip = dosen.nip');
		$this->db->where_in('dosen.nip', $nip);
		$data = $this->db->get();
		return $data->result();
	}

}

/* End of file M_dosen.php */
/* Location: ./application/models/M_dosen.php */