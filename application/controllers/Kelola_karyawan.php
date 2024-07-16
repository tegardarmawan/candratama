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
		$data['divisi'] = $this->data->get_all('tdivisi')->result(); //mengambil data dari tabel tdivisi
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
	//memanggil pilihan jabatan berdasar divisi yang dipilih
	public function get_jabatan_by_divisi()
	{
		$id_divisi = $this->input->post('divisi');
		$where = array('id_divisi' => $id_divisi);
		$result = $this->data->find('tjabatan', $where)->result();
		echo json_encode($result);
	}
	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.kodek, a.namak, a.no_induk, a.tempat, a.tgl, a.alamat, a.kota, a.telp,a.id_jabatan, b.nama, a.id_divisi, c.nama_divisi',
			'from' => 'tkaryawan a',
			'join' => [
				'tjabatan b, b.id = a.id_jabatan, left',
				'tdivisi c, c.id = a.id_divisi, left'
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
			'select' => 'a.id, a.kodek, a.namak, a.no_induk, a.tempat, a.tgl, a.alamat, a.kota, a.telp, a.id_jabatan, b.nama, a.id_divisi, c.nama_divisi',
			'from' => 'tkaryawan a',
			'join' => [
				'tdivisi c, c.id = a.id_divisi, left',
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
		$this->form_validation->set_rules('divisi', 'Divisi', 'trim|required');
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
			$divisi = ucwords($this->input->post('divisi'));
			$kode = $this->data->generateKodeKaryawan();
			$username = array('username' => $this->session->userdata('username'));
			$data['user'] = $this->data->find('tuser', $username)->row_array();
			$timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
			$data = array(
				'kodek' => $kode,
				'no_induk' => $induk,
				'namak' => $nama,
				'tempat' => $tempat,
				'tgl' => $tanggal,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'id_divisi' => $divisi,
				'id_jabatan' => $jabatan,
				'created_by' => $data['user']['id'],
				'created_date' => $timestamp,
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
		$this->form_validation->set_rules('divisi', 'Divisi', 'trim');
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
			$divisi = ucwords($this->input->post('divisi'));
			$username = array('username' => $this->session->userdata('username'));
			$data['user'] = $this->data->find('tuser', $username)->row_array();
			$timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
			$data = array(
				'kodek' => $kode,
				'no_induk' => $induk,
				'namak' => $nama,
				'tempat' => $tempat,
				'tgl' => $tanggal,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'id_divisi' => $divisi,
				'id_jabatan' => $jabatan,
				'updated_by' => $data['user']['id'],
				'updated_date' => $timestamp,
			);
			$where = array('id' => $id);
			$updated = $this->data->update('tkaryawan', $where, $data);
			if ($updated) {
				$response['success'] = 'Data berhasil diperbarui';
			} else {
				$response['error'] = 'Data gagal diperbarui';
			}
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
