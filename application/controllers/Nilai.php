<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_nilai','nilai');
	}

	public function index()
	{
		$this->template->views('nilai/nilai');
	}

	public function nilai_list()
	{
		$list = $this->nilai->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $nilai) {
			// $no++;
			$row = array();
			$row[] = $nilai->nama;
			$row[] = $nilai->kelas;
			$row[] = $nilai->ruang;
			$row[] = $nilai->matkul;
			$row[] = $nilai->grade;
			$row[] = $nilai->sks;
			$row[] = $nilai->jml_sks;
			$row[] = $nilai->ipk;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_nilai()'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_nilai()'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_nilai()'>
				<i class='glyphicon glyphicon-trash'></i>
			</a>";
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->nilai->count_all(),
						"recordsFiltered" => $this->nilai->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detail_show($id_nilai)
	{
		$data = $this->nilai->detail($id_nilai);
		echo json_encode($data);
	}

	public function nilai_edit($id_nilai)
	{
		$data = $this->nilai->get_by_id($id_nilai);
		// if 0000-00-00 set tu empty for datepicker compatibility
		$data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; 
		echo json_encode($data);
	}

	public function nilai_add()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'jml_sks' => $this->input->post('jml_sks'),
				'ipk' => $this->input->post('ipk'),
			);
		$insert = $this->nilai->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function nilai_update()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'jml_sks' => $this->input->post('jml_sks'),
				'ipk' => $this->input->post('ipk'),
			);
		$this->nilai->update(array('id_nilai' => $this->input->post('id_nilai')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function nilai_delete($id_nilai)
	{
		$this->nilai->delete_by_id($id_nilai);
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
		if($this->input->post('jml_sks') == '')
		{
			$data['inputerror'][] = 'jml_sks';
			$data['error_string'][] = 'Jumlah SKS is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('ipk') == '')
		{
			$data['inputerror'][] = 'ipk';
			$data['error_string'][] = 'IPK is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */