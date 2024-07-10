<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_keluar_detail extends CI_Controller
{

    var $module_js = ['stock_keluar_detail'];

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
    public function index($nota = null)
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();
        if ($nota) {
            $query = [
                'select' => 'nota, tgl, namat, ket',
                'from' => 'tstock',
                'where' => ['nota' => $nota],
                'group_by' => 'nota, tgl, namat, ket',
            ];
            $this->app_data['stock'] = $this->data->get($query)->result();
        } else {
            $this->app_data['stock'] = [];
        }

        $this->app_data['nota'] = $nota;

        $data['title'] = 'Stock Keluar';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/stock_keluar_detail', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data($nota = null)
    {
        if ($nota == null || empty($nota)) {
            echo json_encode(['error' => 'Nota parameter is missing']);
            return;
        }
        $where = ['nota' => $nota];
        $result = $this->data->find('tstock', $where)->result();
        if (empty($result)) {
            echo json_encode(['error' => 'No data found']);
            return;
        }
        echo json_encode($result);
    }
}
