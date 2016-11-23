<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dosen','dosen');
	}

	public function index()
	{
		$this->template->views('dosen/dosen');
	}

	public function dosen_list()
	{
		$list = $this->dosen->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $dosen) {
			// $no++;
			$row = array();
			$row[] = $dosen->nama;
			$row[] = $dosen->jenkel;
			$row[] = $dosen->tgl_lahir;
			$row[] = $dosen->alamat;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='show_detail(\"". $dosen->nip ."\",\"". $dosen->nama ."\")'>
				<i class='glyphicon glyphicon-folder-open'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_dosen($dosen->nip)'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_dosen($dosen->nip)'>
				<i class='glyphicon glyphicon-trash'></i>
			</a>";
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->dosen->count_all(),
						"recordsFiltered" => $this->dosen->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detail_show($nip)
	{
		$data = $this->dosen->detail($nip);
		echo json_encode($data);
	}

	public function dosen_edit($nip)
	{
		$data = $this->dosen->get_by_id($nip);
		// if 0000-00-00 set tu empty for datepicker compatibility
		$data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; 
		echo json_encode($data);
	}

	public function dosen_add()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
		$insert = $this->dosen->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function dosen_update()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
		$this->dosen->update(array('nip' => $this->input->post('nip')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function dosen_delete($nip)
	{
		$this->dosen->delete_by_id($nip);
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

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */