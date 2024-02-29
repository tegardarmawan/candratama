<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	var $module_js = [];
	var $app_data = [];

	public function __construct(){
		parent::__construct();
		$this->_init();
	}
	private function _init(){
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$data['karyawan'] = $this->session->userdata('data_karyawan');
		
		if(!empty($data['karyawan'])){
			$this->app_data['karyawan'] = $data['karyawan'];
			$this->app_data['barang'] = $this->data->count('tbarang');
			$this->app_data['furniture'] = $this->data->count('tfurniture');
			$this->app_data['prospek'] = $this->data->count('tprospek');
			$this->app_data['cb'] = $this->data->count('tcust_follow');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/header');
			$this->load->view('dashboard', $this->app_data);
			$this->load->view('templates/footer');
		}else{
			$this->app_data['barang'] = $this->data->count('tbarang');
			$this->app_data['furniture'] = $this->data->count('tfurniture');
			$this->app_data['prospek'] = $this->data->count('tprospek');
			$this->app_data['cb'] = $this->data->count('tcust_follow');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/header');
			$this->load->view('dashboard', $this->app_data);
			$this->load->view('templates/footer');
		}
		
	}
}
