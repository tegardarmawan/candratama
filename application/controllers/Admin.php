<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	var $module_js = [];
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
		// Cek apakah data karyawan sudah ada dalam session
		$data['karyawan'] = $this->session->userdata('data_karyawan');

		// Jika data karyawan belum ada dalam session, ambil dan simpan ke dalam session
		if (empty($data['karyawan'])) {
			$data['karyawan'] = $this->data->get_all('tkaryawan')->result();
			$this->session->set_userdata('data_karyawan', $data['karyawan']);
		}
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();

		// Load data untuk tampilan dashboard
		$data['title'] = 'Dashboard';
		$this->app_data['barang'] = $this->data->count('tbarang');
		$this->app_data['furniture'] = $this->data->count('tfurniture');
		$this->app_data['prospek'] = $this->data->count('tprospek');
		$this->app_data['cb'] = $this->data->count('tcust_follow');

		// Load view dashboard dengan data yang sudah diproses
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('dashboard', $this->app_data);
		$this->load->view('templates/footer', $this->app_data);
	}
}
