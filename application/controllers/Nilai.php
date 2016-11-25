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
		$data['data_mhs'] = $this->nilai->show_mhs();
		$data['data_matkul'] = $this->nilai->show_matkul();
		$data['data_grade'] = $this->nilai->show_grade();
		$this->template->views('nilai/nilai', $data);
	}

	public function nilai_list()
	{
		$list = $this->nilai->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $nilai) {
			// $no++;
			$row = array();
			$row[] = $nilai->nama_mhs;
			$row[] = $nilai->matkul;
			$row[] = $nilai->sks;
			$row[] = $nilai->grade;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='show_detail(\"". $nilai->id_nilai ."\",\"". $nilai->nama_mhs ."\")'>
				<i class='glyphicon glyphicon-folder-open'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_nilai($nilai->id_nilai)'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_nilai($nilai->id_nilai)'>
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
		echo json_encode($data);
	}

	public function nilai_add()
	{
		$this->_validate();
		$data = array(
				'nim' => $this->input->post('nim'),
				'id_matkul' => $this->input->post('id_matkul'),
				'id_grade' => $this->input->post('id_grade')
			);
		$insert = $this->nilai->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function nilai_update()
	{
		$this->_validate();
		$data = array(
				'id_grade' => $this->input->post('id_grade'),
				'id_matkul' => $this->input->post('id_matkul'),
				'nim' => $this->input->post('nim'),
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
		if($this->input->post('nim') == '')
		{
			$data['inputerror'][] = 'nim';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_matkul') == '')
		{
			$data['inputerror'][] = 'id_matkul';
			$data['error_string'][] = 'Matakuliah is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_grade') == '')
		{
			$data['inputerror'][] = 'id_grade';
			$data['error_string'][] = 'Grade is required';
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