<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_surat_presentasi extends CI_Controller
{
	var $module_js = ['kelola-surat-presentasi'];
	var $app_data = [];
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
		return $this->session->userdata('logged_in') === TRUE;
	}
	private function _init()
	{
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		//load helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();
		$data['title'] = 'Kelola Surat Presentasi';

		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_surat_presentasi');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
}
