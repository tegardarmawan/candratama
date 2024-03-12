<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_bahan_project extends CI_Controller
{
	var $module_js = ['bahan-project'];
	var $app_data = [''];
	public function __construct()
	{
		parent::__construct();
		$this->_init();
		if (!$this->logged_in()) {
			redirect('auth');
		}
	}
	public function logged_in()
	{
		return $this->session->userdata('logged_in') === TRUE;
	}
	private function _init()
	{
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_bahan_project');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
}
