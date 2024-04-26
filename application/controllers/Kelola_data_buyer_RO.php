<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_data_buyer_RO extends CI_Controller
{
	var $module_js = ['buyer-RO'];
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
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();
		$data['title'] = 'Data Buyer RO';

		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_buyer_RO');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
}
