<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_warehouse extends CI_Controller
{
	var $module_js = ['laporan'];
	var $app_data = [''];
	public function __construct()
	{
		parent::__construct();
		$this->_init();
		if (!$this->logged_in()) {
			redirect('auth');
		}
	}
	private function _init()
	{
		$this->app_data['module_js'] = $this->module_js;
	}
	public function logged_in()
	{
		return $this->session->userdata('logged_in') === TRUE;
	}
	public function index()
	{
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();

		$data['title'] = 'Laporan Warehouse';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/laporan');
		$this->load->view('templates/footer');
	}
}
