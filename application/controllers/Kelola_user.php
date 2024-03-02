<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_user extends CI_Controller
{
	var $module_js = ['kelola-user'];
	var $app_data = [];
	public function __construct()
	{
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		$this->app_data['module_js'] = $this->module_js;
	}
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('fasilitas/kelola_user');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$result = $this->data->get_all('tuser')->result();
		echo json_encode($result);
	}
	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tuser', $where)->result();
		echo json_encode($result);
	}
	public function insert_data()
	{
		$this->form_validation->set_rules('kode', 'Kode User', 'trim|required|is_unique[tuser.kode]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|alpha_numeric');
		$this->form_validation->set_rules('password1', 'Ulangi', 'trim|required|matches[password]', ['matches' => 'Password do not match!']);



		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$data = array(
				'kode' => $kode,
				'nama' => $nama,
				'username' => $username,
				'password' => $password,
			);
			$this->data->insert('tuser', $data);
			$response['success'] = 'Data user ditambahkan';
		}
		echo json_encode($response);
	}
	public function edit_data()
	{
		$this->form_validation->set_rules('kode', 'Kode User', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password1', 'Password Baru', 'trim|min_length[8]|alpha_numeric');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$data = array(
				'kode' => $kode,
				'nama' => $nama,
				'username' => $username,
				'password' => $password,
			);
			$where = array('id' => $id);
			$this->data->update('tuser', $where, $data);
			$response['success'] = 'Data user ditambahkan';
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('tuser', $where);
		if (!$deleted) {
			$response['errors'] = 'Gagal menghapus data user';
		} else {
			$response['success'] = 'Data user dihapus';
		}
		echo json_encode($response);
	}
}
