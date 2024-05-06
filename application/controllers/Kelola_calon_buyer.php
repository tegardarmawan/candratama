<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_calon_buyer extends CI_Controller
{
	var $module_js = ['calon-buyer'];
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
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();

		$data['title'] = 'Calon Buyer';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_calon_buyer');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$result = $this->data->get_all('tcust_follow')->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('tcust_follow', $where)->result();
		echo json_encode($result);
	}
	public function insert_data()
	{
		$this->form_validation->set_rules('kodep', 'Kode Pesanan', 'trim|required|is_unique[tcust_follow.kodep]');
		$this->form_validation->set_rules('namap', 'Nama Pemesan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat Pemesan', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota Pemesan', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon Pemesan', 'trim|required|numeric');
		$this->form_validation->set_rules('tglp', 'Tanggal Pesan', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$kodep = $this->input->post('kodep');
			$namap = strtoupper($this->input->post('namap'));
			$alamat = $this->input->post('alamat');
			$kota = strtoupper($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$tglp = $this->input->post('tglp');
			if (!empty($tglp)) {
				$tgl_parts = explode('/', $tglp);
				$tglp = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
			}
			$alamat = strtoupper($alamat);

			$data = array(
				'kodep' => $kodep,
				'namap' => $namap,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'tglp' => $tglp,
			);
			$this->data->insert('tcust_follow', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}
	public function edit_data()
	{
		$this->form_validation->set_rules('kodep', 'Kode Pesanan', 'trim|required');
		$this->form_validation->set_rules('namap', 'Nama Pemesan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat Pemesan', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota Pemesan', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telepon Pemesan', 'trim|required|numeric');
		$this->form_validation->set_rules('tglp', 'Tanggal Pesan', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kodep = strtoupper($this->input->post('kodep'));
			$namap = strtoupper($this->input->post('namap'));
			$alamat = $this->input->post('alamat');
			$kota = strtoupper($this->input->post('kota'));
			$telp = $this->input->post('telp');
			$tglp = $this->input->post('tglp');
			if (!empty($tglp)) {
				$tgl_parts = explode('/', $tglp);
				$tglp = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
			}
			$alamat = strtoupper($alamat);

			$data = array(
				'kodep' => $kodep,
				'namap' => $namap,
				'alamat' => $alamat,
				'kota' => $kota,
				'telp' => $telp,
				'tglp' => $tglp,
			);
			$where = array('id' => $id);
			$this->data->update('tcust_follow', $where, $data);
			$response['success'] = 'Data diubah';
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);

		$deleted = $this->data->delete('tcust_follow', $where);
		if ($deleted) {
			$response['success'] = "Data Berhasil Dihapus";
		} else {
			$response['errors'] = "Gagal Menghapus Data";
		}

		echo json_encode($response);
	}
}
