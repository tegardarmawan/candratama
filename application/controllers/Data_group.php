<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Data_group extends CI_Controller {

	var $module_js = ['data-group'];
	var $app_data = [];

	public function __construct()
	{
		parent::__construct();
		$this->_init();
	}

	private function _init(){
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/data_group');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	
	public function get_data_group(){
		$result = $this->data->get_all('tgroup')->result();
		echo json_encode($result);
	}

	public function get_data_id(){
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tgroup', $where)->result();
		echo json_encode($result);
	}

	public function insert_data(){
		$this->form_validation->set_rules('kodeg', 'Kode', 'required|trim');
		$this->form_validation->set_rules('namag', 'Nama', 'required|trim');
				
		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kode = $this->input->post('kodeg');
			$nama = $this->input->post('namag');
			$data = array(
				'kodeg' => $kode,
				'namag' => $nama,
			);
			$this->data->insert('tgroup', $data);

			$response['success'] = "Data Ditambahkan";
		}
		echo json_encode($response);
	}

	public function edit_data(){
		$this->form_validation->set_rules('kodeg', 'Kode', 'trim|required|is_unique[tgroup.kodeg]');
		$this->form_validation->set_rules('namag', 'Nama', 'trim|required');
		
		
		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kode = $this->input->post('kodeg');
			$nama = $this->input->post('namag');

			$data = array(
				'kodeg' => $kode,
				'namag' => $nama,
			);
			$where = array('kodeg' => $kode);
			$this->data->update('tgroup', $where, $data);

			$response['success'] = "Data Berhasil Diperbarui";
		}
		echo json_encode($response);		
	}

	public function delete_data(){
		$kode = $this->input->post('kodeg');
		$where = array('kodeg' => $kode);

		$deleted = $this->data->delete('tgroup', $where);
		if($deleted){
			$response['success'] = "Data Berhasil Dihapus";
		} else{
			$response['error'] = "Gagal Menghapus Data";
		}

		echo json_encode($response);

	}

}
