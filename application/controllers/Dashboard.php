<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->template->views('dashboard/dashboard');
	}

	public function index2()
	{
		$this->template->views('dashboard/dashboard2');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */