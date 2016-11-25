<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_matkul','matkul');
		// $this->load->model('M_dosen','dosen');
	}

	public function index()
	{
		$data['data_dosen'] = $this->matkul->show_dosen();
		$this->template->views('matkul/matkul', $data);
	}

	public function matkul_list()
	{
		$list = $this->matkul->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $matkul) {
			// $no++;
			$row = array();
			$row[] = $matkul->matkul;
			$row[] = $matkul->kelas;
			$row[] = $matkul->ruang;
			$row[] = $matkul->sks;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='show_detail(\"". $matkul->id_matkul ."\",\"". $matkul->matkul ."\")'>
				<i class='glyphicon glyphicon-folder-open'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_matkul($matkul->id_matkul)'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_matkul($matkul->id_matkul)'>
				<i class='glyphicon glyphicon-trash'></i>
			</a>";
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->matkul->count_all(),
						"recordsFiltered" => $this->matkul->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detail_show($id_matkul)
	{
		$data = $this->matkul->detail($id_matkul);
		echo json_encode($data);
	}

	public function matkul_edit($id_matkul)
	{
		$data = $this->matkul->get_by_id($id_matkul); 
		echo json_encode($data);
	}

	public function matkul_add()
	{
		$this->_validate();
		$data = array(
				'matkul' => $this->input->post('matkul'),
				'kelas' => $this->input->post('kelas'),
				'ruang' => $this->input->post('ruang'),
				'sks' => $this->input->post('sks'),
				'nip' => $this->input->post('nip')
			);
		$insert = $this->matkul->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function matkul_update()
	{
		$this->_validate();
		$data = array(
				'matkul' => $this->input->post('matkul'),
				'kelas' => $this->input->post('kelas'),
				'ruang' => $this->input->post('ruang'),
				'sks' => $this->input->post('sks'),
				'nip' => $this->input->post('nip')
			);
		$this->matkul->update(array('id_matkul' => $this->input->post('id_matkul')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function matkul_delete($id_matkul)
	{
		$this->matkul->delete_by_id($id_matkul);
		// $this->dosen->delete_by_id($nip);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if($this->input->post('matkul') == '')
		{
			$data['inputerror'][] = 'matkul';
			$data['error_string'][] = 'Mata Kuliah is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('kelas') == '')
		{
			$data['inputerror'][] = 'kelas';
			$data['error_string'][] = 'Kelas is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('ruang') == '')
		{
			$data['inputerror'][] = 'ruang';
			$data['error_string'][] = 'Ruang is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('sks') == '')
		{
			$data['inputerror'][] = 'sks';
			$data['error_string'][] = 'SKS is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'Dosen is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Matkul.php */
/* Location: ./application/controllers/Matkul.php */