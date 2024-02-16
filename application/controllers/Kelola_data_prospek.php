<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_prospek extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_data_prospek');
		$this->load->view('templates/footer');
	}
}
