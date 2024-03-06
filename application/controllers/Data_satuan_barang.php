<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_satuan_barang extends CI_Controller
{

	var $module_js = ['data-satuan'];

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
		$data['title'] = 'Data Satuan Barang';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/data_satuan_barang');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}

	public function get_data()
	{
		$result = $this->data->get_all('tsatuan')->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tsatuan', $where)->result();
		echo json_encode($result);
	}

	public function insert_data()
	{
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|max_length[6]|is_unique[tsatuan.kodest]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[tsatuan.namast]');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$data = array(
				'kodest' => $kode,
				'namast' => $nama,
			);
			$this->data->insert('tsatuan', $data);
			$response['success'] = "Data Ditambahkan";
		}
		echo json_encode($response);
	}

	public function edit_data()
	{
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');

			$data = array(
				'kodest' => $kode,
				'namast' => $nama,
			);
			$where = array('id' => $id);
			$this->data->update('tsatuan', $where, $data);

			$response['success'] = "Data Berhasil Diperbarui";
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post("id");
		$where = array("id" => $id);

		$deleted = $this->data->delete('tsatuan', $where);
		if ($deleted) {
			$response['success'] = "Data Berhasil Dihapus";
		} else {
			$response['error'] = "Gagal menghapus Data";
		}
		echo json_encode($response);
	}
}
