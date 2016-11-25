<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_matkul extends CI_Model {

	var $table = 'show_matkul';
	var $column_order = array('matkul','kelas','ruang','sks',null);
	var $column_search = array('matkul','ruang');
	var $order = array('id_matkul' => 'desc'); // default order 

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

	public function get_by_id($id_matkul)
	{
		$this->db->from($this->table);
		$this->db->where('id_matkul',$id_matkul);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id_matkul)
	{
		$this->db->where('id_matkul', $id_matkul);
		$this->db->delete('matkul');
		return $this->db->affected_rows();
	}

	public function save($data)
	{
		$this->db->insert('matkul', $data);
		return $this->db->affected_rows();
	}

	public function detail($id_matkul)
	{
		$this->db->where('id_matkul', $id_matkul);
		$data = $this->db->get('show_matkul');
		return $data->result();
	}

	public function show_dosen()
	{
		$data = $this->db->get('dosen');
		return $data->result();
	}

}

/* End of file M_matkul.php */
/* Location: ./application/models/M_matkul.php */