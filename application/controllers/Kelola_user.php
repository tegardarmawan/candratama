<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_buyer extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('fasilitas/kelola_user');
		$this->load->view('templates/footer');
	}
}
