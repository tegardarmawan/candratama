<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_buyer_RO extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_buyer_RO');
		$this->load->view('templates/footer');
	}
}
