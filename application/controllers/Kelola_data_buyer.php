<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_data_buyer extends CI_Controller
{
	var $module_js = ['data-buyer'];
	var $app_data = [];
	function __construct()
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
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();
		$data['title'] = 'Kelola Data Customer';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_buyer');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$result = $this->data->get_all('tcust')->result();
		echo json_encode($result);
	}
	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tcust', $where)->result();
		echo json_encode($result);
	}
	public function insert_data()
	{
		$this->form_validation->set_rules('kodec', 'kodec', 'required|is_unique[tcust.kodec]|trim');
		$this->form_validation->set_rules('kodec1', 'kodec1', 'trim|required|numeric|is_unique[tcust.kodec1]');
		$this->form_validation->set_rules('namac', 'namac', 'trim|required');
		$this->form_validation->set_rules('kota', 'kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim');
		$this->form_validation->set_rules('ktp', 'ktp', 'trim');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required');
		$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim');
		$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim');
		$this->form_validation->set_rules('saldo', 'saldo', 'trim');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
		$this->form_validation->set_rules('kodep', 'kodep', 'trim');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kodec = strtoupper($this->input->post('kodec'));
			$kodec1 = $this->input->post('kodec1');
			$namac = strtoupper($this->input->post('namac'));
			$ktp = $this->input->post('ktp');
			$alamat = $this->input->post('alamat');
			$kota = $this->input->post('kota');
			$telp = $this->input->post('telp');
			$tgl = $this->input->post('tgl');
			$pekerjaan = $this->input->post('pekerjaan');
			$perusahaan = $this->input->post('perusahaan');
			$saldo = $this->input->post('saldo');
			$jenis = $this->input->post('jenis');
			$kodep = $this->input->post('kodep');

			$data = [
				'kodec' => $kodec,
				'kodec1' => $kodec1,
				'namac' => $namac,
				'kota' => $kota,
				'alamat' => $alamat,
				'ktp' => $ktp,
				'telp' => $telp,
				'tgl' => $tgl,
				'pekerjaan' => $pekerjaan,
				'perusahaan' => $perusahaan,
				'saldo' => $saldo,
				'jenis' => $jenis,
				'kodep' => $kodep,
			];
			$this->data->insert('tcust', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}
	public function edit_data()
	{
		$this->form_validation->set_rules('kodec', 'kodec', 'trim|required|is_unique[tcust.kodec]');
		$this->form_validation->set_rules('kodec1', 'kodec1', 'trim|required|numeric');
		$this->form_validation->set_rules('namac', 'namac', 'trim|required');
		$this->form_validation->set_rules('kota', 'kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('ktp', 'ktp', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required');
		$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
		$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required');
		$this->form_validation->set_rules('saldo', 'saldo', 'trim|required');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
		$this->form_validation->set_rules('kodep', 'kodep', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kodec = $this->input->post('kodec');
			$kodec1 = $this->input->post('kodec1');
			$namac = $this->input->post('namac');
			$ktp = $this->input->post('ktp');
			$alamat = $this->input->post('alamat');
			$kota = $this->input->post('kota');
			$telp = $this->input->post('telp');
			$tgl = $this->input->post('tgl');
			$pekerjaan = $this->input->post('pekerjaan');
			$perusahaan = $this->input->post('perusahaan');
			$saldo = $this->input->post('saldo');
			$jenis = $this->input->post('jenis');
			$kodep = $this->input->post('kodep');

			$where = array('id' => $id);
			$data = [
				'kodec' => $kodec,
				'kodec1' => $kodec1,
				'namac' => $namac,
				'kota' => $kota,
				'alamat' => $alamat,
				'ktp' => $ktp,
				'telp' => $telp,
				'tgl' => $tgl,
				'pekerjaan' => $pekerjaan,
				'perusahaan' => $perusahaan,
				'saldo' => $saldo,
				'jenis' => $jenis,
				'kodep' => $kodep,
			];
			$this->data->update('tcust', $where, $data);
			$response['success'] = 'Data diperbarui';
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('tcust', $where);
		if (!$deleted) {
			$response['errors'] = 'Gagal menghapus data';
		} else {
			$response['success'] = 'Data dihapus';
		}
		echo json_encode($response);
	}
}
