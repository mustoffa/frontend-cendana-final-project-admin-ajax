<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function act_login($param) 
	{
		$this->db->where('username', $param['username']);
		$this->db->where('password', $param['password']);
		$data = $this->db->get('user');
		return $data->row();
	}

}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */