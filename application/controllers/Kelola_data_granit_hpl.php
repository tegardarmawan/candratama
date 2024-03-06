<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_data_granit_hpl extends CI_Controller
{
	var $module_js = ['data-granit'];

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
		$data['title'] = 'Data Granit & HPL';
		$this->app_data['kodeg'] = $this->data->get_all('tgroup')->result();
		$this->app_data['satuan'] = $this->data->get_all('tsatuan')->result();
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/kelola_data_granit_hpl', $this->app_data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}

	public function get_data()
	{
		$query = [
			'select' => 'a.id, b.kodeg, a.kodeh, a.namah, a.stock, c.namast, a.ket, a.hbeli, a.hpokok, a.hjual, a.status, a.stockmin, a.namat, a.projectt',
			'from' => 'thpl a',
			'join' => [
				'tgroup b, b.kodeg = a.kodeg',
				'tsatuan c, c.namast = a.satuan'
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, b.kodeg, a.kodeh, a.namah, a.stock, c.namast, a.ket, a.hbeli, a.hpokok, a.hjual, a.status, a.stockmin, a.namat, a.projectt',
			'from' => 'thpl a',
			'join' => [
				'tgroup b, b.kodeg = a.kodeg',
				'tsatuan c, c.namast = a.satuan'
			],
			'where' => ['a.id' => $id],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function insert_data()
	{
		$this->form_validation->set_rules('kodeh', 'Kode HPL', 'trim|required|is_unique[thpl.kodeh]');
		$this->form_validation->set_rules('namah', 'Nama HPL', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required|numeric');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('hbeli', 'Harga Beli', 'trim|required|numeric');
		$this->form_validation->set_rules('hpokok', 'Harga pokok', 'trim|required|numeric');
		$this->form_validation->set_rules('hjual', 'Harga jual', 'trim|required|numeric');
		$this->form_validation->set_rules('stockmin', 'Stockmin', 'trim|required|numeric');
		$this->form_validation->set_rules('namat', 'namat', 'trim|required');
		$this->form_validation->set_rules('projectt', 'projectt', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('kodeg'))) {
				$response['errors']['kodeg'] = 'Kode group harus dipilih';
			}
			if (empty($this->input->post('satuan'))) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			if (empty($this->input->post('status1'))) {
				$response['errors']['status1'] = 'Status harus dipilih';
			}
		} else {
			$kodeg = $this->input->post('kodeg');
			$kodeh = $this->input->post('kodeh');
			$namah = $this->input->post('namah');
			$stock = $this->input->post('stock');
			$satuan = $this->input->post('satuan');
			$ket = $this->input->post('ket');
			$hbeli = $this->input->post('hbeli');
			$hpokok = $this->input->post('hpokok');
			$hjual = $this->input->post('hjual');
			$status1 = $this->input->post('status1');
			$stockmin = $this->input->post('stockmin');
			$namat = $this->input->post('namat');
			$projectt = $this->input->post('projectt');
			if (empty($kodeg)) {
				$response['errors']['kodeg'] = 'Kode group harus dipilih';
			}
			if (empty($satuan)) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			if (empty($status1)) {
				$response['errors']['status1'] = 'Status harus dipilih';
			}
			$data = array(
				'kodeg' => $kodeg,
				'kodeh' => $kodeh,
				'namah' => $namah,
				'stock' => $stock,
				'satuan' => $satuan,
				'ket' => $ket,
				'hbeli' => $hbeli,
				'hpokok' => $hpokok,
				'hjual' => $hjual,
				'status' => $status1,
				'stockmin' => $stockmin,
				'namat' => $namat,
				'projectt' => $projectt,
			);
			$this->data->insert('thpl', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}
	public function edit_data()
	{
		$this->form_validation->set_rules('kodeh', 'Kode HPL', 'trim|required');
		$this->form_validation->set_rules('namah', 'Nama HPL', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('hbeli', 'Harga Beli', 'trim|required');
		$this->form_validation->set_rules('hpokok', 'Harga pokok', 'trim|required');
		$this->form_validation->set_rules('hjual', 'Harga jual', 'trim|required');
		$this->form_validation->set_rules('status1', 'Status', 'trim|required');
		$this->form_validation->set_rules('stockmin', 'Stockmin', 'trim|required');
		$this->form_validation->set_rules('namat', 'namat', 'trim|required');
		$this->form_validation->set_rules('projectt', 'projectt', 'trim|required');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('kodeg'))) {
				$response['errors']['kodeg'] = 'Kode group harus dipilih';
			}
			if (empty($this->input->post('satuan'))) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			if (empty($status1)) {
				$response['errors']['status1'] = 'Status harus dipilih';
			}
		} else {
			$id = $this->input->post('id');
			$kodeg = $this->input->post('kodeg');
			$kodeh = $this->input->post('kodeh');
			$namah = $this->input->post('namah');
			$stock = $this->input->post('stock');
			$satuan = $this->input->post('satuan');
			$ket = $this->input->post('ket');
			$hbeli = $this->input->post('hbeli');
			$hpokok = $this->input->post('hpokok');
			$hjual = $this->input->post('hjual');
			$status1 = $this->input->post('status1');
			$stockmin = $this->input->post('stockmin');
			$namat = $this->input->post('namat');
			$projectt = $this->input->post('projectt');
			if (empty($kodeg)) {
				$response['errors']['kodeg'] = 'Kode group harus dipilih';
			}
			if (empty($satuan)) {
				$response['errors']['kodeg'] = 'Satuan harus dipilih';
			}
			if (empty($status1)) {
				$response['errors']['status1'] = 'Status harus dipilih';
			}
			$data = array(
				'kodeg' => $kodeg,
				'kodeh' => $kodeh,
				'namah' => $namah,
				'stock' => $stock,
				'satuan' => $satuan,
				'ket' => $ket,
				'hbeli' => $hbeli,
				'hpokok' => $hpokok,
				'hjual' => $hjual,
				'status' => $status1,
				'stockmin' => $stockmin,
				'namat' => $namat,
				'projectt' => $projectt,
			);
			$where = array('id' => $id);
			$this->data->update('thpl', $where, $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('thpl', $where);
		if (!$deleted) {
			$response['errors'] = 'Gagal menghapus data';
		} else {
			$response['success'] = 'Data dihapus';
		}
		echo json_encode($response);
	}
}
