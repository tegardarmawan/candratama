<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_data_buyer_RO extends CI_Controller
{
	var $module_js = ['buyer-RO'];
	var $app_data = [];
	function __construct()
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
		$data['title'] = 'Kelola Data Customer';
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_buyer_RO');
		$this->load->view('templates/footer');
		$this->load->view('js-costum', $this->app_data);
	}
	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.kodec, a.namac, a.kota, a.telp, GROUP_CONCAT(REPLACE(b.project, \' \', \'\') SEPARATOR \', \') AS project',
			'from' => 'tcust a',
			'join' => [
				'tproject b, b.kodec = a.kodec, left'
			],
			'where_in' => [
				'b.kodec' => $this->_getCustomerCodesWithMultipleProjects()
			],
			'group_by' => 'a.id, a.kodec, a.namac, a.kota, a.telp',
		];

		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	private function _getCustomerCodesWithMultipleProjects()
	{
		// Ini adalah contoh implementasi yang mungkin memerlukan penyesuaian sesuai dengan kebutuhan Anda
		$this->db->select('kodec');
		$this->db->from('tproject');
		$this->db->having('COUNT(*) > 1');
		$this->db->group_by('kodec');
		$query = $this->db->get();

		$result = [];
		foreach ($query->result() as $row) {
			$result[] = $row->kodec;
		}
		return $result;
	}
	public function get_data_id()
	{
		$id = $this->input->post('id');
		$query = [
			'select' => 'a.id, a.kodec, a.namac, a.kota, a.telp, GROUP_CONCAT(TRIM(b.project) SEPARATOR \', \') AS project',
			'from' => 'tcust a',
			'join' => [
				'tproject b, b.kodec = a.kodec, left'
			],
			'where' => ['a.id' => $id],
			'where_in' => [
				'b.kodec' => $this->_getCustomerCodesWithMultipleProjects()
			],
			'group_by' => 'a.id, a.kodec, a.namac, a.kota, a.telp',
		];

		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}
}
