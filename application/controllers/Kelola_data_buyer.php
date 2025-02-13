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
		$data['kodecustomer'] = $this->data->generateKodec();
		$data['kodec1'] = $this->data->generateKodec1();
		$data['menus'] = generate_sidebar_menu();
		$data['title'] = 'Kelola Data Customer';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_buyer', $data);
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
		//kodec1 menandakan customer tersebut adalah customer kesekian yang telah ditangani
		$this->form_validation->set_rules('kodec1', 'kodec1', 'trim|required|numeric|is_unique[tcust.kodec1]');
		$this->form_validation->set_rules('namac', 'namac', 'trim|required');
		$this->form_validation->set_rules('kota', 'kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim');
		$this->form_validation->set_rules('ktp', 'ktp', 'trim|numeric|max_length[16]|min_length[16]');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|numeric|max_length[13]');
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
			$kota = strtoupper($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$tgl = $this->input->post('tgl');
			if (!empty($tgl)) {
				$tgl_parts = explode('/', $tgl);
				$tgl = $tgl_parts['2'] . '-' . $tgl_parts['1'] . '-' . $tgl_parts['0'];
			}
			$pekerjaan = $this->input->post('pekerjaan');
			$perusahaan = $this->input->post('perusahaan');
			$saldo = $this->input->post('saldo');
			$jenis = $this->input->post('jenis');
			$kodep = $this->input->post('kodep');
			$saldo = preg_replace('/\D/', '', $saldo); //menghapus value selain digit/angka pada kolom saldo

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
			$inserted = $this->data->insert('tcust', $data);
			$kodecustomer = $this->data->generateKodec();
			$kodec1 = $this->data->generateKodec1();
			if ($inserted) {
				$response = [
					'success' => 'Data berhasil ditambahkan',
					'kodecustomer' => $kodecustomer,
					'kodec1' => $kodec1,
				];
			} else {
				$response['error'] = 'Data gagal ditambahkan';
			}
		}
		echo json_encode($response);
	}
	public function edit_data()
	{
		$this->form_validation->set_rules('kodec', 'kodec', 'required|trim');
		$this->form_validation->set_rules('kodec1', 'kodec1', 'trim|required|numeric');
		$this->form_validation->set_rules('namac', 'namac', 'trim|required');
		$this->form_validation->set_rules('kota', 'kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim');
		$this->form_validation->set_rules('ktp', 'ktp', 'trim|numeric|max_length[16]');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|numeric|max_length[13]');
		$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim');
		$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim');
		$this->form_validation->set_rules('saldo', 'saldo', 'trim');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
		$this->form_validation->set_rules('kodep', 'kodep', 'trim');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kodec = strtoupper($this->input->post('kodec'));
			$kodec1 = $this->input->post('kodec1');
			$namac = strtoupper($this->input->post('namac'));
			$ktp = $this->input->post('ktp');
			$alamat = $this->input->post('alamat');
			$kota = strtoupper($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$tgl = $this->input->post('tgl');
			if (!empty($tgl)) {
				$tgl_parts = explode('/', $tgl);
				$tgl = $tgl_parts['2'] . '-' . $tgl_parts['1'] . '-' . $tgl_parts['0'];
			}
			$pekerjaan = $this->input->post('pekerjaan');
			$perusahaan = $this->input->post('perusahaan');
			$saldo = $this->input->post('saldo');
			$jenis = $this->input->post('jenis');
			$kodep = $this->input->post('kodep');
			$saldo = preg_replace('/\D/', '', $saldo); //menghapus value selain digit/angka pada kolom saldo

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
			$updated = $this->data->update('tcust', $where, $data);
			$kodecustomer = $this->data->generateKodec();
			$kodec1 = $this->data->generateKodec1();
			if ($updated) {
				$response = [
					'success' => 'Data berhasil diperbarui',
					'kodecustomer' => $kodecustomer,
					'kodec1' => $kodec1,
				];
			} else {
				$response['error'] = 'Data gagal diperbarui';
			}
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('tcust', $where);
		$kodecustomer = $this->data->generateKodec();
		$kodec1 = $this->data->generateKodec1();
		if ($deleted) {
			$response = [
				'success' => 'Data berhasil dihapus',
				'kodecustomer' => $kodecustomer,
				'kodec1' => $kodec1,
			];
		} else {
			$response['error'] = 'Data gagal dihapus';
		}
		echo json_encode($response);
	}
}
