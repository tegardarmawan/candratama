<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_alat_tukang extends CI_Controller
{
	var $module_js = ['alat-tukang'];
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

		$data['title'] = 'Alat Tukang';
		$this->app_data['st'] = $this->data->get_all('tsatuan')->result();
		$this->app_data['kr'] = $this->data->get_all('tkaryawan')->result();
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('inventaris/alat_tukang', $this->app_data);
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_kode_karyawan($nama_karyawan)
	{
		$nama_karyawan = urldecode($nama_karyawan);
		$query = [
			'select' => 'kodek',
			'from' => 'tkaryawan',
			'where' => ['namak' => $nama_karyawan]
		];

		$result = $this->data->get($query)->row();
		if ($result) {
			//jika data ditermukan, maka kirimkan respon JSON
			//kode_customer merupakan variabel yang akan dipanggil pada js
			echo json_encode(['kode_karyawan' => $result->kodek]);
		} else {
			//jika data tidak ditemukan, maka kirimkan respon error
			echo json_encode(['error' => 'Kode Karyawan Tidak Ditemukan']);
		}
	}

	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.no, a.kodeal, a.namaal, a.merk, a.stock, b.namast, a.tglbeli, a.hbeli, a.ket, c.kodek, c.namak',
			'from' => 'talat a',
			'join' => [
				'tsatuan b, b.namast = a.satuan',
				'tkaryawan c, c.kodek = a.kodek'
			],
			'where' => [
				'a.jenis' => '1'
			],

		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, a.no, a.kodeal, a.namaal, a.merk, a.stock, b.namast, a.tglbeli, a.hbeli, a.ket, c.kodek, c.namak',
			'from' => 'talat a',
			'join' => [
				'tsatuan b, b.namast = a.satuan',
				'tkaryawan c, c.kodek = a.kodek'
			],
			'where' => [
				'a.id' => $id,
				'a.jenis' => '1'
			],
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function insert_data()
	{
		$this->form_validation->set_rules('no', 'Nomor Alat', 'trim|required|is_unique[talat.no]|numeric');
		$this->form_validation->set_rules('kodeal', 'Kode Alat', 'trim|required|is_unique[talat.kodeal]');
		$this->form_validation->set_rules('namaal', 'Nama Alat', 'trim|required');
		$this->form_validation->set_rules('merk', 'Merk Alat', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock Alat', 'trim|required|numeric');
		$this->form_validation->set_rules('tglbeli', 'Tanggal Beli Alat', 'trim|required');
		$this->form_validation->set_rules('hbeli', 'harga Beli Alat', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan Alat', 'trim|required');
		if (empty($this->input->post('kodek'))) {
			$response['errors']['kodek'] = 'Kode karyawan harus dipilih';
		}
		if (empty($this->input->post('satuan'))) {
			$response['errors']['satuan'] = 'Satuan harus dipilih';
		}

		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('kodek'))) {
				$response['errors']['kodek'] = 'Kode karyawan harus dipilih';
			}
			if (empty($this->input->post('satuan'))) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
		} else {
			$no = $this->input->post('no');
			$kodeal = $this->input->post('kodeal');
			$namaal = $this->input->post('namaal');
			$merk = $this->input->post('merk');
			$stock = $this->input->post('stock');
			$satuan = $this->input->post('satuan');
			$tglbeli = $this->input->post('tglbeli');
			$hbeli = $this->input->post('hbeli');
			$ket = $this->input->post('ket');
			$kodek = $this->input->post('kodek');
			$namak = $this->input->post('namak');
			$jenis = '1';
			if (empty($kodek)) {
				$response['errors']['kodek'] = 'Kode karyawan harus dipilih';
			}
			if (empty($satuan)) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			$data = array(
				'no' => $no,
				'kodeal' => $kodeal,
				'namaal' => $namaal,
				'merk' => $merk,
				'stock' => $stock,
				'satuan' => $satuan,
				'tglbeli' => $tglbeli,
				'hbeli' => $hbeli,
				'ket' => $ket,
				'kodek' => $kodek,
				'namak' => $namak,
				'jenis' => $jenis,
			);
			$this->data->insert('talat', $data);
			$response['success'] = 'Data ditambahkan';
		}
		echo json_encode($response);
	}

	public function edit_data()
	{
		$this->form_validation->set_rules('no', 'Nomor Alat', 'trim|required|numeric');
		$this->form_validation->set_rules('kodeal', 'Kode Alat', 'trim|required');
		$this->form_validation->set_rules('namaal', 'Nama Alat', 'trim|required');
		$this->form_validation->set_rules('merk', 'Merk Alat', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock Alat', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan Alat', 'trim|required');
		$this->form_validation->set_rules('tglbeli', 'Tanggal Beli Alat', 'trim|required');
		$this->form_validation->set_rules('hbeli', 'harga Beli Alat', 'trim|required');
		$this->form_validation->set_rules('ket', 'Keterangan Alat', 'trim|required');

		if ($this->form_validation->run() == false) {
			$response['errors'] = $this->form_validation->error_array();
			if (empty($this->input->post('kodek'))) {
				$response['errors']['kodek'] = 'Kode karyawan harus dipilih';
			}
			if (empty($this->input->post('satuan'))) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
		} else {
			$id = $this->input->post('id');
			$no = $this->input->post('no');
			$kodeal = $this->input->post('kodeal');
			$namaal = $this->input->post('namaal');
			$merk = $this->input->post('merk');
			$stock = $this->input->post('stock');
			$satuan = $this->input->post('satuan');
			$tglbeli = $this->input->post('tglbeli');
			$hbeli = $this->input->post('hbeli');
			$ket = $this->input->post('ket');
			$kodek = $this->input->post('kodek');
			$namak = $this->input->post('namak');
			$jenis = '1';
			if (empty($kodek)) {
				$response['errors']['kodek'] = 'Kode karyawan harus dipilih';
			}
			if (empty($satuan)) {
				$response['errors']['satuan'] = 'Satuan harus dipilih';
			}
			$data = array(
				'no' => $no,
				'kodeal' => $kodeal,
				'namaal' => $namaal,
				'merk' => $merk,
				'stock' => $stock,
				'satuan' => $satuan,
				'tglbeli' => $tglbeli,
				'hbeli' => $hbeli,
				'ket' => $ket,
				'kodek' => $kodek,
				'namak' => $namak,
				'jenis' => $jenis,
			);
			$where = array('id' => $id);
			$this->data->update('talat', $where, $data);
			$response['success'] = 'Data diubah';
		}
		echo json_encode($response);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('talat', $where);
		if (!$deleted) {
			$response['errors'] = 'Gagal menghapus data';
		} else {
			$response['success'] = 'Data dihapus';
		}
		echo json_encode($response);
	}
}
