<?php
class Template {
	
	protected $_ci;

	function __construct()
	{
		$this->_ci = &get_instance();
	}
	
	function views($template = null, $data = null){
		if ($template != null){
			$data['_body'] = $this->_ci->load->view($template, $data, true);
			$data['_meta'] = $this->_ci->load->view('_template/_meta', $data, true);
			$data['_css'] = $this->_ci->load->view('_template/_css', $data, true);
			$data['_header'] = $this->_ci->load->view('_template/_header', $data, true);
			$data['_sidebar'] = $this->_ci->load->view('_template/_sidebar', $data, true);
			$data['_footer'] = $this->_ci->load->view('_template/_footer', $data, true);
			$data['_sidebar_right_control'] = $this->_ci->load->view('_template/_sidebar_right_control', $data, true);
			$data['_jquery'] = $this->_ci->load->view('_template/_jquery', $data, true);
			echo $data['_template'] = $this->_ci->load->view('template', $data, true);
		}
	}
}