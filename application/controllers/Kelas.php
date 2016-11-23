<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kelas','kelas');
	}

	public function index()
	{
		$this->template->views('kelas/kelas');
	}

	public function kelas_list()
	{
		$list = $this->kelas->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $kelas) {
			// $no++;
			$row = array();
			$row[] = $kelas->nama;
			$row[] = $kelas->jenkel;
			$row[] = $kelas->tgl_lahir;
			$row[] = $kelas->alamat;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='show_detail(\"". $kelas->id_kelas ."\",\"". $kelas->nama ."\")'>
				<i class='glyphicon glyphicon-folder-open'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_kelas($kelas->id_kelas)'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_kelas($kelas->id_kelas)'>
				<i class='glyphicon glyphicon-trash'></i>
			</a>";
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kelas->count_all(),
						"recordsFiltered" => $this->kelas->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detail_show($id_kelas)
	{
		$data = $this->kelas->detail($id_kelas);
		echo json_encode($data);
	}

	public function kelas_edit($id_kelas)
	{
		$data = $this->kelas->get_by_id($id_kelas);
		// if 0000-00-00 set tu empty for datepicker compatibility
		$data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; 
		echo json_encode($data);
	}

	public function kelas_add()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
		$insert = $this->kelas->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function kelas_update()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
		$this->kelas->update(array('id_kelas' => $this->input->post('id_kelas')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function kelas_delete($id_kelas)
	{
		$this->kelas->delete_by_id($id_kelas);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('jenkel') == '')
		{
			$data['inputerror'][] = 'jenkel';
			$data['error_string'][] = 'Jenis kelamin is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tgl_lahir') == '')
		{
			$data['inputerror'][] = 'tgl_lahir';
			$data['error_string'][] = 'Tanggal lahir is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */