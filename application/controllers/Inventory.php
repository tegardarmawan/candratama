<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

    var $module_js = ['inventory'];

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
    public function stock_masuk()
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();


        $data['title'] = 'Stock Masuk';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/stock_masuk', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data_masuk()
    {

        $query = [
            'select' => 'a.nota, a.tgl, a.waktu, a.namab, a.masuk, b.hbeli',
            'from' => 'tstock a',
            'join' => [
                'tbarang b, b.kodeb = a.kodeb'
            ],
            'where' => ['tipe' => 1],
            // 'group_by' => 'nota, tgl, ket',
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    public function stock_masuk_detail($nota = null)
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();
        if ($nota) {
            $query = [
                'select' => 'nota, tgl, namat, ',
                'from' => 'tstock',
                'where' => ['nota' => $nota],
                'group_by' => 'nota, tgl, namat, ket',
            ];
            $this->app_data['stock'] = $this->data->get($query)->result();
        } else {
            $this->app_data['stock'] = [];
        }

        $data['title'] = 'Stock Masuk';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/stock_masuk_detail', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data_detail($nota = null)
    {
        if ($nota == null || empty($nota)) {
            echo json_encode(['error' => 'Nota parameter is missing']);
            return;
        }
        $where = ['nota' => $nota];
        $result = $this->data->find('tstock', $where)->result();
        echo json_encode($result);
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
}
