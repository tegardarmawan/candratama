<?php defined("BASEPATH") or exit("No direct script access allowed");

class Data_group extends CI_Controller
{
	var $module_js = ['data-group'];
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
	{ //load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();

		$data['title'] = 'Data Group Barang';
		$data['kodeGroup'] = $this->data->generateKodeg();
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/data_group', $data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function generate_kode_group()
	{
		$kodeGroup = $this->data->generateKodeg();
		echo $kodeGroup;
	}

	public function get_data()
	{
		$query = [
			'select' => '*',
			'from' => 'tgroup',
			'order_by' => 'kodeg',
			'where' => ['is_deleted' => 0],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tgroup', $where)->result();
		echo json_encode($result);
	}

	public function insert_data()
	{
		$this->form_validation->set_rules('kodeg', 'Kode', 'required|trim|is_unique[tgroup.kodeg]|max_length[6]');
		$this->form_validation->set_rules('namag', 'Nama', 'required|trim|is_unique[tgroup.namag]');

		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kode = strtoupper($this->input->post('kodeg'));
			$nama = ucwords($this->input->post('namag'));
			$data = array(
				'kodeg' => $kode,
				'namag' => $nama,
			);
			$this->data->insert('tgroup', $data);

			$kodeGroup = $this->data->generateKodeg();
			$response = [
				'success' => 'Data berhasil ditambahkan',
				'kodegroup' => $kodeGroup
			];
		}
		echo json_encode($response);
	}

	public function edit_data()
	{
		$this->form_validation->set_rules('kodeg', 'Kode', 'trim|required');
		$this->form_validation->set_rules('namag', 'Nama', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kode = strtoupper($this->input->post('kodeg'));
			$nama = ucwords($this->input->post('namag'));

			$data = array(
				'kodeg' => $kode,
				'namag' => $nama,
			);
			$where = array('id' => $id);
			$this->data->update('tgroup', $where, $data);

			//logging
			$username = $this->session->userdata('username');
			$menu = "Data Group";
			$action = "Ubah";
			$desc = "Melakukan edit data group dengan kode: " . $kode;
			$this->_log_action($username, $action, $menu, $desc);
			$kodeGroup = $this->data->generateKodeg();
			$response = [
				'success' => 'Data berhasil diperbarui',
				'kodegroup' => $kodeGroup
			];
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$data = array('is_deleted' => 0);

		$deleted = $this->data->update('tgroup', $where, $data);
		$kodeGroup = $this->data->generateKodeg();
		if ($deleted) {
			//logging
			$username = $this->session->userdata('username');
			$action = "Hapus";
			$menu = "Data Group";
			$desc = "Melakukan hapus data group dengan Kode Group: " . $id;
			$this->_log_action($username, $action, $menu, $desc);
			$response = [
				'success' => 'Data berhasil dihapus',
				'kodegroup' => $kodeGroup
			];
		} else {
			$response['error'] = "Gagal Menghapus Data";
		}

		echo json_encode($response);
	}
	//function untuk melakukan penyimpanan aktivitas user pada log
	private function _log_action($username, $action, $menu, $desc)
	{
		$log_data = array(
			'user' => $username,
			'aksi' => $action,
			'nform' => $menu,
			'ket' => $desc,
			'waktu' => date('Y-m-d H:i:s')
		);
		$this->data->insert('tlog', $log_data);
	}
	public function bulk_delete()
	{
		// Ambil ID yang dikirim melalui POST
		$ids = $this->input->post('ids');
		$count = count($ids);
		for ($i = 0; $i < $count; $i++) {
			$where = array('id' => $ids[$i]);
			$data = array('is_deleted' => 0);
			$deleted = $this->data->update('tgroup', $where, $data);
		}
		$kodeGroup = $this->data->generateKodeg();
		if (!$deleted) {
			$response = [
				'success' => 'Data berhasil dihapus',
				'kodegroup' => $kodeGroup
			];
		} else {
			$response['success'] = 'Data Dihapus';
		}
		echo json_encode($response);
	}
}
