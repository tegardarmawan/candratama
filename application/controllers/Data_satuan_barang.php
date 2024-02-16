<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_satuan_barang extends CI_Controller {
	public function index()
	{
		$this->load->view('templates/sidebar');
		$this->load->view('templates/header');
		$this->load->view('masterwarehouse/data_satuan_barang');
		$this->load->view('templates/footer');
	}
}
