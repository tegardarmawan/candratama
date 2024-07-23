<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_data_barang extends CI_Controller
{

	var $module_js = ['data-barang'];

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
		$where = 'stock < stockmin';
		$this->app_data['total'] = $this->data->count_stock('tbarang', $where);
		$habis = 'stock <= 0';
		$this->app_data['habis'] = $this->data->count_stock('tbarang', $habis);
		//load menu helper
		$this->load->helper('menu_helper');
		$data['menus'] = generate_sidebar_menu();

		$data['title'] = 'Kelola Data Barang';
		$this->app_data['project'] = $this->data->get_all('tproject')->result();
		$this->app_data['kodegroup'] = $this->data->get_all('tgroup')->result();
		$this->app_data['kodesatuan'] = $this->data->get_all('tsatuan')->result();
		$this->app_data['kodebarang'] = $this->data->generateKodeb();
		$where = array('id_jabatan' => 1);
		$this->app_data['tukang'] = $this->data->find('tkaryawan', $where)->result();
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/kelola_data_barang', $this->app_data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		// <!-- id, no, kodeal, namaal, merk, stock, satuan, tglbeli, hbeli, ket, kodek, namak -->
		$query = [
			'select' => 'a.id, b.kodeg, b.namag, a.kodeb, a.namab, a.stock, c.namast, a.hbeli, a.hpokok, a.hjual, a.stockmin, a.namat, a.projectt',
			'from' => 'tbarang a',
			'join_custom' => [
				'tgroup b' => 'b.kodeg = a.kodeg, left',
				'tsatuan c' => 'c.namast = a.satuan, left',
			],
			'order_by' => 'a.id'
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, b.kodeg, a.kodeb, a.namab, a.stock, c.namast, a.hbeli, a.hpokok, a.hjual, a.stockmin, a.namat, a.projectt',
			'from' => 'tbarang a',
			'join' => [
				'tgroup b, b.kodeg = a.kodeg',
				'tsatuan c, c.namast = a.satuan'
			],
			'where' => [
				'a.id' => $id
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function insert_data()
	{
		// kodeg kodest status1 project => form select
		$this->form_validation->set_rules('kodeb', 'Kode', 'trim|required|is_unique[tbarang.kodeb]|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('stockmin', 'Stock Minimal', 'trim|required');
		$this->form_validation->set_rules('namat', 'Nama Tukang', 'trim');
		$this->form_validation->set_rules('project', 'Project', 'trim');


		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('kodeg'))) {
				$response['errors']['kodeg'] = "Kode group harus dipilih";
			}
			if (empty($this->input->post('kodest'))) {
				$response['errors']['kodest'] = "Kode satuan harus dipilih";
			}
		} else {
			$kodeg = $this->input->post('kodeg');
			$kodeb = $this->input->post('kodeb');
			$nama = ucwords($this->input->post('nama'));
			$kodest = $this->input->post('kodest');
			$stockmin = $this->input->post('stockmin');
			$namat = ucwords($this->input->post('namat'));
			$project = $this->input->post('project');

			if (empty($kodeg)) {
				$response['error']['kodeg'] = "Kode group harus dipilih";
			}
			if (empty($kodest)) {
				$response['error']['kodest'] = "Kode satuan harus dipilih";
			} else {
				$data = array(
					'kodeg' => $kodeg,
					'kodeb' => $kodeb,
					'namab' => $nama,
					'satuan' => $kodest,
					'stockmin' => $stockmin,
					'namat' => $namat,
					'projectt' => $project,
				);
				$this->data->insert('tbarang', $data);
				$kodeb = $this->data->generateKodeb();
				$response = [
					'success' => 'Data berhasil ditambahkan',
					'kodebarang' => $kodeb,
				];
			}
		}
		echo json_encode($response);
	}

	public function edit_data()
	{
		// kodeg kodest status1 project => form select
		$this->form_validation->set_rules('kodeb', 'Kode', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required');
		$this->form_validation->set_rules('hargabeli', 'Harga Beli', 'trim');
		$this->form_validation->set_rules('hargapokok', 'Harga Pokok', 'trim');
		$this->form_validation->set_rules('hargajual', 'Harga Jual', 'trim');
		$this->form_validation->set_rules('stockmin', 'Stock Minimal', 'trim|required');
		$this->form_validation->set_rules('namat', 'Nama Tukang', 'trim');
		$this->form_validation->set_rules('project', 'Nama Terang', 'trim');
		if (empty($this->input->post('kodeg'))) {
			$response['errors']['kodeg'] = "Kode group harus dipilih";
		}
		if (empty($this->input->post('kodest'))) {
			$response['errors']['kodest'] = "Kode satuan harus dipilih";
		}

		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
		} else {
			$id = $this->input->post('id');
			$kodeg = $this->input->post('kodeg');
			$kodeb = $this->input->post('kodeb');
			$nama = ucwords($this->input->post('nama'));
			$stock = $this->input->post('stock');
			$kodest = $this->input->post('kodest');
			$hargab = $this->input->post('hargabeli');
			$hargap = $this->input->post('hargapokok');
			$hargaj = $this->input->post('hargajual');
			$stockmin = $this->input->post('stockmin');
			$namat = ucwords($this->input->post('namat'));
			$project = $this->input->post('project');

			if (empty($kodeg)) {
				$response['errors']['kodeg'] = "Kode group harus dipilih";
			}
			if (empty($kodest)) {
				$response['errors']['kodest'] = "Kode satuan harus dipilih";
			}
			if (empty($project)) {
				$response['errors']['project'] = "Project harus dipilih";
			} else {
				$data = array(
					'kodeg' => $kodeg,
					'kodeb' => $kodeb,
					'namab' => $nama,
					'stock' => $stock,
					'satuan' => $kodest,
					'hbeli' => $hargab,
					'hpokok' => $hargap,
					'hjual' => $hargaj,
					'stockmin' => $stockmin,
					'namat' => $namat,
					'projectt' => $project,
				);
				$where = array('id' => $id);
				$this->data->update('tbarang', $where, $data);
				$kodeb = $this->data->generateKodeb();
				$response = [
					'success' => 'Data berhasil diperbarui',
					'kodebarang' => $kodeb,
				];
			}
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);

		$kodeb = $this->data->generateKodeb();
		$deleted = $this->data->delete('tbarang', $where);
		if (!$deleted) {
			$response['error'] = "Gagal menghapus data";
		} else {
			$response = [
				'success' => 'Data berhasil dihapus',
				'kodebarang' => $kodeb,
			];
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
			$deleted = $this->data->delete('tbarang', $where);
		}
		$kodeb = $this->data->generateKodeb();
		if (!$deleted) {
			$response['error'] = 'Data gagal dihapus';
		} else {
			$response = [
				'success' => 'Data berhasil dihapus',
				'kodebarang' => $kodeb,
			];
		}
		echo json_encode($response);
	}
}
