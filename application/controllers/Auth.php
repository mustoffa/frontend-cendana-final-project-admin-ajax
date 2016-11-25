<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('M_auth', 'auth');
	}

	public function index() 
	{
		$this->check_login();
		$this->load->view('auth/login');		
	}

	public function check_login() 
	{
		$this->user_login = $this->session->userdata('user_session');
		if (count($this->user_login) > 0) {
			redirect('mahasiswa');
		}
	}

	public function act_login() 
	{
		$this->check_login();
		$param 	= $this->input->post();
		$proses = $this->auth->act_login($param);
		if (count($proses) > 0) {
			$this->session->set_userdata('user_session', $proses);
			$this->session->set_flashdata('alert_msg');
			redirect('mahasiswa');
		} else {
			$this->session->set_flashdata('alert_msg', err_msg('User / Password Salah'));
			redirect('auth');
		}
	}

	public function act_logout() 
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */