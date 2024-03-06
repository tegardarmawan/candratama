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
		$this->app_data['credential'] = $this->data->get_all('app_credential')->result();
		$data['title'] = 'User';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('fasilitas/kelola_user', $this->app_data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.id_credential, a.kode, a.nama, a.username, a.password, b.name as credential',
			'from' => 'tuser a',
			'join' => [
				'app_credential b, b.id = a.id_credential'
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, a.id_credential, a.kode, a.nama, a.username, a.password, b.name as credential',
			'from' => 'tuser a',
			'join' => [
				'app_credential b, b.id = a.id_credential'
			],
			'where' => [
				'a.id' => $id
			]
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
	public function insert_data()
	{
		$this->form_validation->set_rules('kode', 'Kode User', 'trim|required|is_unique[tuser.kode]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|alpha_numeric|matches[password1]');
		$this->form_validation->set_rules('password1', 'Ulangi', 'trim|required|matches[password]', ['matches' => 'Password do not match!']);


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('credential'))) {
				$response['errors']['credential'] = 'Hak akses harus dipilih';
			}
		} else {
			$where = array('username' => $this->session->userdata('username'));
			$data['user'] = $this->data->find('tuser', $where)->row_array();

			$kode = $this->input->post('kode', true);
			$nama = $this->input->post('nama', true);
			$username = $this->input->post('username', true);
			$password = $this->input->post('password1');
			$credential = $this->input->post('credential', true);
			$hash = hash("sha256", $password . config_item('encryption_key'));

			if (empty($credential)) {
				$response['errors']['credential'] = 'Hak akses harus dipilih';
			} else {
				$data = array(
					'kode' => $kode,
					'id_credential' => $credential,
					'nama' => $nama,
					'username' => $username,
					'password' => $hash,
					'created_by' => $data['user']['id'],
				);
				$this->data->insert('tuser', $data);
				$response['success'] = 'Data user ditambahkan';
			}
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
			if (empty($this->input->post('credential'))) {
				$response['errors']['credendial'] = 'Hak akses harus dipilih';
			}
		} else {
			$where = array('username' => $this->session->userdata('username'));
			$data['user'] = $this->data->find('tuser', $where)->row_array();

			$id = $this->input->post('id');
			$kode = $this->input->post('kode');
			$credential = $this->input->post('credential');
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = $this->input->post('password1');
			$hash = hash("sha256", $password . config_item('encryption_key'));
			$timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;

			if (empty($credential)) {
				$response['errors']['credential'] = 'Hak akses harus dipilih';
			} else {
				$data = array(
					'kode' => $kode,
					'nama' => $nama,
					'id_credential' => $credential,
					'username' => $username,
					'updated_date' => $timestamp,
					'updated_by' => $data['user']['id'],
				);
				if (!empty($password)) {
					$data1 = array('password' => $hash);
					$where = array('id' => $id);
					$this->data->update('tuser', $where, $data1);
				}
				$where = array('id' => $id);
				$this->data->update('tuser', $where, $data);
				$response['success'] = 'Data user diubah';
			}
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
