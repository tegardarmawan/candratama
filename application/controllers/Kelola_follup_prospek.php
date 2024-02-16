<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_follup_prospek extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_follup_prospek');
		$this->load->view('templates/footer');
	}
}
