<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_calon_buyer extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_calon_buyer');
		$this->load->view('templates/footer');
	}
}
