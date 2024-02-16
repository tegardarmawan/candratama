<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_surat_presentasi extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/kelola_surat_presentasi');
		$this->load->view('templates/footer');
	}
}
