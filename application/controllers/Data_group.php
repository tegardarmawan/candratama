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
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/data_group');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}

	public function get_data()
	{
		$result = $this->data->get_all('tgroup')->result();
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
			$kode = $this->input->post('kodeg');
			$nama = $this->input->post('namag');
			$data = array(
				'kodeg' => $kode,
				'namag' => $nama,
			);
			$this->data->insert('tgroup', $data);

			//logging
			$username = $this->session->userdata('username');
			$action = "Simpan";
			$menu = "Data Group";
			$desc = "Menambahkan data group dengan kode: " . $kode . " dan nama: " . $nama;
			$this->_log_action($username, $action, $menu, $desc);
			$response['success'] = "Data Ditambahkan";
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
			$kode = $this->input->post('kodeg');
			$nama = $this->input->post('namag');

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

			$response['success'] = "Data Berhasil Diperbarui";
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);

		$deleted = $this->data->delete('tgroup', $where);
		if ($deleted) {
			//logging
			$username = $this->session->userdata('username');
			$action = "Hapus";
			$menu = "Data Group";
			$desc = "Melakukan hapus data group dengan Kode Group: " . $id;
			$this->_log_action($username, $action, $menu, $desc);
			$response['success'] = "Data Berhasil Dihapus";
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
			$deleted = $this->data->delete('tgroup', $where);
		}
		if (!$deleted) {
			$response['error'] = 'Data gagal dihapus';
		} else {
			$response['success'] = 'Data Dihapus';
		}
		echo json_encode($response);
	}
}
