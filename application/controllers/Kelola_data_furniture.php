<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_furniture extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/kelola_data_furniture');
		$this->load->view('templates/footer');
	}
}
