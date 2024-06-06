<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_barang_menipis extends CI_Controller
{

    var $module_js = ['data-menipis'];

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
    public function index()
    {
        //load menu helper
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Stock Menipis';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/data_barang_menipis');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'id, kodeg, kodeb, namab, stock, stockmin',
            'from' => 'tbarang',
            'where' => 'stock < stockmin',
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
}
