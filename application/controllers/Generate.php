<?php class Generate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Barang";
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('project_materials_pdf', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    function stock_masuk()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Stock Masuk";
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $username = array('username' => $this->session->userdata('username'));
        $data['user'] = $this->data->find('tuser', $username)->row_array();
        $html = $this->load->view('masterwarehouse/stock_masuk_pdf', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
