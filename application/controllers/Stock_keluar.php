<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_keluar extends CI_Controller
{
    var $module_js = ['stock_keluar'];

    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
        if (!$this->is_logged_in()) {
            redirect('Auth');
        }
    }

    public function is_logged_in()
    {
        return $this->session->userdata('logged_in') === TRUE;
    }

    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }
    public function stock_keluar()
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();


        $data['title'] = 'Stock Keluar';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/stock_keluar', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data_keluar()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Fungsi untuk mengubah format tanggal
        $formatDate = function ($date) {
            if (!empty($date)) {
                $tgl_parts = explode('-', $date);
                return $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
            }
            return null;
        };

        $start_date = $formatDate($start_date);
        $end_date = $formatDate($end_date);
        $query = [
            'select' => '*',
            'from' => 'tstock',
            'where' => ['tipe' => 2],
        ];

        // Menambahkan kondisi tanggal jika ada
        if ($start_date) {
            $query['where']['tgl >='] = $start_date;
        }
        if ($end_date) {
            $query['where']['tgl <='] = $end_date;
        }

        $result = $this->data->get($query)->result();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    public function save_session_data()
    {
        $formData = $this->input->post();
        if (empty($formData)) {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
            return;
        }
        $this->session->set_userdata('pdf_data', $formData);
        echo json_encode(['status' => 'success']);
    }
    public function generate_data()
    {
        $this->load->library('pdfgenerator');
        $pdfData = $this->session->userdata('pdf_data');
        if (empty($pdfData)) {
            echo json_encode(['status' => 'error', 'message' => 'No PDF data found in session']);
            return;
        }
        $data = [
            'title' => "Laporan Data Keluar",
            'tableData' => json_decode($pdfData['tableData'], true)
        ];
        $where = array('username' => $this->session->userdata['username']);
        $data['user'] = $this->data->find('tuser', $where)->row();
        try {
            $html = $this->load->view('masterwarehouse/stock_keluar_pdf', $data, true);
            $filename = "Laporan_Data_Keluar_" . date('YmdHis');
            $pdfContent = $this->pdfgenerator->generate($html, $filename, 'A4', 'landscape');

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '.pdf"');
            echo $pdfContent;
        } catch (Exception $e) {
            log_message('error', 'PDF generation error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Failed to generate PDF: ' . $e->getMessage()]);
        }
    }
}
