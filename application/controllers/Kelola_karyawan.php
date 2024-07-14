<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_karyawan extends CI_Controller
{

	var $module_js = ['data-karyawan'];
	var $app_data = [''];

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
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();
		$data['jabatan'] = $this->data->get_all('tjabatan')->result();
		$data['kodekaryawan'] = $this->data->generateKodeKaryawan();
		$data['noInduk'] = $this->data->generateNoInduk();
		// Ambil data karyawan dari model
		$data['title'] = 'Data Karyawan';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('karyawan/kelola_karyawan', $data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.kodek, a.namak, a.no_induk, a.tempat, a.tgl, a.alamat, a.kota, a.telp,a.id_jabatan, b.nama',
			'from' => 'tkaryawan a',
			'join' => [
				'tjabatan b, b.id = a.id_jabatan, left'
			],
			'order_by' => 'a.kodek',
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, a.kodek, a.namak, a.no_induk, a.tempat, a.tgl, a.alamat, a.kota, a.telp, a.id_jabatan, b.nama',
			'from' => 'tkaryawan a',
			'join' => [
				'tjabatan b, b.id = a.id_jabatan, left'
			],
			'where' => [
				'a.id' => $id
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	// <!-- id kodep namap kota telp tglp type src jenis ket cek -->
	public function insert_data()
	{
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|is_unique[tkaryawan.kodek]');
		$this->form_validation->set_rules('induk', 'Induk', 'trim|is_unique[tkaryawan.no_induk]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$induk = $this->input->post('induk');
			$nama = ucwords($this->input->post('nama'));
			$tempat = ucwords($this->input->post('tempat'));
			$tanggal = $this->input->post('tanggal');
			if (!empty($tanggal)) {
				$tgl_parts = explode('/', $tanggal);
				$tanggal = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
			}
			$alamat = ucwords($this->input->post('alamat'));
			$kota = ucwords($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$jabatan = ucwords($this->input->post('jabatan'));
			$kode = $this->data->generateKodeKaryawan();
			$data = array(
				'kodek' => $kode,
				'no_induk' => $induk,
				'namak' => $nama,
				'tempat' => $tempat,
				'tgl' => $tanggal,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'id_jabatan' => $jabatan,
			);
			$this->data->insert('tkaryawan', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}

	public function edit_data()
	{
		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('induk', 'Induk', 'trim');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kode = strtoupper($this->input->post('kode'));
			$induk = $this->input->post('induk');
			$nama = ucwords($this->input->post('nama'));
			$tempat = ucwords($this->input->post('tempat'));
			$tanggal = $this->input->post('tanggal');
			if (!empty($tanggal)) {
				$tgl_parts = explode('/', $tanggal);
				$tanggal = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
			}
			$alamat = ucwords($this->input->post('alamat'));
			$kota = ucwords($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$jabatan = ucwords($this->input->post('jabatan'));
			$data = array(
				'kodek' => $kode,
				'no_induk' => $induk,
				'namak' => $nama,
				'tempat' => $tempat,
				'tgl' => $tanggal,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'id_jabatan' => $jabatan,
			);
			$where = array('id' => $id);
			$this->data->update('tkaryawan', $where, $data);
			$response['success'] = 'Data berhasil ditambahkan';
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post("id");
		$where = array('id' => $id);

		$deleted = $this->data->delete('tkaryawan', $where);
		if ($deleted) {
			$response['success'] = 'Data dihapus';
		} else {
			$response['error'] = 'Gagal menghapus data';
		}
		echo json_encode($response);
	}
	public function bulk_delete()
	{
		// Ambil ID yang dikirim melalui POST
		$ids = $this->input->post('ids');
		$count = count($ids);
		for ($i = 0; $i < $count; $i++) {
			$where = array('id' => $ids[$i]);
			$deleted = $this->data->delete('tkaryawan', $where);
		}
		if (!$deleted) {
			$response['error'] = 'Data gagal dihapus';
		} else {
			$response['success'] = 'Data Dihapus';
		}
		echo json_encode($response);
	}
}
