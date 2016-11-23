 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_mahasiswa','mahasiswa');
	}

	public function index()
	{
		$this->template->views('mahasiswa/mahasiswa');
	}

	public function mhs_list()
	{
		$list = $this->mahasiswa->get_datatables();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $mahasiswa) {
			// $no++;
			$row = array();
			$row[] = $mahasiswa->nama;
			$row[] = $mahasiswa->jenkel;
			$row[] = $mahasiswa->tgl_lahir;
			$row[] = $mahasiswa->alamat;
			$row[] = $mahasiswa->jml_sks;
			$row[] = $mahasiswa->ipk;
			//add html for action
			$row[] = "
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='show_detail(\"". $mahasiswa->nim ."\",\"". $mahasiswa->nama ."\",\"". $mahasiswa->jml_sks ."\",\"". $mahasiswa->ipk ."\")'>
				<i class='glyphicon glyphicon-folder-open'></i>
			</a>
			<a class='btn btn-sm btn-primary' href='javascript:void(0)' title='Edit' 
				onclick='edit_mhs($mahasiswa->nim)'>
				<i class='glyphicon glyphicon-pencil'></i>
			</a>
			<a class='btn btn-sm btn-danger' href='javascript:void(0)' title='Hapus' 
				onclick='delete_mhs($mahasiswa->nim)'>
				<i class='glyphicon glyphicon-trash'></i>
			</a>";
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mahasiswa->count_all(),
						"recordsFiltered" => $this->mahasiswa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detail_show($nim)
	{
		$data = $this->mahasiswa->detail($nim);
		echo json_encode($data);
	}

	public function mhs_edit($nim)
	{
		$data = $this->mahasiswa->get_by_id($nim);
		// if 0000-00-00 set tu empty for datepicker compatibility
		$data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; 
		echo json_encode($data);
	}

	public function mhs_add()
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
		$insert = $this->mahasiswa->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function mhs_update()
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
		$this->mahasiswa->update(array('nim' => $this->input->post('nim')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function mhs_delete($nim)
	{
		$this->mahasiswa->delete_by_id($nim);
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

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */