<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_alat_tukang extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('inventaris/alat_tukang');
		$this->load->view('templates/footer');
	}
}
