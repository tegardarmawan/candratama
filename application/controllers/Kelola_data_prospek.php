<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_prospek extends CI_Controller {

	var $module_js = ['data-prospek'];
	var $app_data = [];

	public function __construct(){
		parent::__construct();
		$this-> _init();
	}

	private function _init(){
		$this->app_data['module_js'] = $this->module_js;
	}

	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_data_prospek');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);		
	}

	public function get_data(){
		$result = $this->data->get_all('tprospek')->result();
		echo json_encode($result);
	}
	public function get_data_id(){
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tprospek', $where)->result();
		echo json_encode($result);
	}

	public function insert_data(){
		$this->form_validation->set_rules('kodep', 'Kode', 'trim|required|is_unique[tprospek.kodep]');
		$this->form_validation->set_rules('namap', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon', 'trim|required');
		$this->form_validation->set_rules('tglp', 'Tanggal Project', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|numeric');
		$this->form_validation->set_rules('src', 'Source', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('cek', 'Cek', 'trim|required|numeric');
		
		
		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kodep = $this->input->post('kodep');
			$namap = $this->input->post('namap');
			$kota = $this->input->post('kota');
			$telp = $this->input->post('telp');
			$tglp = $this->input->post('tglp');
			$type = $this->input->post('type');
			$src = $this->input->post('src');
			$jenis = $this->input->post('jenis');
			$ket = $this->input->post('ket');
			$cek = $this->input->post('cek');

			$data = array(
				'kodep' => $kodep,
				'namap' => $namap,
				'kota' => $kota,
				'telp' => $telp,
				'tglp' => $tglp,
				'type' => $type,
				'src' => $src,
				'jenis' => $jenis,
				'ket' => $ket,
				'cek' => $cek,
			);
			$this->data->insert('tprospek', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}

	public function edit_data(){
		$this->form_validation->set_rules('kodep', 'Kode', 'trim|required');
		$this->form_validation->set_rules('namap', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon', 'trim|required');
		$this->form_validation->set_rules('tglp', 'Tanggal Project', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|numeric');
		$this->form_validation->set_rules('src', 'Source', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('cek', 'Cek', 'trim|required|numeric');
		
		
		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kodep = $this->input->post('kodep');
			$namap = $this->input->post('namap');
			$kota = $this->input->post('kota');
			$telp = $this->input->post('telp');
			$tglp = $this->input->post('tglp');
			$type = $this->input->post('type');
			$src = $this->input->post('src');
			$jenis = $this->input->post('jenis');
			$ket = $this->input->post('ket');
			$cek = $this->input->post('cek');

			$data = array(
				'kodep' => $kodep,
				'namap' => $namap,
				'kota' => $kota,
				'telp' => $telp,
				'tglp' => $tglp,
				'type' => $type,
				'src' => $src,
				'jenis' => $jenis,
				'ket' => $ket,
				'cek' => $cek,
			);
			$where = array('id' => $id);
			$this->data->update('tprospek', $where, $data);
			$response['success'] = 'Data dipebarui';
		}
		echo json_encode($response);
	}
	
	public function delete_data(){
		$id = $this->input->post('id');
		$where = array('id' => $id);

		$deleted = $this->data->delete('tprospek', $where);
		if(!$deleted){
			$response['errors'] = 'Gagal menghapus data';
		}else{
			$response['success'] = 'Berhasil menghapus data';
		}
		echo json_encode($response);
	}
}
