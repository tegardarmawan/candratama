<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_interior extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/laporan');
		$this->load->view('templates/footer');
	}
}
