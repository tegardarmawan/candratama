<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_data_kontrak extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('project_interior/data_kontrak');
		$this->load->view('templates/footer');
	}
}
