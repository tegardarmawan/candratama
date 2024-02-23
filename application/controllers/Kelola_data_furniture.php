<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_furniture extends CI_Controller {

	var $module_js = ['data-furniture'];

	var $app_data = [];

	public function __construct(){
		parent::__construct();
		$this->init();
	}

	private function init(){
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$this->app_data['namast'] = $this->data->get_all('tsatuan')->result();
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/kelola_data_furniture', $this->app_data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data(){
		$query = [
			'select' => 'a.id, a.kodef, a.namaf, b.namast, a.ket, a.hjual',
			'from' => 'tfurniture a',
			'join_custom' => [
				'tsatuan b' => 'b.namast = a.satuan'
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	
	public function get_data_id(){
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, a.kodef, a.namaf, b.namast, a.ket, a.hjual',
			'from' => 'tfurniture a',
			'join' => ['tsatuan b, b.namast = a.satuan'],
			'where' => ['a.id' => $id]
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	//id kodef namaf satuan ket hjual => database
	public function insert_data(){
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|is_unique[tfurniture.kodef]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('hjual', 'Harga', 'trim|required');
		
		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if(empty($this->input->post('satuan'))){
				$response['errors']['satuan'] = 'Satuan barang harus dipilih';
			}
		} else {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$satuan = $this->input->post('satuan');
			$keterangan = $this->input->post('ket');
			$hjual = $this->input->post('hjual');

			if(empty($this->input->post('satuan'))){
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}else{
				$data = array(
					'kodef' => $kode,
					'namaf' => $nama,
					'satuan' => $satuan,
					'ket' => $keterangan,
					'hjual' => $hjual,
				);
				$this->data->insert('tfurniture', $data);
				$response['success'] = "Data berhasil ditambahkan";
			}
		}
		echo json_encode($response);
	}
	public function edit_data(){
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('hjual', 'Harga Jual', 'trim|required');
		if(empty($this->input->post('satuan'))){
			$response['errors']['satuan'] = 'Satuan harus dipilih';
		}

		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if(empty($this->input->post('satuan'))){
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			} else {
			$id = $this->input->post('id');
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$satuan = $this->input->post('satuan');
			$ket = $this->input->post('ket');
			$hjual = $this->input->post('hjual');
//id kodef namaf satuan ket hjual => database
			if (empty($satuan)) {
				$response['errors']['satuan'] = "Satuan harus dipilih";
			}else {
				$data = array(
					'kodef' => $kode,
					'namaf' => $nama,
					'satuan' => $satuan,
					'ket' => $ket,
					'hjual' => $hjual,
				);
				$where = array('id' => $id);
				$this->data->update('tfurniture', $where, $data);
				$response['success'] = "Data berhasil diperbarui";
			}
		}
		echo json_encode($response);
	}

	public function delete_data(){
		$id = $this->input->post("id");
		$where = array("id"=> $id);
		$deleted = $this->data->delete("tfurniture", $data, $where);
		if(!$deleted){
			$response["error"] = "Gagal menghapus data";
		}else{
			$response["success"] = "Berhasil menghapus data";
		}
		echo json_encode($response);
	}
}
