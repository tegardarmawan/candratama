<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_karyawan extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('kelola_karyawan');
		$this->load->view('templates/footer');
	}
}
