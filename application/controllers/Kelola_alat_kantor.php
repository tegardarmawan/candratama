<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_alat_kantor extends CI_Controller
{
	var $module_js = ['alat-kantor'];
	var $app_data = [''];
	public function __construct()
	{
		parent::__construct();
		$this->_init();
		if (!$this->is_logged_in()) {
			redirect('Auth');
		}
	}
	public function is_logged_in()
	{
		return $this->session->userdata('logged_in' === TRUE);
	}
	private function _init()
	{
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('inventaris/alat_kantor');
		$this->load->view('templates/footer');
	}

	public function get_data()
	{
	}
}
